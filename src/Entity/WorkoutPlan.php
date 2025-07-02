<?php

namespace App\Entity;

use App\Repository\WorkoutPlanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutPlanRepository::class)]
class WorkoutPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberOfRepetitions = null;

    #[ORM\Column]
    private ?int $weightsUsed = null;

    #[ORM\ManyToOne(inversedBy: 'workoutPlans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exercice = null;

    #[ORM\ManyToOne(inversedBy: 'workoutPlans')]
    private ?Program $program = null;

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

    public function getWeightsUsed(): ?int
    {
        return $this->weightsUsed;
    }

    public function setWeightsUsed(int $weightsUsed): static
    {
        $this->weightsUsed = $weightsUsed;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): static
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): static
    {
        $this->program = $program;

        return $this;
    }

    public function __toString()
    {
        return $this->exercice;
    }
}
