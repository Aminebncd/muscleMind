<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/admin/listUsers', name: 'app_user')]
    public function index(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $users = $ur->findAll();

        return $this->render('user/index.html.twig', [
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

        $user = $ur->findAll();

        return $this->render('user/details.html.twig', [
            'user' => $user,
            // 'sessions' => $sessions,
            'controller_name' => 'UserController',
        ]);
    }

    
}
