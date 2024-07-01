<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Session;

use App\Form\AutoScheduleType;
use App\Form\ManualScheduleType;
use App\Repository\UserRepository;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $security;
    private $sessionRepository;

    public function __construct(Security $security, SessionRepository $sessionRepository)
    {
        $this->security = $security;
        $this->sessionRepository = $sessionRepository;
    }

    #[Route('/', name: 'app_landing')]
    public function landing(): Response
    {
        return $this->render('home/landing.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/sessions', name: 'app_home_sessions')]
    public function sessions(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_landing');
        }

        $user = $this->getUser();
        $sessions = $user->getSessions();

        return $this->render('home/sessions.html.twig', [
            'user' => $user,
            'sessions' => $sessions,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/calendar', name: 'app_calendar')]
    public function calendar(): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse([]);
        }

        $sessions = $user->getSessions();

        $events = [];
        foreach ($sessions as $session) {
            $events[] = [
                'title' => (string) $session->getProgram(),
                'start' => $session->getDateSession()->format('Y-m-d H:i:s'),
                'backgroundColor' => 'red',
                'borderColor' => 'red'
            ];
        }

        return new JsonResponse($events);
    }




    // lists every session and program created by the user
    // also my default route
    #[Route('/home', name: 'app_home')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_landing');
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

    #[Route('/newSession', name: 'app_home_newSession')]
    public function newSession(Request $request, 
                                EntityManagerInterface $em, 
                                SessionRepository $sessionRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        // Forms
        $manualForm = $this->createForm(ManualScheduleType::class);
        $autoForm = $this->createForm(AutoScheduleType::class);

        $manualForm->handleRequest($request);
        $autoForm->handleRequest($request);

        // single date planning
        if ($manualForm->isSubmitted() && $manualForm->isValid()) {
            $formData = $manualForm->getData();
            $dates = $formData['dates'];
            $program = $formData['program'];

            foreach ($dates as $date) {
                if (!$sessionRepository->findOneBy(['dateSession' => $date, 'user' => $user])) {
                    $session = new Session();
                    $session->setUser($user);
                    $session->setProgram($program);
                    $session->setDateSession($date);
                    $em->persist($session);
                }
            }

            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        // batch planning
        if ($autoForm->isSubmitted() && $autoForm->isValid()) {
            $formData = $autoForm->getData();
            $selectedProgram = $formData['program'];
            $selectedDaysOfWeek = $formData['daysOfWeek'];
            $duration = $formData['duration'];

            // just to test
            // $startDate = new \DateTimeImmutable('2024-2-14');
            $startDate = new \DateTimeImmutable();
            $endDate = $startDate->add(new \DateInterval($duration));

            $currentDate = $startDate;
            while ($currentDate <= $endDate) {
                if (in_array($currentDate->format('N'), $selectedDaysOfWeek)
                    && !$sessionRepository->findOneBy(['dateSession' => $currentDate, 'user' => $user])) {
                    $session = new Session();
                    $session->setUser($user);
                    $session->setProgram($selectedProgram);
                    $session->setDateSession($currentDate);
                    $em->persist($session);
                }
                $currentDate = $currentDate->add(new \DateInterval('P1D'));
            }

            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/newSession.html.twig', [
            'user' => $user,
            'manualForm' => $manualForm->createView(),
            'autoForm' => $autoForm->createView(),
        ]);
    }

    // returns the edit page of a session
    #[Route('/editSession/{id}', name: 'app_home_editSession')]
    public function editSession(Session $session = null, 
                                EntityManagerInterface $em, 
                                Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        if ($session->getUser() != $user || !$session) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(ManualScheduleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($session);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/editSession.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
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


    // returns the settings page
    #[Route('/settings', name: 'app_settings')]
    public function settings(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_landing');
        }

        $user = $this->getUser();

        return $this->render('settings/index.html.twig', [
            'user' => $user,
            'controller_name' => 'HomeController',
        ]);
    }

    // link to my legal mentions
    #[Route('/legal', name: 'app_legal')]
    public function legalMentions(): Response
    {
        return $this->render('legal/legalMentions.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
