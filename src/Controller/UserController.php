<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PerfType;
use App\Entity\Tracking;
use App\Form\TrackingType;
use App\Entity\Performance;
use App\Repository\UserRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    
    #[Route('/user/myProfile', name: 'app_user')]
    public function index(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'controller_name' => 'UserController',
        ]);
    }



    #[Route('/admin/listUsers', name: 'app_user_list')]
    public function listUsers(Request $request, UserRepository $ur): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $users = $ur->findAll();

        return $this->render('user/listUsers.html.twig', [
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


        return $this->render('user/detailsUser.html.twig', [
            'user' => $user,
            // 'sessions' => $sessions,
            'controller_name' => 'UserController',
        ]);
    }



    #[Route('/user/newPerf', name: 'app_user_newPerf')]
    public function newPerf(Request $request,
                            Performance $perf,
                            EntityManagerInterface $em, 
                            // ExerciceRepository $er,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // $exercices = $er->findAll();
        $perf = new Performance();

        $perfForm = $this->createForm(PerfType::class, $perf);
        $perfForm->handleRequest($request);

        if ($perfForm->isSubmitted() && $perfForm->isValid()) {
            $perf->setUserPerforming($this->getUser());
            
            $em->persist($perf);
            $em->flush();
            
            return $this->redirectToRoute('app_user');
        }


        return $this->render('user/newPerf.html.twig', [
            'user' => $user,
            // 'exercices' => $exercices,
            'perfForm' => $perfForm,
            'controller_name' => 'UserController',
        ]);
    }


    #[Route('/user/newtracking', name: 'app_user_newtracking')]
    public function newtracking(Request $request,
                            Tracking $tracking,
                            EntityManagerInterface $em, 
                            // ExerciceRepository $er,
                            User $user = null): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // $exercices = $er->findAll();
        $tracking = new Tracking();

        $trackingForm = $this->createForm(TrackingType::class, $tracking);
        $trackingForm->handleRequest($request);

        if ($trackingForm->isSubmitted() && $trackingForm->isValid()) {
            $tracking->setUserTracked($this->getUser());
            $em->persist($tracking);
            $em->flush();
            
            return $this->redirectToRoute('app_user');
        }


        return $this->render('user/newtracking.html.twig', [
            'user' => $user,
            // 'exercices' => $exercices,
            'trackingForm' => $trackingForm,
            'controller_name' => 'UserController',
        ]);
    }



    
}
