<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExerciceController extends AbstractController
{
    #[Route('/exercice', name: 'app_exercice')]
    public function index(): Response
    {
        return $this->render('exercice/index.html.twig', [
            'controller_name' => 'ExerciceController',
        ]);
    }

    // this function will be used to create a new exercice
    #[Route('admin/exercice/new', name: 'app_exercice_new')]
    #[Route('admin/exercice/edit/{id}', name: 'app_exercice_edit')]
    public function newEditExercice(Request $request,
                                    Exercice $exercice = null,
                                    EntityManagerInterface $em): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$exercice) {
            $exercice = new Exercice();
        }

        return $this->render('exercice/new.html.twig', [
            'controller_name' => 'ExerciceController',
        ]);
    }
}
