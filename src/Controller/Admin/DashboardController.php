<?php

namespace App\Controller\Admin;

use App\Entity\Cupcake;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\CupcakeCrudController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\CategorieCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(CupcakeCrudController::class)->generateUrl());    
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="./image/Logo_Admin.png" style="width: 100px">');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::section('Important');
        yield MenuItem::linktoRoute('Mon site', 'fa fa-home', 'user');
        yield MenuItem::linktoCrud('Recette', 'fas fa-pie', Cupcake::class);
        yield MenuItem::linktoCrud('Catégorie', 'fa fa-file', Categorie::class);
        yield MenuItem::linktoCrud('Utilisateur', 'fas fa-users', Utilisateur::class);


    }
}
