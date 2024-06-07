<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\SessionRepository;
use DateInterval;
use DatePeriod;
use DateTime;

class UserActivityService
{
    private SessionRepository $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public static function getUserActivity(User $user, SessionRepository $sessionRepository): array
    {
        $currentYear = date('Y');
        $startDate = new DateTime("$currentYear-01-01");
        $endDate = new DateTime("$currentYear-12-31");
    
        $sessions = $sessionRepository->findByUserAndDateRange($user, $startDate, $endDate);
    
        $activity = [];
        foreach ($sessions as $session) {
            $date = $session->getDateSession()->format('Y-m-d');
            if (!isset($activity[$date])) {
                $activity[$date] = 0;
            }
            $activity[$date]++;
        }
    
        // Generate activity array using a helper method
        return self::generateActivityArray($startDate, $endDate, $activity);
    }
    

    private static function generateActivityArray(DateTime $startDate, DateTime $endDate, array $activity): array
    {
        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
        $activityArray = [];

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $activityArray[$formattedDate] = $activity[$formattedDate] ?? 0;
        }

        return $activityArray;
    }

}

