<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MuscleController extends AbstractController
{
    #[Route('/muscle', name: 'app_muscle')]
    
    public function index(): Response
    {
        return $this->render('muscle/index.html.twig', [
            'controller_name' => 'MuscleController',
        ]);
    }
}
