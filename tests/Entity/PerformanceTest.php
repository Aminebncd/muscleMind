<?php
namespace App\Tests\Entity;

use App\Entity\Performance;
use App\Entity\Exercice;
use PHPUnit\Framework\TestCase;

class PerformanceTest extends TestCase
{
    public function testToStringReturnsRecordWithExercise()
    {
        $perf = new Performance();
        $perf->setPersonnalRecord('100');
        $ex = new Exercice();
        $ex->setExerciceName('Bench');
        $perf->setExerciceMesured($ex);
        $this->assertSame('100kg : Bench', (string) $perf);
    }

    public function testGetDateOfPerformanceReturnsFormattedDate()
    {
        $perf = new Performance();
        $date = new \DateTime('2024-05-21');
        $perf->setDateOfPerformance($date);
        $this->assertSame('21.05.2024', $perf->getDateOfPerformance());
    }

    public function testGetDateOfPerformanceReturnsNullWhenNoDate()
    {
        $perf = new Performance();
        $this->assertNull($perf->getDateOfPerformance());
    }
}
