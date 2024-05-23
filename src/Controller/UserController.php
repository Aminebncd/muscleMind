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

        $sessions = $user->getSessions();
        $totalScore = 0;
        $now = new \DateTime;

        foreach ($sessions as $session) {
            // dd($session);
            if($session->getDateSession() <= $now) {
                $program = $session->getProgram();
                $workoutPlans = $program->getWorkoutPlans();
                foreach ($workoutPlans as $workoutPlan) {
                    $totalScore += ($workoutPlan->getWeightsUsed() * $workoutPlan->getNumberOfRepetitions());
                }
            }
        }
        $user->setScore($totalScore);
        $em->persist($user);
        $em->flush();

        // dd($user->getScore());

        $latestTracking = $tr->getLatest($user);
        // dd($latestTracking->getWeight());

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'latestTracking' => $latestTracking, 
            'controller_name' => 'UserController',
        ]);
    }


    #[Route('/admin/deleteUser/{id}', name: 'app_user_delete')]
    public function deleteUser(Request $request, 
                            UserRepository $ur,
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('app_user_list');
    }

    // #[Route('/user/editUser/{id}', name: 'app_user_edit')]
    // public function editUser(Request $request, 
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
    //         $em->persist($user);
    //         $em->flush();
            
    //         return $this->redirectToRoute('app_user_list');
    //     }

    //     return $this->render('user/editUser.html.twig', [
    //         'user' => $user,
    //         'userForm' => $userForm,
    //         'controller_name' => 'UserController',
    //     ]);
    // }

    



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



    #[Route('/user/newPerf', name: 'app_user_newPerf')]
    public function newPerf(Request $request,
                            Performance $perf,
                            EntityManagerInterface $em, 
                            // ExerciceRepository $er,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // $exercices = $er->findAll();
        $perf = new Performance();

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


    #[Route('/user/newTrack', name: 'app_user_newTrack')]
    public function newtracking(Request $request,
                            Tracking $tracking,
                            EntityManagerInterface $em, 
                            // ExerciceRepository $er,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // $exercices = $er->findAll();
        $tracking = new Tracking();

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

    // #[Route('/user/editTrack/{id}', name: 'app_user_editTrack')]
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
