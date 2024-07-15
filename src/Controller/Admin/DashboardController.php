<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Profile;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
   
        
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(ProfileCrudController::class)->generateUrl());

       
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet A Rendre Symfony');
    }

    public function configureMenuItems(): iterable
    {
        //menu du dashboard à personnalisé
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Profile', 'fa fa-tags', Profile::class);
        yield MenuItem::linkToCrud('Contact', 'fa fa-tags', Contact::class);
    }
}
