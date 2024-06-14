<?php

namespace App\Controller;

use App\Entity\Muscle;
use App\Form\MuscleType;
use App\Entity\MuscleGroup;
use App\Repository\MuscleRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MuscleController extends AbstractController
{

    // renders the muscle page
    #[Route('/muscle', name: 'app_muscle')]
    public function index(MuscleGroupRepository $mgr): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $muscleGroups = $mgr->findAll();




        return $this->render('muscle/index.html.twig', [
            'muscleGroups' => $muscleGroups,
            'controller_name' => 'MuscleController',
        ]);
    }


    // renders the muscle details group page
    #[Route('/muscle/detailsMuscleGroup/{id}', name: 'app_muscleGroup_details')]
    public function detailsMuscleGroup(MuscleGroup $muscleGroup = null, 
                                        MuscleRepository $muscleRepository,
                                        ExerciceRepository $exerciceRepository,): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$muscleGroup) {
            return $this->redirectToRoute('app_muscle');
        }

        // we fetch every muscle composing the muscle group
        // then we fetch every exercise that targets those muscles
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



    // renders the muscle details page
    #[Route('/muscle/detailsMuscle/{id}', name: 'app_muscle_details')]
    public function detailsMuscle(Muscle $muscle = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$muscle) {
            return $this->redirectToRoute('app_muscle');
        }

        $muscleGroup = $muscle->getMuscleGroup();

        return $this->render('muscle/detailsMuscle.html.twig', [
            'muscle' => $muscle,
            'muscleGroup' => $muscleGroup,
            'controller_name' => 'MuscleController',
        ]);
    }





    // this function is used by admins to add a new muscle
    // that won't happen a lot given that the database is already fairly complete
    // and the human body won't (hopefully) change much in the future :
    // but that still could be useful
    #[Route('/admin/muscle/add', name: 'app_muscle_add')]
    #[Route('/admin/muscle/edit/{id}', name: 'app_muscle_edit')]
    public function addEditMuscle(Request $request, 
                                    MuscleGroupRepository $muscleGroupRepository,
                                    MuscleRepository $muscleRepository,
                                    EntityManagerInterface $entityManager,
                                    Muscle $muscle): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$muscle) {
            $muscle = new Muscle();
        }

        $form = $this->createForm(MuscleType::class, $muscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($muscle);
            $entityManager->flush();
            return $this->redirectToRoute('app_muscle');
        }
        

        return $this->render('admin/newMuscle.html.twig', [
            'muscleForm' => $form->createView(),      
            'controller_name' => 'MuscleController',
        ]);
    }

    

    // likewise, this function will be used by admins to delete a muscle
    #[Route('/admin/muscle/delete/{id}', name: 'app_muscle_delete')]
    public function deleteMuscle(Muscle $muscle = null, 
                                EntityManagerInterface $entityManager): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$muscle) {
            return $this->redirectToRoute('app_muscle');
        }

        $entityManager->remove($muscle);
        $entityManager->flush();

        return $this->redirectToRoute('app_muscle');
        
    }
 
}
