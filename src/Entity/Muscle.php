<?php

namespace App\Entity;

use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Muscle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $muscleName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $muscleFunction = null;

    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'target')]
    private Collection $exercices;

    #[ORM\OneToMany(targetEntity: Program::class, mappedBy: 'muscle')]
    private Collection $programs;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMuscleName(): ?string
    {
        return $this->muscleName;
    }

    public function setMuscleName(string $muscleName): static
    {
        $this->muscleName = $muscleName;

        return $this;
    }

    public function getMuscleFunction(): ?string
    {
        return $this->muscleFunction;
    }

    public function setMuscleFunction(string $muscleFunction): static
    {
        $this->muscleFunction = $muscleFunction;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
            $exercice->setTarget($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getTarget() === $this) {
                $exercice->setTarget(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): static
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->addMuscle($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): static
    {
        if ($this->programs->removeElement($program)) {
            $program->removeMuscle($this);
        }

        return $this;
    }
}
