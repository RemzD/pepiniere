<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\ArticleRepository;
use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $repo) : Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'articles' => $repo->findBy([], ['createdAt' => 'DESC'])
        ]);
    }

    /**
     * @Route("/blog", name="blog", methods={"GET"})
     */

    public function showBlog(ArticleRepository $repo) : Response
    {
        
        return $this->render('site/blog.html.twig', ['articles' => $repo->findBy([], ['createdAt' => 'DESC'])]);
    }

    /**
     * @Route("/blog/{id<\d+>}", name="show_article", methods={"GET"})
     */

    public function showArticle(Article $article): Response
    {
        return $this->render('site/article.html.twig', compact('article'));
    }


    /**
     * @Route("/reservation", name="show_calendar")
     */
    public function showCalendar(CalendarRepository $calendar, Request $request, ContactNotification $notification): Response
    {

        
        $events = $calendar->findAll();

        $bookings = [];
        foreach($events as $event){
            $bookings[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d'),
                'end' => $event->getEnd()->format('Y-m-d'),
                'all_day' => $event->getAllDay(),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor()
            ];
        }

        $data = json_encode($bookings);

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success', 'Votre demande a bien été envoyée, une réponse vous sera apportée dans les plus brefs délais');
            $this->redirectToRoute('show_calendar');
            
        }

        $formView = $form->createView();
        
        return $this->render('site/calendar.html.twig', compact('data', 'formView'));
    }
}
