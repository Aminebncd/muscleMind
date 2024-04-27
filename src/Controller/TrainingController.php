<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Form\WorkoutType;
use App\Entity\WorkoutPlan;
use App\Repository\UserRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrainingController extends AbstractController
{


// FUNCTIONS RELATING TO PROGRAMS

    // lists every programs created by the user
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


    // create or edit a program and it's content
    #[Route('/training/new', name: 'app_training_new')]
    #[Route('/training/edit/{id}', name: 'app_training_edit')]
    public function createEditProgram(Request $request,
                                    ExerciceRepository $exerciceRepository,
                                    EntityManagerInterface $em, 
                                    Program $program = null
                                ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        // if we are in edit mode (meaning we're in an existing program)
        // we won't render the same form 
        $isEdit = $program !== null;

        if (!$program) {
            $program = new Program();
        }

        $formAddProgram = $this->createForm(ProgramType::class, $program);
        $formAddProgram->handleRequest($request);
        
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

        // we initialize our variables just to have them ready
        $exercisesForPrimaryMuscleGroup = new ArrayCollection();
        $exercisesForSecondaryMuscleGroup = new ArrayCollection();

        // if we're in edit mode
        if($isEdit){
            // We gather the muscle groups infos from the program entity with our getters
            $selectedMuscleGroup = $program->getMuscleGroupTargeted();
            $selectedSecondaryMuscleGroup = $program->getSecondaryMuscleGroupTargeted();
            
            //We use those values to collect the corresponding exercises
            $exercisesForPrimaryMuscleGroup = new ArrayCollection($exerciceRepository->findExercisesByMuscleGroup($selectedMuscleGroup));
            $exercisesForSecondaryMuscleGroup = new ArrayCollection($exerciceRepository->findExercisesByMuscleGroup($selectedSecondaryMuscleGroup));
        }

        // we create the workout form with the pre established options
        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan(), [
            'primaryMuscleGroupExercises' => $exercisesForPrimaryMuscleGroup,
            'secondaryMuscleGroupExercises' => $exercisesForSecondaryMuscleGroup,
        ]);
        $formAddWorkout->handleRequest($request);
        
            // after adding a workoutPlan we stay in edit mode to add more
            if ($formAddWorkout->isSubmitted() 
                && $formAddWorkout->isValid()) {

                $program->addWorkoutPlan($formAddWorkout->getData());
                $em->persist($program);
                $em->flush();

                return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
            }

            
            // this part was used to verify the score incrementation, not useful anymore since workout out isn't just about
            // composing the heaviest or longest workout session, i want it to be about training efficiently with consistency
            $workoutPlans = $program->getWorkoutPlans();
            // $programScore = 0;

            // foreach($workoutPlans as $workoutPlan){
            //     $programScore += ($workoutPlan->getWeightsUsed() * $workoutPlan->getNumberOfRepetitions());
            // }

        // we render every variable 
        return $this->render('training/new.html.twig', [
            'formAddProgram' => $formAddProgram->createView(),
            'formAddWorkout' => $formAddWorkout->createView(),
            'program' => $program,
            'workoutPlans' => $workoutPlans,
            // 'workoutScore' => $programScore,
            'edit' => $isEdit,
            'controller_name' => 'TrainingController',
        ]);
    }



    // delete a program
    #[Route('/training/delete/{id}', name: 'app_training_delete')]
    public function removeProgram(Program $program = null, 
                            EntityManagerInterface $em,
                            Request $request)
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // necessary only with the render() method
        // $user = $this->getUser();
        // $programs = $user->getPrograms();
        
        $em->remove($program);
        $em->flush();
        
        return $this->redirectToRoute('app_training');
    }


    
    // delete the workoutPlan within a program
    #[Route('/training/{program}/{workoutPlan}/delete', name: 'removeWP_Program')]
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
