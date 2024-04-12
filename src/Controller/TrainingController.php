<?php

namespace App\Controller;

use App\Form\ProgramType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MuscleGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrainingController extends AbstractController
{
    #[Route('/training', name: 'app_training')]
    public function index(Request $request, 
                            EntityManagerInterface $em, 
                            Program $program = null ): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // $muscleGroups = $mgr->findAll();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        return $this->render('training/index.html.twig', [
            // 'muscleGroups' => $muscleGroups,
            'formAddProgram' => $form,
            'controller_name' => 'TrainingController',
        ]);
    }
}
