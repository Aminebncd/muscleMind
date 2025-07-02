<?php
namespace App\Tests\Entity;

use App\Entity\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    public function testToStringReturnsTitle()
    {
        $program = new Program();
        $program->setTitle('Leg Day');
        $this->assertSame('Leg Day', (string) $program);
    }
}
