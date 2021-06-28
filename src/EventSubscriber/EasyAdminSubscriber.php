<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityPersistedEvent::class => ['setUpdatedAt'],
            BeforeEntityPersistedEvent::class => ['setUser'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
            if($entity instanceof Article){
                $entity->setCreatedAt( new \DateTime('now'));
            }
    }


    public function setUpdatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
            if($entity instanceof Article){
                $entity->setUpdatedAt(new \DateTime('now'));
            }
    }


    public function setUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
            if($entity instanceof Article){
                $entity->setUser($this->security->getUser());
            }
    }
}