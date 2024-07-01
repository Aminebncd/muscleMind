<?php

namespace App\EventSubscriber;

use CalendarBundle\Entity\Event;
use CalendarBundle\Event\SetDataEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    // private $security;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            SetDataEvent::class => 'onCalendarSetData',
        ];
    }


}
