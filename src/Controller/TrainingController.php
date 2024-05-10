<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Form\WorkoutType;
use App\Entity\WorkoutPlan;
use App\Repository\UserRepository;
use App\Repository\MuscleRepository;
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








    // This monstrosity of a function is used to create or edit a program
    // i will have to refactor it to make it more readable
    // inshaAllah
    #[Route('/training/new', name: 'app_training_new')]
    #[Route('/training/edit/{id}', name: 'app_training_edit')]
    public function createEditProgram(Request $request,
                                    ExerciceRepository $exerciceRepository,
                                    MuscleRepository $muscleRepository,
                                    EntityManagerInterface $em, 
                                    Program $program = null
                                ): Response {

        // i always verify if the user is logged in
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // if we are in edit mode 
        // (meaning we're in an existing program)
        // we won't render the same form 
        $isEdit = $program !== null;
        if (!$program) {
            $program = new Program();
        }

        
        $formAddProgram = $this->createForm(ProgramType::class, $program);
        $formAddProgram->handleRequest($request);
        
            // after validation, we persist the new program into the database and
            // enter edit mode to add workoutPlans (Exercises to do in the program)
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

            // if we are in edit mode
            if($isEdit){

                // We gather the muscle groups from the program entity with our getters
                $selectedMuscleGroup = $program->getMuscleGroupTargeted();
                $selectedSecondaryMuscleGroup = $program->getSecondaryMuscleGroupTargeted();

                // Find the muscles in the selected muscle groups and convert them to ArrayCollection
                $musclesPrimary = new ArrayCollection($muscleRepository->findMusclesInMuscleGroup($selectedMuscleGroup));
                $musclesSecondary = new ArrayCollection($muscleRepository->findMusclesInMuscleGroup($selectedSecondaryMuscleGroup));

                // Merge the muscles from primary and secondary muscle groups
                $muscles = new ArrayCollection(array_merge($musclesPrimary->toArray(), $musclesSecondary->toArray()));

                // Initialize the exercise collections
                $exercisesForPrimaryMuscleGroup = new ArrayCollection();
                $exercisesForSecondaryMuscleGroup = new ArrayCollection();

                // Find the exercises for each muscle
                foreach ($muscles as $muscle) {
                    $exercisesForMuscle = $exerciceRepository->findExercisesByMuscle($muscle);
                    foreach ($exercisesForMuscle as $exercise) {
                        if ($muscle->getMuscleGroup() == $selectedMuscleGroup) {
                            $exercisesForPrimaryMuscleGroup->add($exercise);
                        } else {
                            $exercisesForSecondaryMuscleGroup->add($exercise);
                        }
                    }
                }
            }

        // we create the workout form with the pre established options
        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan(), [
            'primaryMuscleGroupExercises' => $exercisesForPrimaryMuscleGroup,
            'secondaryMuscleGroupExercises' => $exercisesForSecondaryMuscleGroup,
        ]);
        $formAddWorkout->handleRequest($request);
        
 
        // after adding a workoutPlan we stay in edit mode to add more
        if ($formAddWorkout->isSubmitted() && $formAddWorkout->isValid()) {
            $workoutPlan = $formAddWorkout->getData();
            $newExerciseId = $formAddWorkout->getData()->getExercice()->getId();

            // If everything is fine, persist the workout plan
            $program->addWorkoutPlan($workoutPlan);
            $em->persist($program);
            $em->flush();
        
            // Check if the user is adding too much volume on the same exercise
            // i can do this by counting the number of times an exercise is added
            // and checking if it exceeds a certain limit
            // usually, 5 sets of 4 to 12 reps is a good start for beginners who want to build strength
            // and that's counting the first 2-3 sets as warm-up sets
            // so let's say 3 working sets of x reps per exercise is the limit
            // if the user wants to add more, he still can but i'll show a warning message
            // and let him know that it's not recommended for beginners

            
            $workoutPlans = $program->getWorkoutPlans();
            
            foreach ($workoutPlans as $workoutPlan) {
                $exercise = $workoutPlan->getExercice();
                $exerciseId = $exercise->getId();
                if (!isset($exerciseOccurrences[$exerciseId])) {
                    $exerciseOccurrences[$exerciseId] = 1;
                } else {
                    $exerciseOccurrences[$exerciseId]++;
                }
            }

            $maxOccurrencesPerExercise = 5;

            // Check if the maximum occurrences per exercise limit is exceeded
            if (isset($exerciseOccurrences[$newExerciseId]) && $exerciseOccurrences[$newExerciseId] >= $maxOccurrencesPerExercise) {
                // You can handle the case where the limit is exceeded here
                // For now, let's just set a flag to indicate that the limit is exceeded
                $maxOccurrencesPerExerciseExceeded = true;
            } else {
                $maxOccurrencesPerExerciseExceeded = false;
            }

            // dd($maxOccurrencesPerExerciseExceeded);

            // depending on the situation, we can display a message to the user
            // if he's adding too much volume on the same exercise
            // something like "You've added a bit too much volume on this exercise, we recommend 2 to 3 working sets per exercise."
            if ($maxOccurrencesPerExerciseExceeded) {
                $this->addFlash('warning', 'You\'ve added a bit too much volume on this exercise, we recommend 2 to 3 working sets per exercise.');
            }

            return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
        }


            
        // we gather the workoutPlans to render them
        $workoutPlans = $program->getWorkoutPlans();
 
        // we render every variable 
        return $this->render('training/new.html.twig', [
            'formAddProgram' => $formAddProgram->createView(),
            'formAddWorkout' => $formAddWorkout->createView(),
            'program' => $program,
            'workoutPlans' => $workoutPlans,
            // 'workoutScore' => $programScore,
            // 'exercice' => $exercise,
            // 'maxOccurrencesPerExerciseExceeded' => $maxOccurrencesPerExerciseExceeded, // Pass the flag indicating if the limit is exceeded
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
