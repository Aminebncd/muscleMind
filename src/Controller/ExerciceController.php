<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use App\Repository\PerformanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExerciceController extends AbstractController
{
    // for now, this function will be used to display the exercice page
    // listing all the exercices in the database
    #[Route('/exercice', name: 'app_exercice')]
    public function index(ExerciceRepository $exerciceRepository, PerformanceRepository $performanceRepository): Response
    {
        // gathers all exercices with their muscles
        $exercices = $exerciceRepository->findAllWithMuscles();
        
        // calculates the number of muscle groups
        $muscleGroups = [];
        foreach ($exercices as $exercice) {
            if ($exercice->getTarget()) {
                $muscleGroups[$exercice->getTarget()->getId()] = $exercice->getTarget();
            }
        }

        // if you want best performances for all exercises, you need to loop through them
        $bestPerformances = [];
        if ($this->getUser()) {
            foreach ($exercices as $exercice) {
                $bestPerformance = $performanceRepository->getBestPerformanceForExercise($exercice, $this->getUser());
                if ($bestPerformance) {
                    $bestPerformances[$exercice->getId()] = $bestPerformance;
                }
            }
        }

        return $this->render('exercice/index.html.twig', [
            'exercices' => $exercices,
            'muscleGroupsCount' => count($muscleGroups),
            'bestPerformances' => $bestPerformances
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

        $exerciceForm = $this->createForm(ExerciceType::class, $exercice);

        if ($exerciceForm->handleRequest($request)->isSubmitted() 
            && $exerciceForm->isValid()) {
            $em->persist($exercice);
            $em->flush();
            return $this->redirectToRoute('app_exercice');
        }

        return $this->render('admin/newExercice.html.twig', [
            'controller_name' => 'ExerciceController',
            'exerciceForm' => $exerciceForm->createView(),
        ]);
    }




    // this function will be used to display a single exercice
    #[Route('exercice/details/{id}', name: 'app_exercice_details')]
    public function detailsExercice(Exercice $exercice = null, PerformanceRepository $performanceRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$exercice) {
            return $this->redirectToRoute('app_exercice');
        }

        // get the best performance for this exercise and current user
        $bestPerformance = $performanceRepository->getBestPerformanceForExercise($exercice, $this->getUser());

        return $this->render('exercice/details.html.twig', [
            'controller_name' => 'ExerciceController',
            'exercice' => $exercice,
            'bestPerformance' => $bestPerformance,
        ]);
    }
    


    // this function will be used to delete an exercice
    #[Route('admin/exercice/delete/{id}', name: 'app_exercice_delete')]
    public function deleteExercice(Exercice $exercice = null,
                                    EntityManagerInterface $em): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$exercice) {
            return $this->redirectToRoute('app_exercice');
        }


        $em->remove($exercice);
        $em->flush();

        return $this->redirectToRoute('app_exercice');
    }
}
