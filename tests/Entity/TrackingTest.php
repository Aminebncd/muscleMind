<?php
namespace App\Tests\Entity;

use App\Entity\Tracking;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TrackingTest extends TestCase
{
    public function testGetDateOfTrackingReturnsFormattedDate()
    {
        $tracking = new Tracking();
        $date = new \DateTime('2024-05-20');
        $tracking->setDateOfTracking($date);
        $this->assertSame('20.05.2024', $tracking->getDateOfTracking());
    }

    public function testGetDateOfTrackingReturnsNullWhenNoDate()
    {
        $tracking = new Tracking();
        $this->assertNull($tracking->getDateOfTracking());
    }
}
