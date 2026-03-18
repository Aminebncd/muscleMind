<?php

namespace App\Command;

use App\Entity\Exercice;
use App\Entity\Muscle;
use App\Service\ExerciseDBClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:sync-exercises',
    description: 'Fetch exercises from ExerciseDB and sync them to local database'
)]
class SyncExercisesCommand extends Command
{
    private ExerciseDBClient $apiClient;
    private EntityManagerInterface $entityManager;

    public function __construct(ExerciseDBClient $apiClient, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->apiClient = $apiClient;
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Starting ExerciseDB Synchronization');

        try {
            $io->text('Fetching data from API...');
            $exercisesData = $this->apiClient->getAllExercises();
            $io->success(sprintf('Fetched %d exercises from RapidAPI.', count($exercisesData)));
        } catch (\Exception $e) {
            $io->error('Failed to fetch data from API: ' . $e->getMessage());
            return Command::FAILURE;
        }

        $io->progressStart(count($exercisesData));

        $exerciceRepo = $this->entityManager->getRepository(Exercice::class);
        $muscleRepo = $this->entityManager->getRepository(Muscle::class);

        $musclesMap = []; // Cache local pour éviter les requêtes DB en boucle

        // Récupération des muscles existants
        $existingMuscles = $muscleRepo->findAll();
        foreach ($existingMuscles as $m) {
            $musclesMap[strtolower(trim($m->getMuscleName()))] = $m;
        }

        $flushCounter = 0;

        foreach ($exercisesData as $data) {
            // Installer Default MuscleGroup if it doesn't exist
            $muscleGroupRepo = $this->entityManager->getRepository(\App\Entity\MuscleGroup::class);
            $defaultGroup = $muscleGroupRepo->findOneBy(['muscleGroup' => 'Uncategorized']);
            if (!$defaultGroup) {
                $defaultGroup = new \App\Entity\MuscleGroup();
                $defaultGroup->setMuscleGroup('Uncategorized');
                $this->entityManager->persist($defaultGroup);
                $this->entityManager->flush(); // Force Id generation for the FK constraint
            }

            // Identifier ou créer le muscle principal (target)
            $targetName = strtolower(trim($data['target'] ?? 'Unknown'));
            if (!isset($musclesMap[$targetName])) {
                $muscle = new Muscle();
                $muscle->setMuscleName(ucfirst($targetName));
                $muscle->setMuscleFunction('Managed by ExerciseDB');
                $muscle->setMuscleGroup($defaultGroup);
                
                $this->entityManager->persist($muscle);
                $musclesMap[$targetName] = $muscle;
            }
            $targetMuscle = $musclesMap[$targetName];

            // Identifier ou créer l'exercice
            $apiId = (string)($data['id'] ?? '');
            
            if (empty($apiId)) continue;

            $exercice = $exerciceRepo->findOneBy(['apiId' => $apiId]);

            if (!$exercice) {
                // Recherche par nom en fallback (si les anciens n'avaient pas d'apiId)
                $exercice = $exerciceRepo->findOneBy(['exerciceName' => $data['name']]);
                if (!$exercice) {
                    $exercice = new Exercice();
                }
            }

            $exercice->setApiId($apiId);
            $exercice->setExerciceName(ucfirst($data['name'] ?? 'Unknown'));
            $exercice->setGifUrl($data['gifUrl'] ?? null);
            // $exercice->setExerciceFunction(...) // On peut garder l'existant ou mettre un texte par défaut
            $exercice->setTarget($targetMuscle);

            // Gérer les secondary muscles si présents dans un futur rework, on skip pour l'instant

            $this->entityManager->persist($exercice);

            $io->progressAdvance();
            $flushCounter++;

            // Batch flush
            if ($flushCounter % 100 === 0) {
                $this->entityManager->flush();
            }
        }

        $this->entityManager->flush();
        $io->progressFinish();

        $io->success('Synchronization completed successfully!');

        return Command::SUCCESS;
    }
}
