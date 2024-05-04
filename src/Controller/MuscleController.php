<?php

namespace App\Controller;

use App\Entity\MuscleGroup;
use App\Repository\MuscleRepository;
use App\Repository\ExerciceRepository;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MuscleController extends AbstractController
{
    #[Route('/muscle', name: 'app_muscle')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('muscle/index.html.twig', [
            'controller_name' => 'MuscleController',
        ]);
    }

    #[Route('/muscle/detailsMuscleGroup/{id}', name: 'app_muscleGroup_details')]
    public function detailsMuscleGroup(MuscleGroup $muscleGroup, 
                                        MuscleRepository $muscleRepository,
                                        ExerciceRepository $exerciceRepository,): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $muscles = $muscleRepository->findMusclesInMuscleGroup($muscleGroup);
        $exercisesForMuscleGroup = new ArrayCollection();

        foreach ($muscles as $muscle) {
            $exercisesForMuscle = $exerciceRepository->findExercisesByMuscle($muscle);
            foreach ($exercisesForMuscle as $exercise) {
            
                    $exercisesForMuscleGroup->add($exercise);
                
            }
        }

        return $this->render('muscle/detailsMuscleGroup.html.twig', [
            'muscleGroup' => $muscleGroup,
            'muscles' => $muscles,
            'exercices' => $exercisesForMuscleGroup,
            'controller_name' => 'MuscleController',
        ]);
    }

    #[Route('/muscle/detailsMuscle/{id}', name: 'app_muscle_details')]
    public function detailsMuscle(Muscle $muscle): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('muscle/detailsMuscle.html.twig', [
            'muscle' => $muscle,
            'controller_name' => 'MuscleController',
        ]);
    }
 
}
