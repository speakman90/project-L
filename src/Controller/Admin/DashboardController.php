<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\About;
use App\Entity\Projets;
use App\Entity\Prestations;
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

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(User::class);
        // return $this->redirect($adminUrlGenerator->setController(AboutCrudController::class)->generateUrl());

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
            ->setTitle('Backoffice');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Menu principal', 'fa fa-home'),

            MenuItem::linkToCrud('A propos', 'fas fa-file-lines', About::class),
            MenuItem::linkToCrud('Prestations', 'fas fa-handshake', Prestations::class),
            MenuItem::linkToCrud('Projets', 'fas fa-compass-drafting', Projets::class),
        ];
    }
}
