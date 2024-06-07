<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PerfType;
use App\Form\UserType;
use App\Entity\Tracking;
use App\Form\TrackingType;
use App\Entity\Performance;
use App\Repository\UserRepository;
use App\Service\EquivalentService;
use App\Service\UserActivityService;
use App\Repository\SessionRepository;
use App\Repository\ExerciceRepository;
use App\Repository\TrackingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    
    private UserActivityService $userActivityService;

    public function __construct(UserActivityService $userActivityService)
    {
        $this->userActivityService = $userActivityService;
    }

    // gathers all the connected user's data to display them
    #[Route('/user/myProfile', name: 'app_user')]
    public function index(Request $request, 
                        UserRepository $ur,
                        SessionRepository $sr,
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
        
        $equiv = $this->displayEquivalent($user);
        $activity = $this->getActivity($user, $sr, 365);

        // dd($equiv);
        // dd($activity);

        $latestTracking = $tr->getLatest($user);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'equiv' => $equiv, 
            'activity' => $activity,
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



    // this function displays the equivalent (in object/things) of 
    // the user's score (in kilos, because we will NEVER use pounds or imperial units in this house)
    private function displayEquivalent(User $user)
    {
        $score = $user->getScore();
        return EquivalentService::getEquivalent($score);
    }

    private function getActivity(User $user, SessionRepository $sr, int $days = 365)
    {
        return UserActivityService::getUserActivity($user, $sr, $days);
    }







    #[Route('/user/updateUsername/{id}', name: 'app_user_updateUsername')]
    public function updateUsername(Request $request, 
                                UserRepository $ur,
                                EntityManagerInterface $em,
                                User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // dd($user->getUsername());

        if ($form->isSubmitted() 
            && $form->isValid() 
                && ($user->getUsername() !== $form->getData()->getUsername())) {
                    dd($form->getData());
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/updateUsername.html.twig', [
            'user' => $user,
            'updateUsernameForm' => $form,
            'controller_name' => 'UserController',
        ]);
    }


    // grants the admin role to a user
    #[Route('/admin/makeAdmin/{id}', name: 'app_user_makeAdmin')]
    public function makeAdmin(Request $request, 
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
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('app_user_list');
    }


    // grants the moderator role to a user
    #[Route('/admin/makeMod/{id}', name: 'app_user_makeMod')]
    public function makeMod(Request $request, 
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
        $user->setRoles(['ROLE_USER', 'ROLE_MODERATOR']);
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
    
}
