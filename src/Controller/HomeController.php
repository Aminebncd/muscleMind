<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        $user = $this->getUser();
        $programs = $user->getPrograms();
        $sessions = $user->getSessions();

        // dd($sessions);


        return $this->render('home/index.html.twig', [
            'user' => $user,
            'sessions' => $sessions,
            'programs' => $programs,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/newSession', name: 'app_home_newSession')]
    public function newSession(Request $request,
                                EntityManagerInterface $em, 
                                Session $session = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        if (!$session) {
            $session = new session();
        }
        
        $isEdit = $session !== null;
    
        $formAddSession = $this->createForm(SessionType::class, $session);
        $formAddSession->handleRequest($request);

        if ($formAddSession->isSubmitted() 
            && $formAddSession->isValid()) {
            $session->setUser($user);
            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/newSession.html.twig', [
            'user' => $user,
            'formAddSession' => $formAddSession->createView(),
            'edit' => $isEdit,
            'controller_name' => 'HomeController',
        ]);
    }

}
