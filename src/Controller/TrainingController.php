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
use Symfony\Component\Form\FormInterface;
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






    // // This monstrosity of a function is used to create or edit a program
    // // i will have to refactor it to make it more readable
    // #[Route('/training/new', name: 'app_training_new')]
    // #[Route('/training/edit/{id}', name: 'app_training_edit')]
    // public function createEditProgram(Request $request,
    //                                 ExerciceRepository $exerciceRepository,
    //                                 MuscleRepository $muscleRepository,
    //                                 EntityManagerInterface $em, 
    //                                 Program $program = null
    //                             ): Response {

    //     // i always verify if the user is logged in
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     // if we are in edit mode 
    //     // (meaning we're in an existing program)
    //     // we won't render the same form 
    //     $isEdit = ($program !== null);
        
    //     if (!$program) {
    //         $program = new Program();
    //     }

        
    //     $formAddProgram = $this->createForm(ProgramType::class, $program);
    //     $formAddProgram->handleRequest($request);
        
    //     // after validation, we persist the new program into the database and
    //     // enter edit mode to add workoutPlans (Exercises to do in the program)
    //     if ($formAddProgram->isSubmitted() 
    //         && $formAddProgram->isValid()
    //             && $formAddProgram->getData()->getMuscleGroupTargeted() != $formAddProgram->getData()->getSecondaryMuscleGroupTargeted()) {
    //         $program->setCreator($this->getUser());
    //         $em->persist($program);
    //         $em->flush();
    //         return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
    //     }

    //     // we initialize our variables just to have them ready
    //     $exercisesForPrimaryMuscleGroup = new ArrayCollection();
    //     $exercisesForSecondaryMuscleGroup = new ArrayCollection();

    //     // if we are in edit mode
    //     if($isEdit){

    //         // We gather the muscle groups from the program entity with our getters
    //         $selectedMuscleGroup = $program->getMuscleGroupTargeted();
    //         $selectedSecondaryMuscleGroup = $program->getSecondaryMuscleGroupTargeted();

    //         // Find the muscles in the selected muscle groups and convert them to ArrayCollection
    //         $musclesPrimary = new ArrayCollection($muscleRepository->findMusclesInMuscleGroup($selectedMuscleGroup));
    //         $musclesSecondary = new ArrayCollection($muscleRepository->findMusclesInMuscleGroup($selectedSecondaryMuscleGroup));

    //         // Merge the muscles from primary and secondary muscle groups
    //         $muscles = new ArrayCollection(array_merge($musclesPrimary->toArray(), $musclesSecondary->toArray()));

    //         // Initialize the exercise collections
    //         $exercisesForPrimaryMuscleGroup = new ArrayCollection();
    //         $exercisesForSecondaryMuscleGroup = new ArrayCollection();

    //         // Find the exercises for each muscle
    //         foreach ($muscles as $muscle) {
    //             $exercisesForMuscle = $exerciceRepository->findExercisesByMuscle($muscle);
    //             foreach ($exercisesForMuscle as $exercise) {
    //                 if ($muscle->getMuscleGroup() == $selectedMuscleGroup) {
    //                     $exercisesForPrimaryMuscleGroup->add($exercise);
    //                 } else {
    //                     $exercisesForSecondaryMuscleGroup->add($exercise);
    //                 }
    //             }
    //         }
    //     }

    //     // we create the workout form with the pre established options
    //     $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan(), [
    //         'primaryMuscleGroupExercises' => $exercisesForPrimaryMuscleGroup,
    //         'secondaryMuscleGroupExercises' => $exercisesForSecondaryMuscleGroup,
    //     ]);
    //     $formAddWorkout->handleRequest($request);
        
 
    //     // after adding a workoutPlan we stay in edit mode to add more
    //     if ($formAddWorkout->isSubmitted() && $formAddWorkout->isValid()) {
    //         $workoutPlan = $formAddWorkout->getData();
    //         $newExerciseId = $formAddWorkout->getData()->getExercice()->getId();

    //         // If everything is fine, persist the workout plan
    //         $program->addWorkoutPlan($workoutPlan);
    //         $em->persist($program);
    //         $em->flush();
        


            // // Check if the user is adding too much volume on the same exercise
            // // i can do this by counting the number of times an exercise is added
            // // and checking if it exceeds a certain limit
            // // usually, 5 sets of 4 to 12 reps is a good start for beginners who want to build strength
            // // and that's counting the first 2-3 sets as warm-up sets
            // // so let's say 5 sets of x reps per exercise is the limit
            // // if the user wants to add more, he still can but i'll show a warning message
            // // and let him know that it's not recommended to do that much volume on the same exercise

            // $workoutPlans = $program->getWorkoutPlans();
            
            // $exerciseOccurrences = [];
            // foreach ($workoutPlans as $workoutPlan) {
            //     $exercise = $workoutPlan->getExercice();
            //     $exerciseId = $exercise->getId();
            //     if (!isset($exerciseOccurrences[$exerciseId])) {
            //         $exerciseOccurrences[$exerciseId] = 1;
            //     } else {
            //         $exerciseOccurrences[$exerciseId]++;
            //     }
            // }

            // $maxOccurrencesPerExercise = 5;

            // // Check if the maximum occurrences per exercise limit is exceeded
            // if (isset($exerciseOccurrences[$newExerciseId]) && $exerciseOccurrences[$newExerciseId] >= $maxOccurrencesPerExercise) {
            //     // You can handle the case where the limit is exceeded here
            //     // For now, let's just set a flag to indicate that the limit is exceeded
            //     $maxOccurrencesPerExerciseExceeded = true;
            // } else {
            //     $maxOccurrencesPerExerciseExceeded = false;
            // }

            // // depending on the situation, we can display a message to the user
            // // if he's adding too much volume on the same exercise
            // // something like "You've added a bit too much volume on this exercise, we recommend 2 to 3 working sets per exercise."
            // if ($maxOccurrencesPerExerciseExceeded) {
            //     $this->addFlash('warning', 'You\'ve added a bit too much volume on this exercise, we recommend 2 to 3 working sets per exercise.');
            // }




            
            // // along with the number of sets per exercice
            // // we can also check the total volume put on the muscle groups
            // // and let the user know if he's overdoing it
            // // the latest research shows that 10 to 20 sets per muscle group per week is a good start
            // // given that the user trains to failure or close to it
            // // i won't monitor how many times a week the user programs his workouts
            // // but i can still give him a warning message if he's overdoing it

            // $muscleGroupOccurrences = [];

            // foreach ($workoutPlans as $workoutPlan) {

            //     $muscleGroup = $workoutPlan->getExercice()
            //                                 ->getTarget()
            //                                 ->getMuscleGroup()
            //                                 ->getName();

            //     if (!isset($muscleGroupOccurrences[$muscleGroup])) {
            //         $muscleGroupOccurrences[$muscleGroup] = 1;
            //     } else {
            //         $muscleGroupOccurrences[$muscleGroup]++;
            //     }
            // }
            
            // $maxOccurrencesPerMuscleGroup = 15;

            // foreach ($muscleGroupOccurrences as $muscleGroup => $occurrences) {
            //     if ($occurrences >= $maxOccurrencesPerMuscleGroup) {
            //         $this->addFlash('warning', 'You\'ve added a bit too much volume on the ' . $muscleGroup . ' muscle group. We recommend 10 to 20 sets per muscle group per week.');
            //         break; 
            //     }
            // }



    //         // i can also check if the user is training the same muscle group too often
    //         // but that's for a future update

    //         return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
    //     }


            
    //     // we gather the workoutPlans to render them
    //     $workoutPlans = $program->getWorkoutPlans();
 
    //     // we render every variable 
    //     return $this->render('training/new.html.twig', [
    //         'formAddProgram' => $formAddProgram->createView(),
    //         'formAddWorkout' => $formAddWorkout->createView(),
    //         'program' => $program,
    //         'workoutPlans' => $workoutPlans,
    //         // 'workoutScore' => $programScore,
    //         // 'exercice' => $exercise,
    //         'edit' => $isEdit,
    //         'controller_name' => 'TrainingController',
    //     ]);
    // }




















    // create or edit a program
    #[Route('/training/new', name: 'app_training_new')]
    #[Route('/training/edit/{id}', name: 'app_training_edit')]
    public function createEditProgram(Request $request,
                                    ExerciceRepository $exerciceRepository,
                                    MuscleRepository $muscleRepository,
                                    EntityManagerInterface $em, 
                                    Program $program = null
                                ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // if there is an existing program, we are in edit mode
        $isEdit = ($program !== null);

        // to check that, we call the initializeProgram function
        $program = $this->initializeProgram($program);

        // then we handle the program form
        $formAddProgram = $this->handleProgramForm($request, $program, $em);

        // then we check if the form is valid
        if ($formAddProgram instanceof Response) {
            return $formAddProgram;
        }
        // from there, we can gather the exercises for the muscle groups added in the program
        list($exercisesForPrimaryMuscleGroup, $exercisesForSecondaryMuscleGroup) = $this->gatherExercisesForMuscleGroups($isEdit, $program, $exerciceRepository, $muscleRepository);

        // then we handle the workout form
        $formAddWorkout = $this->handleWorkoutForm($request, $exercisesForPrimaryMuscleGroup, $exercisesForSecondaryMuscleGroup, $program, $em);

        // and check if the form is valid
        if ($formAddWorkout instanceof Response) {
            return $formAddWorkout;
        }

        // finally, we render the view
        return $this->renderTrainingView($formAddProgram, $formAddWorkout, $program, $isEdit);
    }


