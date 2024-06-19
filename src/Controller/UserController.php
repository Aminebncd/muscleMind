<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PerfType;
use App\Form\UserType;
use App\Entity\Tracking;
use App\Form\TrackingType;
use App\Entity\Performance;
use App\Service\ChartService;
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
    private $chartService;

    public function __construct(ChartService $chartService)
    {
        $this->chartService = $chartService;
    }

    // gathers all the connected user's data to display them
    #[Route('/user/myProfile', name: 'app_user')]
    public function index(Request $request, 
                        UserRepository $ur,
                        SessionRepository $sr,
                        EntityManagerInterface $em,
                        TrackingRepository $tr,
                        ChartService $chartService): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $oldScore = $user->getScore();  

        $this->updateScore($user);

        $newScore = $user->getScore(); 
        $scoreDifference = $newScore - $oldScore;  

        $em->persist($user);
        $em->flush();
        
        $equiv = $this->displayEquivalent($user);
        $activity = $this->getActivity($user, $sr, 365);
        $test = $this->getActivityLevel($user, $sr);

        $trackingChart = $this->chartService->getTrackingChart($user);
        $performanceChart = $this->chartService->getPerformanceChart($user);

        $latestTracking = $tr->getLatest($user);
        $bmr = $this->calculateBMR($user, $tr, $sr);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'equiv' => $equiv, 
            'activity' => $activity,
            'bmr' => $bmr,
            'latestTracking' => $latestTracking, 
            'trackingChart' => $trackingChart,
            'performanceChart' => $performanceChart,
            'oldScore' => $oldScore, 
            'newScore' => $newScore,   
            'scoreDifference' => $scoreDifference
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

    // this function gathers the user's activity for 
    // the last x days and returns it
    private function getActivity(User $user, SessionRepository $sr, int $days = 365)
    {
        return UserActivityService::getUserActivity($user, $sr, $days);
    }







    #[Route('/user/updateProfile/{id}', name: 'app_user_updateProfile')]
    public function updateProfile(Request $request, 
                                UserRepository $ur,
                                EntityManagerInterface $em,
                                User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() 
            && $form->isValid()) {

                if ($form->getData()->getSex() === 'I would rather not say' 
                || $form->getData()->getDateOfBirth() === null){
                    $user->setSex(null);
                    $user->setDateOfBirth(null);
                }

            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('app_user');
        }

        return $this->render('settings/updateProfile.html.twig', [
            'user' => $user,
            'updateProfileForm' => $form,
            'controller_name' => 'UserController',
        ]);
    }

    // no
    // // grants the admin role to a user
    // #[Route('/admin/makeAdmin/{id}', name: 'app_user_makeAdmin')]
    // public function makeAdmin(Request $request, 
    //                             UserRepository $ur,
    //                             EntityManagerInterface $em,
    //                             User $user = null): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }
    //     if (!$user) {
    //         return $this->redirectToRoute('app_user_list');
    //     }
    //     $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
    //     $em->persist($user);
    //     $em->flush();
    //     return $this->redirectToRoute('app_user_list');
    // }

    // absolutely not
    // // grants the moderator role to a user
    // #[Route('/admin/makeMod/{id}', name: 'app_user_makeMod')]
    // public function makeMod(Request $request, 
    //                             UserRepository $ur,
    //                             EntityManagerInterface $em,
    //                             User $user = null): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }
    //     if (!$user) {
    //         return $this->redirectToRoute('app_user_list');
    //     }
    //     $user->setRoles(['ROLE_USER', 'ROLE_MODERATOR']);
    //     $em->persist($user);
    //     $em->flush();
    //     return $this->redirectToRoute('app_user_list');
    // }
    

    // lists the existing users
    #[Route('/admin/listUsers', name: 'app_user_list')]
    public function listUsers(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $users = $ur->findAll();

        return $this->render('admin/listUsers.html.twig', [
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


        return $this->render('admin/detailsUser.html.twig', [
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
                            ExerciceRepository $er, 
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$perf) {
            $perf = new Performance();
        }

        // we gather the exercices ordered by name
        $exercices = $er->findBy([], ['exerciceName' => 'ASC']);

        $perfForm = $this->createForm(PerfType::class, $perf, [
            'exercices' => $exercices,
        ]);
        $perfForm->handleRequest($request);

        if ($perfForm->isSubmitted() && $perfForm->isValid()) {
            $perf->setUserPerforming($this->getUser());
            $perf->setDateOfPerformance(new \DateTime);
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

        if ($this->getUser()->getSex() === null || $this->getUser()->getDateOfBirth() === null){
            $this->addflash('error', 'Please fill in your profile first, the data will only be used to give you numerical insights on your progress and metabolical needs.');
            return $this->redirectToRoute('app_user_updateProfile', ['id' => $this->getUser()->getId()]);
        }

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


    // this function will calculate the user's BMI
    // and return it
    private function calculateBMI(User $user, TrackingRepository $tr,
    )
    {
        $height = ($tr->getLatest($user)->getHeight()/100);
        $weight = $tr->getLatest($user)->getWeight();
        $bmi = round(($weight / ($height * $height)), 1);
        // $bmi = ($weight / ($height * $height));
        return $bmi;
    }


    // this function will calculate the user's BMR
    // this function will also take into account the user's last week of activity (if there is any)
    // to multiply the BMR by the activity factor
    // hence giving the user a more accurate BMR
    // and return it
    private function calculateBMR(User $user, TrackingRepository $tr, SessionRepository $sr)
    {
        if ( $tr->getLatest($user) === null
            || $user->getSex() === null
                || $user->getDateOfBirth() === null){
                    $this->addflash('error', 'Please fill in your profile first, the data will only be used to give you numerical insights on your progress and metabolical needs.');
                    return $this->redirectToRoute('app_user_updateProfile', ['id' => $this->getUser()->getId()]);
        }

        $height = $tr->getLatest($user)->getHeight();
        $weight = $tr->getLatest($user)->getWeight();
        $age = $user->getDateOfBirth()->diff(new \DateTime)->y;
        $sex = $user->getSex();

        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age);

        $bmr *= $this->getActivityLevel($user, $sr);

        return $bmr;
    }

    
    // to apply a coefficient to the user's BMR (calculated in the UserController)
    // i'll take the user's last week of activity and check how many sessions he programmed
    // by checking with a simple count how many were programmed
    // using that i'll make a switch that'll apply a coefficient to the BMR
    private function getActivityLevel(User $user, SessionRepository $sr)
    {
        $activityLevel = 0;
        $today = new \DateTime();
        $lastWeek = $today->modify('-7 days');
        // dd($today);

        $sessions = $sr->findByUserAndDateRange($user, $lastWeek, new \DateTime());

        $activityLevel = count($sessions);
        
        switch ($activityLevel) {
            case 0:
                return 1;
                break;
            case 1:
                return 1.1;
                break;
            case 2:
                return 1.22;
                break;
            case 3:
                return 1.33;
                break;
            case 4:
                return 1.44;
                break;
            case 5:
                return 1.55;
                break;
            default:
                return 1;
                break;
        }
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

    // lists every entry of the user's trackings and performances
    #[Route('/user/listEntries/{id}', name: 'app_user_listEntries')]
    public function listEntries(Request $request, User $user): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $performances = $this->getUser()->getPerformances();
        $trackings = $this->getUser()->getTrackings();

        return $this->render('user/listEntries.html.twig', [
            'trackings' => $trackings,
            'performances' => $performances,
            'controller_name' => 'UserController',
        ]);
    }

    // this function deletes every performance of the user
    #[Route('/user/deleteAllPerf/{id}', name: 'app_user_deleteAllPerf')]
    public function deleteAllPerf(Request $request, 
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $performances = $this->getUser()->getPerformances();

        foreach ($performances as $performance) {
            $this->getUser()->removePerformance($performance);
            $em->remove($performance);
        }

        $em->persist($this->getUser());
        $em->flush();

        return $this->redirectToRoute('app_user');
    }

    // this function deletes every tracking of the user
    #[Route('/user/deleteAllTrack/{id}', name: 'app_user_deleteAllTrack')]
    public function deleteAllTrack(Request $request, 
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $trackings = $this->getUser()->getTrackings();

        foreach ($trackings as $tracking) {
            $this->getUser()->removeTracking($tracking);
            $em->remove($tracking);
        }

        $em->persist($this->getUser());
        $em->flush();

        return $this->redirectToRoute('app_user');
    }

    // this function deletes every session of the user
    #[Route('/user/deleteAllSessions/{id}', name: 'app_user_deleteAllSessions')]
    public function deleteAllSessions(Request $request, 
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $sessions = $this->getUser()->getSessions();

        foreach ($sessions as $session) {
            $this->getUser()->removeSession($session);
            $em->remove($session);
        }

        $em->persist($this->getUser());
        $em->flush();

        return $this->redirectToRoute('app_user');
    }
    

    // this function deletes every program of the user
    #[Route('/user/deleteAllPrograms/{id}', name: 'app_user_deleteAllPrograms')]
    public function deleteAllPrograms(Request $request, 
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $programs = $this->getUser()->getPrograms();

        foreach ($programs as $program) {
            $this->getUser()->removeProgram($program);
            $em->remove($program);
        }

        $em->persist($this->getUser());
        $em->flush();

        return $this->redirectToRoute('app_user');
    }
    
}
