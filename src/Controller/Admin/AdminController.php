<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Calendar;

class AdminController extends AbstractDashboardController
{
    /**
     * @IsGranted("ROLE_SUPER_ADMIN")
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Pépinière <span class="text-small">administration</span>');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linktoDashboard('Menu principal', 'fa fa-home'),
            MenuItem::section('Blog'),
            MenuItem::linkToCrud('Articles', 'fa fa-newspaper', Article::class),
            MenuItem::linkToCrud('Categories', 'fa fa-cube', Category::class),
            MenuItem::linkToCrud('Calendrier', 'fa fa-calendar-week', Calendar::class)
        ];
    }
}
