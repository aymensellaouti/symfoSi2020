<?php

namespace App\Controller\Admin;

use App\Entity\Hobbie;
use App\Entity\Job;
use App\Entity\Personne;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration de la plateforme');
    }

    public function configureMenuItems(): iterable
    {
        return [
        MenuItem::linkToCrud('Hobbies', 'fa fa-tags', Hobbie::class),
        MenuItem::linkToCrud('Jobs', 'fa fa-tags', Job::class),
        MenuItem::linkToCrud('Personnes', 'fa fa-tags', Personne::class),
        ];
    }
}
