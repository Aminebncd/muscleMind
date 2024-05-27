<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Repository\TagRepository;
use App\Repository\RessourceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RessourceController extends AbstractController
{
    #[Route('/ressource', name: 'app_ressource')]
    public function index(RessourceRepository $rr,
                            TagRepository $tr,
                            Request $request): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        $ressources = $rr->findAll();
        $tags = $tr->findAll();


        return $this->render('ressource/index.html.twig', [
            'ressources' => $ressources,
            'tags' => $tags,
            'controller_name' => 'RessourceController',
        ]);
    }
    
    #[Route('/ressource/{id}', name: 'app_ressource_show')]
    public function show(Ressource $ressource = null ): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        // dd($ressource);
        if (!$ressource) {
            throw $this->createNotFoundException('The ressource does not exist');
        }
        
        return $this->render('ressource/show.html.twig', [
            'ressource' => $ressource,
            'controller_name' => 'RessourceController',
        ]);
    }

    #[Route('/ressource/{id}/edit', name: 'app_ressource_edit')]
    #[Route('/ressource/new', name: 'app_ressource_new')]
    public function newEditRessource(Request $request): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$ressource) {
            $ressource = new Ressource();
        }

        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource->setCreatedAt(new \DateTime());
            $ressource->setUpdatedAt(new \DateTime());
            $ressource->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ressource);
            $entityManager->flush();

            return $this->redirectToRoute('app_ressource');
        }

        return $this->render('ressource/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
}