// the functions below are used in the createEditProgram function
// they are separated to make the code more readable and easier to maintain
// they are not meant to be used outside of the createEditProgram function,, that's why they are private

    // here we initialize the program while also checking if there is an existing one
    private function initializeProgram($program) {
        return $program ? $program : new Program();
    }


    // here we handle the program form
    private function handleProgramForm(Request $request, 
                                        Program $program, 
                                        EntityManagerInterface $em) {
        $formAddProgram = $this->createForm(ProgramType::class, $program);
        $formAddProgram->handleRequest($request);

        // we check if the form is submitted and valid
        // and if the muscle groups are different
        if ($formAddProgram->isSubmitted() 
            && $formAddProgram->isValid() 
                && $formAddProgram->getData()->getMuscleGroupTargeted() != $formAddProgram->getData()->getSecondaryMuscleGroupTargeted()) {
            $program->setCreator($this->getUser());
            $em->persist($program);
            $em->flush();
            return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
        }

        return $formAddProgram;
    }



    // here we gather the exercises for the muscle groups added in the program
    private function gatherExercisesForMuscleGroups($isEdit, 
                                                    Program $program, 
                                                    ExerciceRepository $exerciceRepository, 
                                                    MuscleRepository $muscleRepository) {
        
        // we initialize the exercise collections, we'll merge them later  
        $exercisesForPrimaryMuscleGroup = new ArrayCollection();
        $exercisesForSecondaryMuscleGroup = new ArrayCollection();

        if($isEdit){

            // We gather the muscle groups from the program entity with our getters
            $selectedMuscleGroup = $program->getMuscleGroupTargeted();
            $selectedSecondaryMuscleGroup = $program->getSecondaryMuscleGroupTargeted();

            // Find the muscles in the selected muscle groups and convert them to ArrayCollection
            $musclesPrimary = new ArrayCollection($muscleRepository->findMusclesInMuscleGroup($selectedMuscleGroup));
            $musclesSecondary = new ArrayCollection($muscleRepository->findMusclesInMuscleGroup($selectedSecondaryMuscleGroup));

            // Merge the muscles from primary and secondary muscle groups
            $muscles = new ArrayCollection(array_merge($musclesPrimary->toArray(), $musclesSecondary->toArray()));

            // Find the exercises for each muscle
            foreach ($muscles as $muscle) {
                // we find the exercises for each muscle with a custom DQL query
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

        return [$exercisesForPrimaryMuscleGroup, $exercisesForSecondaryMuscleGroup];
    }



    private function checkExerciseOccurrences($program, $newExerciseId) {
        $workoutPlans = $program->getWorkoutPlans();
        $exerciseOccurrences = [];
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
    
        if (isset($exerciseOccurrences[$newExerciseId]) && $exerciseOccurrences[$newExerciseId] >= $maxOccurrencesPerExercise) {
            $this->addFlash('warning', 'You\'ve added a bit too much volume on this exercise, we recommend 2 to 3 working sets per exercise.');
            return true;
        }
    
        return false;
    }
    
    private function checkMuscleGroupOccurrences($program) {
        $workoutPlans = $program->getWorkoutPlans();
        $muscleGroupOccurrences = [];
        foreach ($workoutPlans as $workoutPlan) {
            $muscleGroup = $workoutPlan->getExercice()
                                        ->getTarget()
                                        ->getMuscleGroup()
                                        ->getName();
    
            if (!isset($muscleGroupOccurrences[$muscleGroup])) {
                $muscleGroupOccurrences[$muscleGroup] = 1;
            } else {
                $muscleGroupOccurrences[$muscleGroup]++;
            }
        }
    
        $maxOccurrencesPerMuscleGroup = 10;
    
        foreach ($muscleGroupOccurrences as $muscleGroup => $occurrences) {
            if ($occurrences >= $maxOccurrencesPerMuscleGroup) {
                $this->addFlash('warning', 'You\'ve added a bit too much volume on the ' . $muscleGroup . ' muscle group. We recommend 10 to 20 sets per muscle group per week.');
                return true;
            }
        }
    
        return false;
    }



    // here we handle the workout form
    private function handleWorkoutForm(Request $request, 
                                    ArrayCollection $exercisesForPrimaryMuscleGroup, 
                                    ArrayCollection $exercisesForSecondaryMuscleGroup, 
                                    Program $program, 
                                    EntityManagerInterface $em) {

    // we create the workout form with the pre established options
    $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan(), [
        'primaryMuscleGroupExercises' => $exercisesForPrimaryMuscleGroup,
        'secondaryMuscleGroupExercises' => $exercisesForSecondaryMuscleGroup,
    ]);
    $formAddWorkout->handleRequest($request);

    // after adding a workoutPlan we stay in edit mode to add more
    if ($formAddWorkout->isSubmitted() && $formAddWorkout->isValid()) {
        $workoutPlan = $formAddWorkout->getData();
        $workoutPlan->setProgram($program);

        // Get the new exercise id
        $newExerciseId = $workoutPlan->getExercice()->getId();

        // Check if the exercise or muscle group occurrences exceed the limit
        if ($this->checkExerciseOccurrences($program, $newExerciseId) || $this->checkMuscleGroupOccurrences($program, $newExerciseId)) {
            return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
        }

        $em->persist($workoutPlan);
        $em->flush();
        return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
    }

    return $formAddWorkout;
}


// the last function of my former createEditProgram function
// it's used to render the view
// it's separated to make the code more readable and easier to maintain
// it's not meant to be used outside of the createEditProgram function,, that's why it's private

    // this function renders the view
    // the FormInterface type hinting is necessary for the render() method

    protected function renderTrainingView(FormInterface $formAddProgram, 
                                            FormInterface $formAddWorkout, 
                                            Program $program, bool $isEdit) {
        $workoutPlans = $program->getWorkoutPlans();

        return $this->render('training/new.html.twig', [
            'formAddProgram' => $formAddProgram->createView(),
            'formAddWorkout' => $formAddWorkout->createView(),
            'program' => $program,
            'workoutPlans' => $workoutPlans,
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
                            ExerciceRepository $exerciceRepository,
                            MuscleRepository $muscleRepository,
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

         // we initialize our variables just to have them ready
        $exercisesForPrimaryMuscleGroup = new ArrayCollection();
        $exercisesForSecondaryMuscleGroup = new ArrayCollection();


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
        

        // we create the workout form with the pre established options
        $formAddWorkout = $this->createForm(WorkoutType::class, new WorkoutPlan(), [
            'primaryMuscleGroupExercises' => $exercisesForPrimaryMuscleGroup,
            'secondaryMuscleGroupExercises' => $exercisesForSecondaryMuscleGroup,
        ]);
        $formAddWorkout->handleRequest($request);

        return $this->redirectToRoute('app_training_edit', ['id' => $program->getId()]);
    }

 
}
