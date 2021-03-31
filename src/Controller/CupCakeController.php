<?php

namespace App\Controller;

use App\Repository\CupcakeRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CupCakeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('cup_cake/accueil.html.twig', [
            'controller_name' => 'CupCakeController',
        ]);
    }

    /**
     * @Route("/lescupcakes", name="cupcakes")
     */
    public function cupcake(CupcakeRepository $repository, CategorieRepository $repositoryCat): Response
    {
        $cupcakes = $repository->findBy([],['id'=> 'DESC']);
        $categories = $repositoryCat->findAll();
        return $this->render('cup_cake/cupcakes.html.twig', [
            'cupcakes'=>$cupcakes,
            'categories'=>$categories,
            
            ]);
    }

    /**
     * @Route("/cupcake/{id}", name="cupcake_id")
     */
    public function cupcakeId($id, CupcakeRepository $repository): Response
    {
        $cupcake = $repository->find($id);
        return $this->render('cup_cake/cupcake_id.html.twig', [
            'cupcake'=> $cupcake,
        ]);

    }


    /**
     * @Route("/dejauncompte", name="dejauncompte")
     */
    public function redirectionSecu(): Response
    {
        return $this->render('cup_cake/dejauncompte.html.twig', [
            'controller_name' => 'CupCakeController',
        ]);
    }

    /**
     * @Route("/cup_cake/{categorie}", name="filtreCategorie")
     */
    public function filtreDeCategorie(CupcakeRepository $repository, $categorie, CategorieRepository $repositoryCat): Response
    {
        $cupcakes = $repository->getCupcakeParCategorie($categorie);
        $categories = $repositoryCat->findAll();
        return $this->render('cup_cake/cupcakes.html.twig', [
            'cupcakes'=>$cupcakes,
            'categories'=>$categories,
            'isCategorie'=>true,
        ]);
        
    }

    
}
