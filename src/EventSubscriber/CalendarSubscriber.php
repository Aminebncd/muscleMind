<?php

namespace App\EventSubscriber;

use CalendarBundle\Entity\Event;
use CalendarBundle\Event\SetDataEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;
    private $authorizationChecker;
    private $logger;

    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker, LoggerInterface $logger)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            SetDataEvent::class => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(SetDataEvent $setDataEvent)
    {
        $this->logger->info('onCalendarSetData called.');

        $token = $this->tokenStorage->getToken();
        if (null === $token) {
            $this->logger->warning('No token found.');
            return;
        }

        $user = $token->getUser();
        if (!is_object($user) || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->logger->warning('User is not authenticated or not an object.');
            return;
        }

        $this->logger->info('Authenticated user found.', ['user' => $user->getUsername()]);

        $sessions = $user->getSessions();
        if ($sessions->isEmpty()) {
            $this->logger->info('No sessions found for the user.');
        } else {
            $this->logger->info(sprintf('Found %d sessions for the user.', count($sessions)));
        }

        foreach ($sessions as $session) {
            $this->logger->info('Processing session.', [
                'program' => $session->getProgram(),
                'date' => $session->getDateSession()->format('Y-m-d H:i:s')
            ]);

            $event = new Event(
                (string) $session->getProgram(),
                $session->getDateSession()
            );

            $setDataEvent->addEvent($event);
            $this->logger->info('Event added to the calendar.', ['event' => $event]);
        }
    }
}

