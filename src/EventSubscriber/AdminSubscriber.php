<?php

namespace App\EventSubscriber;

use App\Model\TimestampedInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
       return [
         BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
         BeforeEntityUpdatedAtEvent::class => ['setEntityUpdatedAt']
       ];
    }

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event): void
    {
       $entity = $event->getEntityInstance();

       if(!$entity instanceof TimestampedInterface) {
        return;
       }

       $entity->setcreatedAt(new \DateTime());
    }

    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event): void
    {
       $entity = $event->getEntityInstance();

       if(!$entity instanceof TimestampedInterface) {
        return;
       }

       $entity->setUpdatedAt(new \DateTime());
    }
}