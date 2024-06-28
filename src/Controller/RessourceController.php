<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Ressource;
use App\Form\RessourceType;
use App\Repository\TagRepository;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RessourceController extends AbstractController
{
    // gathers all ressources and tags to display them
    // will probably add pagination later
    #[Route('/ressource', name: 'app_ressource')]
    public function index(RessourceRepository $rr,
                            TagRepository $tr,
                            PaginatorInterface $paginator,
                            Request $request): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        // $ressources = $rr->findAll();
        // $ressources = $rr->findBy([], ['createdAt' => 'DESC']);
        $ressources = $paginator->paginate(
            $rr->findBy([], ['createdAt' => 'DESC']),
            $request->query->getInt('page', 1),
            5
        );
        $tags = $tr->findAll();

        

        return $this->render('ressource/index.html.twig', [
            'ressources' => $ressources,
            'tags' => $tags,
            'controller_name' => 'RessourceController',
        ]);
    }
    


    // displays the content of a ressource
    #[Route('/ressource/details/{id}', name: 'app_ressource_detailsRessource')]
    public function detailsRessource(Ressource $ressource = null ): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        // dd($ressource);
        if (!$ressource) {
            return $this->redirectToRoute('app_ressource');
            // throw $this->createNotFoundException('The ressource does not exist');
        }
        
        return $this->render('ressource/detailsRessource.html.twig', [
            'ressource' => $ressource,
            'controller_name' => 'RessourceController',
        ]);
    }



    // displays the form to add or edit a ressource
    #[Route('/moderator/{id}/edit', name: 'app_ressource_edit')]
    #[Route('/moderator/new', name: 'app_ressource_new')]
    public function newEditRessource(Request $request,
                                        EntityManagerInterface $em,
                                        Ressource $ressource = null): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // same logic as in my TrainingController
        $isEdit = ($ressource !== null);

        if (!$ressource) {
            $ressource = new Ressource();
        }

        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource->setAuthor($this->getUser());
            // for now, all ressources are published
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

        return $this->render('admin/newRessource.html.twig', [
            'formAddRessource' => $form->createView(),
        ]);
    }



    // deletes a ressource
    #[Route('/ressource/{id}/delete', name: 'app_ressource_delete', methods: ['DELETE'])]
    public function deleteRessource(Ressource $ressource,
                                    EntityManagerInterface $em): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($ressource->getAuthor() !== $this->getUser() || !in_array('ROLE_MODERATOR', $this->getUser()->getRoles())){
            return $this->redirectToRoute('app_home');
        }

        // dd('prout');

        $em->remove($ressource);
        $em->flush();

        return $this->redirectToRoute('app_ressource');
    }



    // gathers a tag and its ressources to display them
    #[Route('/ressource/tag/{id}', name: 'app_ressource_detailsTag')]
    public function detailsTag(Tag $tag): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('ressource/detailsTag.html.twig', [
            'tag' => $tag,
            'controller_name' => 'RessourceController',
        ]);
    }


    
    // deletes a tag
    #[Route('/ressource/tag/{id}/delete', name: 'app_ressource_tag_delete')]
    public function deleteTag(Tag $tag,
                                EntityManagerInterface $em): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($ressource->getAuthor() !== $this->getUser() || !in_array('ROLE_MODERATOR', $this->getUser()->getRoles())){
            return $this->redirectToRoute('app_home');
        }

        $em->remove($tag);
        $em->flush();

        return $this->redirectToRoute('app_ressource');
    }





    #[Route('/favorite/add/{id}/', name: 'app_ressource_fav')]
    public function add(Ressource $ressource, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // dd('added');
        $user->addFavorite($ressource);
        $em->persist($user);
        $em->flush();
        
        return $this->render('ressource/detailsRessource.html.twig', [
            'ressource' => $ressource,
            'controller_name' => 'RessourceController',
        ]);
    }

    
    #[Route('/favorite/remove/{id}/', name: 'app_ressource_unfav')]
    public function remove(Ressource $ressource, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        // dd($user->getFavorites());

        // dd('removed');
        // var_dump($user->getFavorites());
        $user->removeFavorite($ressource);
        $em->persist($user);
        $em->flush();

        return $this->render('ressource/detailsRessource.html.twig', [
            'ressource' => $ressource,
            'controller_name' => 'RessourceController',
        ]);
    }


    
}
