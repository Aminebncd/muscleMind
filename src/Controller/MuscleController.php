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
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('muscle/index.html.twig', [
            'controller_name' => 'MuscleController',
        ]);
    }

    #[Route('/muscle/detailsMuscleGroup/{id}', name: 'app_muscleGroup_details')]
    public function detailsMuscleGroup(Request $request,
                                        MuscleRepository $mr): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('muscle/detailsMuscleGroup.html.twig', [
            'controller_name' => 'MuscleController',
            'MuscleGroup' => $muscleGroup,
        ]);
        // Blank for now
    }


    #[Route('/muscle/detailsMuscle/{id}', name: 'app_muscle_details')]
    public function detailsMuscle(Request $request,
                                MuscleRepository $mr): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('muscle/detailsMuscle.html.twig', [
            'controller_name' => 'MuscleController',
            'Muscle' => $muscle
        ]);
        
    }
}
