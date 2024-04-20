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
        // i always verify if the user is logged in
        // if not, i send him the login page
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // we gather his infos to render his username and the programs he created
        $user = $this->getUser();
        $programs = $user->getPrograms();

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
        
        // if we are in edit mode (meaning we're in an existing program)
        // we won't render the same form 
        $isEdit = $program !== null;
    
        if (!$program) {
            $program = new Program();
        }
    
        // we still load both of them
        $formAddProgram = $this->createForm(ProgramType::class, $program);
        $formAddProgram->handleRequest($request);
    
        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan());
        $formAddWorkout->handleRequest($request);
    
        // after verifications, we persist the new program into the database and
        // enter edit mode to add workoutPlans
        if ($formAddProgram->isSubmitted() 
            && $formAddProgram->isValid()
                && $formAddProgram->getData()->getMuscleGroupTargeted() != $formAddProgram->getData()->getSecondaryMuscleGroupTargeted()) {
            $program->setCreator($this->getUser());
            $em->persist($program);
            $em->flush();

            return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
        }
    
        // same thing here, after adding a workoutPlan we stay in edit mode to add more
        if ($formAddWorkout->isSubmitted() 
            && $formAddWorkout->isValid()
            ) {
            $program->addWorkoutPlan($formAddWorkout->getData());
            $em->persist($program);
            $em->flush();

            return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
        }
    
        // we render every variable 
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

        // thanks to symfony, we already have a method to call if we want to remove a workoutPlan item
        // we specifically have to enable orphan removals for it to completely delete the object from the database
        // if we didn't, we would've just nulled the program_id in it
        $program->removeWorkoutPlan($workoutPlan);
        $em->persist($program);
        $em->flush();

        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan());
        $formAddWorkout->handleRequest($request);

        return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
    }

    

    


}
