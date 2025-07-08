<?php
namespace App\Tests\Entity;

use App\Entity\WorkoutPlan;
use PHPUnit\Framework\TestCase;

class WorkoutPlanTest extends TestCase
{
    public function testGetAndSetIntensificationMethod()
    {
        $wp = new WorkoutPlan();
        $wp->setIntensificationMethod('drop_set');
        $this->assertSame('drop_set', $wp->getIntensificationMethod());
    }
}
