<?php

namespace App\Entity;

use App\Repository\MuscleGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MuscleGroupRepository::class)]
class MuscleGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $muscleGroup = null;

    // #[ORM\ManyToMany(targetEntity: Program::class, mappedBy: 'muscleGroupTargeted')]
    // private Collection $programs;

    #[ORM\OneToMany(targetEntity: Muscle::class, mappedBy: 'muscleGroup')]
    private Collection $muscles;

    public function __construct()
    {
        // $this->programs = new ArrayCollection();
        $this->muscles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMuscleGroup(): ?string
    {
        return $this->muscleGroup;
    }

    public function setMuscleGroup(string $muscleGroup): static
    {
        $this->muscleGroup = $muscleGroup;

        return $this;
    }

    // /**
    //  * @return Collection<int, Program>
    //  */
    // public function getPrograms(): Collection
    // {
    //     return $this->programs;
    // }

    // public function addProgram(Program $program): static
    // {
    //     if (!$this->programs->contains($program)) {
    //         $this->programs->add($program);
    //         $program->addMuscleGroupTargeted($this);
    //     }

    //     return $this;
    // }

    // public function removeProgram(Program $program): static
    // {
    //     if ($this->programs->removeElement($program)) {
    //         $program->removeMuscleGroupTargeted($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Muscle>
     */
    public function getMuscles(): Collection
    {
        return $this->muscles;
    }

    public function addMuscle(Muscle $muscle): static
    {
        if (!$this->muscles->contains($muscle)) {
            $this->muscles->add($muscle);
            $muscle->setMuscleGroup($this);
        }

        return $this;
    }

    public function removeMuscle(Muscle $muscle): static
    {
        if ($this->muscles->removeElement($muscle)) {
            // set the owning side to null (unless already changed)
            if ($muscle->getMuscleGroup() === $this) {
                $muscle->setMuscleGroup(null);
            }
        }

        return $this;
    }

    public function __tostring()
    {
        return $this->muscleGroup;
    }
}
