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

    #[ORM\ManyToOne(inversedBy: 'muscles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MuscleGroup $muscleGroup = null;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
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

    public function getMuscleGroup(): ?MuscleGroup
    {
        return $this->muscleGroup;
    }

    public function setMuscleGroup(?MuscleGroup $muscleGroup): static
    {
        $this->muscleGroup = $muscleGroup;

        return $this;
    }
}
