<?php

namespace App\Controller;

use App\Repository\CupcakeRepository;
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
    public function cupcake(CupcakeRepository $repository): Response
    {
        $cupcakes = $repository->findAll();
        return $this->render('cup_cake/cupcakes.html.twig', [
            'cupcakes'=>$cupcakes,

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


}
