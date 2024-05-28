<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PerfType;
use App\Entity\Tracking;
use App\Form\TrackingType;
use App\Entity\Performance;
use App\Repository\UserRepository;
use App\Repository\ExerciceRepository;
use App\Repository\TrackingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    // gathers all the connected user's data to display them
    #[Route('/user/myProfile', name: 'app_user')]
    public function index(Request $request, 
                        UserRepository $ur,
                        EntityManagerInterface $em,
                        TrackingRepository $tr): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        $this->updateScore($user);
            
        $em->persist($user);
        $em->flush();

        $latestTracking = $tr->getLatest($user);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'latestTracking' => $latestTracking, 
            'controller_name' => 'UserController',
        ]);
    }



            // factorized it for better readability
            // updates the user's score based on the sessions he has done
            private function updateScore(User $user) {
                $sessions = $user->getSessions();
                $totalScore = 0;
                $now = new \DateTime;

                foreach ($sessions as $session) {
                    if($session->getDateSession() <= $now) {
                        $program = $session->getProgram();
                        $workoutPlans = $program->getWorkoutPlans();
                        foreach ($workoutPlans as $workoutPlan) {
                            $totalScore += ($workoutPlan->getWeightsUsed() * $workoutPlan->getNumberOfRepetitions());
                        }
                    }
                }
                $user->setScore($totalScore);
            }




    // #[Route('/user/updateUser/{id}', name: 'app_user_update')]
    // public function updateUser(Request $request, 
    //                         UserRepository $ur,
    //                         EntityManagerInterface $em,
    //                         User $user = null): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     $userForm = $this->createForm(UserType::class, $user);
    //     $userForm->handleRequest($request);

    //     if ($userForm->isSubmitted() && $userForm->isValid()) {
    //         // $em->persist($user);
    //         // $em->flush();
            
    //         return $this->redirectToRoute('app_user_list');
    //     }

    //     return $this->render('user/editUser.html.twig', [
    //         'user' => $user,
    //         'userForm' => $userForm,
    //         'controller_name' => 'UserController',
    //     ]);
    // }

    // grants the admin role to a user
    #[Route('/admin/grantCredentials/{id}', name: 'app_user_grantCredentials')]
    public function grantCredentials(Request $request, 
                                UserRepository $ur,
                                EntityManagerInterface $em,
                                User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if (!$user) {
            return $this->redirectToRoute('app_user_list');
        }
        $user->setRoles(['ROLE_ADMIN']);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('app_user_list');
    }
    



    // lists the existing users
    #[Route('/admin/listUsers', name: 'app_user_list')]
    public function listUsers(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $users = $ur->findAll();

        return $this->render('user/listUsers.html.twig', [
            'users' => $users,
            // 'sessions' => $sessions,
            'controller_name' => 'UserController',
        ]);
    }


    // displays the details of a user
    #[Route('/admin/detailsUser/{id}', name: 'app_user_details')]
    public function detailsUser(Request $request, 
                            UserRepository $ur,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        return $this->render('user/detailsUser.html.twig', [
            'user' => $user,
            // 'sessions' => $sessions,
            'controller_name' => 'UserController',
        ]);
    }


    

    // deletes the user
    #[Route('/user/deleteUser/{id}', name: 'app_user_delete')]
    public function deleteUser(Request $request, 
                            UserRepository $ur,
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($user !== $this->getUser() || !in_array('ROLE_ADMIN', $user->getRoles())){
            return $this->redirectToRoute('app_home');
        }
        
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('app_user_list');
    }










    // TRAINING RELATED FUNCTIONS




    
    #[Route('/user/editPerf/{id}', name: 'app_user_editPerf')]
    #[Route('/user/newPerf', name: 'app_user_newPerf')]
    public function newEditPerf(Request $request,
                            Performance $perf,
                            EntityManagerInterface $em, 
                            // ExerciceRepository $er,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$perf) {
            $perf = new Performance();
        }

        $perfForm = $this->createForm(PerfType::class, $perf);
        $perfForm->handleRequest($request);

        if ($perfForm->isSubmitted() && $perfForm->isValid()) {
            $perf->setUserPerforming($this->getUser());
            
            $em->persist($perf);
            $em->flush();
            
            return $this->redirectToRoute('app_user');
        }


        return $this->render('user/newPerf.html.twig', [
            'user' => $user,
            // 'exercices' => $exercices,
            'perfForm' => $perfForm,
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user/editTrack/{id}', name: 'app_user_editTrack')]
    #[Route('/user/newTrack', name: 'app_user_newTrack')]
    public function newEditTracking(Request $request,
                            Tracking $tracking,
                            EntityManagerInterface $em, 
                            // ExerciceRepository $er,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // $exercices = $er->findAll();
        if (!$tracking) {
            $tracking = new Tracking();
        }

        $trackingForm = $this->createForm(TrackingType::class, $tracking);
        $trackingForm->handleRequest($request);
        $now = new \DateTime;


        if ($trackingForm->isSubmitted() && $trackingForm->isValid()) {
            $tracking->setUserTracked($this->getUser());
            $tracking->setDateOfTracking($now);
            $em->persist($tracking);
            $em->flush();
            
            return $this->redirectToRoute('app_user');
        }


        return $this->render('user/newTrack.html.twig', [
            'user' => $user,
            // 'exercices' => $exercices,
            'trackingForm' => $trackingForm,
            'controller_name' => 'UserController',
        ]);
    }

    
    // public function editTrack(Request $request, 
    //                         TrackingRepository $tr,
    //                         EntityManagerInterface $em,
    //                         Tracking $tracking = null): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     $trackingForm = $this->createForm(TrackingType::class, $tracking);
    //     $trackingForm->handleRequest($request);

    //     if ($trackingForm->isSubmitted() && $trackingForm->isValid()) {
    //         $em->persist($tracking);
    //         $em->flush();
            
    //         return $this->redirectToRoute('app_user');
    //     }

    //     return $this->render('user/editTrack.html.twig', [
    //         'tracking' => $tracking,
    //         'trackingForm' => $trackingForm,
    //         'controller_name' => 'UserController',
    //     ]);
    // }

    
    #[Route('/admin/deleteTrack/{id}', name: 'app_user_deleteTrack')]
    public function deleteTrack(Request $request, 
                            TrackingRepository $tr,
                            EntityManagerInterface $em,
                            Tracking $tracking = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        
        $em->remove($tracking);
        $em->flush();

        return $this->redirectToRoute('app_user');
    }


    #[Route('/admin/deletePerf/{id}', name: 'app_user_deletePerf')]
    public function deletePerf(Request $request, 
                            Performance $perf,
                            EntityManagerInterface $em,
                            Performance $performance = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();

        // For whatever reason, unless i nullify the relationship between 
        // the exercice and the performance, i get an error

        $performance->setExerciceMesured(null);
        $user->removePerformance($performance);

        $em->persist($user);
        $em->flush();
        // $em->remove($performance);
        // $em->flush();

        return $this->redirectToRoute('app_user');
    }

    // #[Route('/user/editPerf/{id}', name: 'app_user_editPerf')]
    // public function editPerf(Request $request, 
    //                         EntityManagerInterface $em,
    //                         Performance $performance = null): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     $perfForm = $this->createForm(PerfType::class, $performance);
    //     $perfForm->handleRequest($request);

    //     if ($perfForm->isSubmitted() && $perfForm->isValid()) {
    //         $em->persist($performance);
    //         $em->flush();
            
    //         return $this->redirectToRoute('app_user');
    //     }

    //     return $this->render('user/editPerf.html.twig', [
    //         'performance' => $performance,
    //         'perfForm' => $perfForm,
    //         'controller_name' => 'UserController',
    //     ]);
    // }


    
    
}
