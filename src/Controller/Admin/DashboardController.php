<?php

namespace App\Controller\Admin;

use App\Entity\Etat;
use App\Entity\User;
use App\Entity\Hotel;
use App\Entity\Theme;
use App\Entity\Nuites;
use App\Entity\Atelier;
use App\Entity\Chambre;
use App\Entity\Vacation;
use App\Entity\Inscription;
use App\Entity\Restauration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MDLAP 2023');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToUrl('Accueil', 'fa fa-home', "/");
        yield MenuItem::linkToDashboard('Dashboard', 'fas fa-list');

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Atelier', 'fas fa-palette', Atelier::class);
            yield MenuItem::linkToCrud('Theme', 'fas fa-masks-theater', Theme::class);
            yield MenuItem::linkToCrud('Vacation', 'fas fa-calendar-days', Vacation::class);
            yield MenuItem::linkToCrud('Chambre', 'fas fa-bed', Chambre::class);
            yield MenuItem::linkToCrud('Hotel', 'fas fa-bell-concierge', Hotel::class);
            yield MenuItem::linkToCrud('Restauration', 'fas fa-utensils', Restauration::class);
            yield MenuItem::linkToCrud('Inscription', 'fas fa-pen-clip', Inscription::class);
            yield MenuItem::linkToCrud('Etat', 'fas fa-list-check', Etat::class);
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        } elseif($this->isGranted('ROLE_USER')) {
            yield MenuItem::linkToCrud('Atelier', 'fas fa-palette', Atelier::class);
            yield MenuItem::linkToCrud('Theme', 'fas fa-masks-theater', Theme::class);
            yield MenuItem::linkToCrud('Vacation', 'fas fa-calendar-days', Vacation::class);
        }
    }
}
