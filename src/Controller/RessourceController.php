<?php

namespace App\Controller;

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

        $ressources = $rr->findAll();
        $tags = $tr->findAll();


        return $this->render('ressource/index.html.twig', [
            'ressources' => $ressources,
            'tags' => $tags,
            'controller_name' => 'RessourceController',
        ]);
    }
}
