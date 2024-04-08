<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        $user = $this->getUser();
        $programs = $user->getPrograms();

        // dd($sessions);


        return $this->render('home/index.html.twig', [
            'user' => $user,
            'programs' => $programs,
            'controller_name' => 'UserController',
        ]);
    }
}
