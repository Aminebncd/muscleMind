<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberOfRepetitions = null;

    #[ORM\Column]
    private ?int $weightUsed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfRepetitions(): ?int
    {
        return $this->numberOfRepetitions;
    }

    public function setNumberOfRepetitions(int $numberOfRepetitions): static
    {
        $this->numberOfRepetitions = $numberOfRepetitions;

        return $this;
    }

    public function getWeightUsed(): ?int
    {
        return $this->weightUsed;
    }

    public function setWeightUsed(int $weightUsed): static
    {
        $this->weightUsed = $weightUsed;

        return $this;
    }
}
