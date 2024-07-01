<?php

namespace App\EventSubscriber;

use CalendarBundle\Entity\Event;
use CalendarBundle\Event\SetDataEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $security;
    private $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            SetDataEvent::class => 'onCalendarSetData',
        ];
    }

    // public function onCalendarSetData(SetDataEvent $setDataEvent)
    // {
    //     $user = $this->security->getUser();

    //     if (!$user) {
    //         return;
    //     }

    //     $sessions = $user->getSessions();

    //     $events = [];

    //     foreach ($sessions as $session) {
    //         $event = new Event(
    //             'All day event',
    //             $session->getDateSession(), 
    //             $session->getDateSession() 
    //         );

    //         $setDataEvent->addEvent($event);
    //     }
    //     return new JsonResponse($events);

    // }
}
