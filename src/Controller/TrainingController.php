<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Form\WorkoutType;
use App\Entity\WorkoutPlan;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrainingController extends AbstractController
{

    #[Route('/training', name: 'app_training')]
    public function index(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        $user = $this->getUser();
        $programs = $user->getPrograms();

        // dd($sessions);


        return $this->render('training/index.html.twig', [
            'user' => $user,
            'programs' => $programs,
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/training/new', name: 'app_training_new')]
    #[Route('/training/edit/{id}', name: 'app_training_edit')]
    public function createEditProgram(Request $request, 
                          EntityManagerInterface $em, 
                          Program $program = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
    
        $isEdit = $program !== null;
    
        if (!$program) {
            $program = new Program();
        }
    
        $formAddProgram = $this->createForm(ProgramType::class, $program);
        $formAddProgram->handleRequest($request);
    
        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan());
        $formAddWorkout->handleRequest($request);
    
        if ($formAddProgram->isSubmitted() && $formAddProgram->isValid()) {
            $program->setCreator($this->getUser());
            $em->persist($program);
            $em->flush();
    
            if ($isEdit) {
                return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
            } else {
                return $this->redirectToRoute('app_training');
            }
        }
    
        if ($formAddWorkout->isSubmitted() && $formAddWorkout->isValid()) {
            // Ajouter le workout plan au programme actuel
            $program->addWorkoutPlan($formAddWorkout->getData());
            $em->persist($program);
            $em->flush();
    
            if ($isEdit) {
                return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
            } else {
                return $this->redirectToRoute('app_training');
            }
        }
    
        return $this->render('training/new.html.twig', [
            'formAddProgram' => $formAddProgram->createView(),
            'formAddWorkout' => $formAddWorkout->createView(),
            'program' => $program,
            'workoutPlans' => $program->getWorkoutPlans(),
            'edit' => $isEdit,
            'controller_name' => 'TrainingController',
        ]);
    }


    #[Route('/admin/{program}/{workoutPlan}/delete', name: 'removeWP_Program')]
    public function removeWorkoutPlan(Program $program = null, 
                            WorkoutPlan $workoutPlan = null,
                            EntityManagerInterface $em,
                            Request $request)
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $program->removeWorkoutPlan($workoutPlan);
        $em->persist($program);
        $em->flush();

        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan());
        $formAddWorkout->handleRequest($request);

        return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);

    }

    


}
