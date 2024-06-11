<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Session;
use App\Form\SessionType;
use App\Form\ScheduleType;
use App\Repository\UserRepository;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    // lists every session and program created by the user
    // also my default route
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        $user = $this->getUser();
        // $programs = $user->getPrograms();
        $sessions = $user->getSessions();

        return $this->render('home/index.html.twig', [
            'user' => $user,
            'sessions' => $sessions,
            // 'programs' => $programs,
            // 'totalScore' => $totalScore,
            'controller_name' => 'HomeController',
        ]);
    }


    // commented this one so i can still have it in case the one i'm working on doesn't work
    // will eventually delete it
    // schedule a new training session
    // #[Route('/newSession', name: 'app_home_newSession')]
    // public function newSession(Request $request,
    //                             EntityManagerInterface $em, 
    //                             Session $session = null): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     $user = $this->getUser();

    //     if (!$session) {
    //         $session = new session();
    //     }
        
    //     $isEdit = $session !== null;
    
    //     $formAddSession = $this->createForm(SessionType::class, $session);
    //     $formAddSession->handleRequest($request);

    //     if ($formAddSession->isSubmitted() 
    //         && $formAddSession->isValid()) {
    //         $session->setUser($user);
    //         $em->persist($session);
    //         $em->flush();

    //         return $this->redirectToRoute('app_home');
    //     }

    //     return $this->render('home/newSession.html.twig', [
    //         'user' => $user,
    //         'formAddSession' => $formAddSession->createView(),
    //         'edit' => $isEdit,
    //         'controller_name' => 'HomeController',
    //     ]);
    // }


    // schedule a new training session
    // with the added option to schedule it for every selected day 
    // ie : scheduling Program A for every monday in the next 6 months
    // i will try to make it annual so each year you can either reprogram everything
    // or try a new workout split (program)

    #[Route('/newSession', name: 'app_home_newSession')]
    public function newSession(Request $request,
                                EntityManagerInterface $em, 
                                SessionRepository $sessionRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        $scheduleForm = $this->createForm(ScheduleType::class);
        $scheduleForm->handleRequest($request);

        if ($scheduleForm->isSubmitted() && $scheduleForm->isValid()) {
            $formData = $scheduleForm->getData();

            // as always, i gather the formData
            $selectedProgram = $formData['program'];
            $selectedDaysOfWeek = $formData['daysOfWeek'];

            // i initialise the starting point
            $startDate = new \DateTimeImmutable();

            // then i determine the endpoint, 12 months from now
            // $endDate = $startDate->add(new \DateInterval('P12M'));

            // this one is just for testing purposes
            $endDate = $startDate->add(new \DateInterval('P1M'));

            // i loop on every monday from start to end
            $currentDate = $startDate;
            while ($currentDate <= $endDate) {
                // verifies if the selected day exists in our choice array
                // i also verify if the day already has a session scheduled
                if (in_array($currentDate->format('N'), $selectedDaysOfWeek )
                    && (!$sessionRepository->findOneBy(['dateSession' => $currentDate])) ) {
                    // Create a new session
                    $session = new Session();
                    $session->setUser($user);
                    $session->setProgram($selectedProgram);
                    $session->setDateSession($currentDate);
                    
                    $em->persist($session);
                }
                // then i go to the next day
                $currentDate = $currentDate->add(new \DateInterval('P1D'));
            }

            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/newSession.html.twig', [
            'user' => $user,
            'scheduleForm' => $scheduleForm->createView(),
            'controller_name' => 'HomeController',
        ]);
    }


    
    // deletes a Session, pretty straightforward
    #[Route('/delete/{id}', name: 'app_home_deleteSession')]
    public function removeSession(Session $session = null, 
                            EntityManagerInterface $em,
                            Request $request)
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $em->remove($session);
        $em->flush();
        
        return $this->redirectToRoute('app_home');
    }

}
