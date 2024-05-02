<?php

namespace App\Controller;

use App\Entity\MuscleGroup;
use App\Repository\MuscleRepository;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
                                        MuscleRepository $mr,
                                        MuscleGroupRepository $mgr,
                                        MuscleGroup $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        dd($id);

        return $this->render('muscle/detailsMuscleGroup.html.twig', [
            'controller_name' => 'MuscleController',
            'MuscleGroup' => $muscleGroup,
        ]);
    }


    // #[Route('/muscle/detailsMuscle/{id}', name: 'app_muscle_details')]
    // public function detailsMuscle(Request $request,
    //                             MuscleRepository $mr): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     return $this->render('muscle/detailsMuscle.html.twig', [
    //         'controller_name' => 'MuscleController',
    //         'Muscle' => $muscle
    //     ]);
        
    // }
}
