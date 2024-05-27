<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Form\RessourceType;
use App\Repository\TagRepository;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    
    #[Route('/ressource/details/{id}', name: 'app_ressource_show')]
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
    public function newEditRessource(Request $request,
                                        EntityManagerInterface $em,
                                        Ressource $ressource = null): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $isEdit = ($ressource !== null);

        if (!$ressource) {
            $ressource = new Ressource();
        }

        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ressource->setAuthor($this->getUser());
            $ressource->setIspublished(true);

            if (!$isEdit) {
                $ressource->setCreatedAt(new \DateTime());
            } else {
                $ressource->setUpdatedAt(new \DateTime());
            }

            $em->persist($ressource);
            $em->flush();

            return $this->redirectToRoute('app_ressource');
        }

        return $this->render('ressource/new.html.twig', [
            'formAddRessource' => $form->createView(),
        ]);
    }

    
}
