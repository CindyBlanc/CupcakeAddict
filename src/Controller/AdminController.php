<?php

namespace App\Controller;

use App\Entity\Cupcake;
use App\Form\CupcakeType;
use App\Entity\Utilisateur;
use App\Repository\CupcakeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{ 
    private $security;

    public function __construct(Security $security) {
        $this->security = $security;

    }

    /**
     * @Route("/user", name="user")
     */
    public function index(CupcakeRepository $repository): Response
    {
        $cupcakes =$repository->findall();
        return $this->render('user/compte.html.twig', [
            'cupcakes' => $cupcakes,
        ]);
    }
    
    /**
     * @Route("/user/creation", name="creationCupcake")
     * @Route("/user/cupcake/{id}", name="modificationCupcake", methods="GET|POST")
     */
    public function action(Cupcake $cupcake = null, Request $request, EntityManagerInterface $entityManager): Response
    {  
            if(!$cupcake){
                $cupcake = new Cupcake();
            }
            $form = $this->createForm(CupcakeType::class,$cupcake);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $user=$this->security->getUser();
                $cupcake->setAuteur($user);
                
                $modif = $cupcake->getId() !== null; // On verifie si l'ID existe
                // dd($cupcake);

                $entityManager->persist($cupcake);
                $entityManager->flush();
                $this->addFlash("success", ($modif) ? "La modification a été effectuée" : "L'ajout a été effectuée");
                // Message a afficher : success. si $modif est vrai (?) alors message (:) sinon ce message
                return $this->redirectToRoute("user");
            }
            return $this->render('user/action.html.twig', [
                'cupcake'=>$cupcake,
                'form'=> $form->createView(),
                "isModification" => $cupcake->getid() !== null
            ]);
    }

    /**
     * @Route("user/cupcake/{id}", name="supprimerCupcake", methods="delete")
     */
    public function delete(Cupcake $cupcake, Request $request, EntityManagerInterface $entityManager): Response
            { 
                if($this->isCsrfTokenValid("SUP". $cupcake->getId(),$request->get('_token'))){
                    $entityManager->remove($cupcake);
                    $entityManager->flush();
                    // Stock le message dès qu'un flush est fait 
                    $this->addFlash("success", "La suppression a été effectuée");
                    return $this->redirectToRoute("user");
                }    
            }


}
