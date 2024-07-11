<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionController extends AbstractController
{
    /**
     * @Route("/not-found", name="app_not_found")
     */
    public function notFound()
    {
        return $this->render('security/error404.html.twig');    
    }
}