<?php

namespace App\EventSubscriber;

// use App\Entity\User;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\SetDataEvent;
// use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            SetDataEvent::class => 'onCalendarSetData',
        ];
    }


    public function onCalendarSetData(SetDataEvent $setDataEvent)
    {

        $user = $this->getUser();

        if (!$user) {
            return;
        }

        $sessions = $user->getSessions();

        foreach ($sessions as $session) {
            $event = new Event(
                (string)$session->getProgram(),
                $session->getDateSession()
            );

            $setDataEvent->addEvent($event);
        }
    }
}