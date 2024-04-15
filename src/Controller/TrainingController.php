<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\WorkoutPlan;
use App\Form\ProgramType;
use App\Form\WorkoutType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrainingController extends AbstractController
{
    #[Route('/training', name: 'app_training')]
    #[Route('/training/edit/{id}', name: 'app_training_edit')]
    public function index(Request $request, 
                            EntityManagerInterface $em, 
                            Program $program = null,
                            WorkoutPlan $workoutPlan = null ): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$program) {
            $program = new Program();
        }

        $program = new Program();
        $formAddProgram = $this->createForm(ProgramType::class, $program);
        $formAddProgram->handleRequest($request);

        if ($formAddProgram->isSubmitted() && $formAddProgram->isValid()) {
            $program->setCreator($this->getUser());
            $em->persist($program);
            $em->flush();

            return $this->redirectToRoute('app_training_edit',  ['id' => $program->getId()]);
        }

        // Créer un formulaire pour ajouter un nouveau workout plan
        $workoutPlan = new WorkoutPlan();
        $formAddWorkout = $this->createForm(WorkoutType::class, $workoutPlan);
        $formAddWorkout->handleRequest($request);

        if ($formAddWorkout->isSubmitted() && $formAddWorkout->isValid()) {
            // Ajouter le workout plan au programme actuel
            $program->addWorkoutPlan($workoutPlan);
            $em->persist($workoutPlan);
            $em->flush();

            // Rediriger vers la même page pour permettre l'ajout d'autres workouts plans
            return $this->redirectToRoute('app_training_edit',  ['id' => $program->getId()]);
        }

        return $this->render('training/index.html.twig', [
            'formAddProgram' => $formAddProgram->createView(),
            'formAddWorkout' => $formAddWorkout->createView(),
            'edit' => $program->getId(),
            'controller_name' => 'TrainingController',
        ]);
    }


}
