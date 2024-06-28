<?php

namespace App\EventSubscriber;

use App\Entity\Session;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\SetDataEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    // private $security;

    public function __construct(EntityManagerInterface $entityManager,
    //  Security $security
     )
     
    {
        $this->entityManager = $entityManager;
        // $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            SetDataEvent::class => 'onCalendarSetData',
        ];
    }


    public function onCalendarSetData(SetDataEvent $setDataEvent)
    {

        $user = $this->security->getUser();

        if (!$user) {
            return;
        }

        $sessions = $user->getSessions();

        foreach ($sessions as $session) {
            $event = new Event(
                (string)$session,
                $session->getDateSession()
            );

            $setDataEvent->addEvent($event);
        }
    }
}