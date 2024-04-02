<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $exerciceName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $exerciceFunction = null;

    #[ORM\OneToMany(targetEntity: Performance::class, mappedBy: 'exerciceMesured', orphanRemoval: true)]
    private Collection $performances;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Muscle $target = null;

    #[ORM\ManyToMany(targetEntity: Muscle::class, inversedBy: 'exercices')]
    private Collection $secondaryTarget;

    #[ORM\ManyToMany(targetEntity: Program::class, mappedBy: 'exercice')]
    private Collection $programs;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
        $this->secondaryTarget = new ArrayCollection();
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExerciceName(): ?string
    {
        return $this->exerciceName;
    }

    public function setExerciceName(string $exerciceName): static
    {
        $this->exerciceName = $exerciceName;

        return $this;
    }

    public function getExerciceFunction(): ?string
    {
        return $this->exerciceFunction;
    }

    public function setExerciceFunction(string $exerciceFunction): static
    {
        $this->exerciceFunction = $exerciceFunction;

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): static
    {
        if (!$this->performances->contains($performance)) {
            $this->performances->add($performance);
            $performance->setExerciceMesured($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): static
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getExerciceMesured() === $this) {
                $performance->setExerciceMesured(null);
            }
        }

        return $this;
    }

    public function getTarget(): ?Muscle
    {
        return $this->target;
    }

    public function setTarget(?Muscle $target): static
    {
        $this->target = $target;

        return $this;
    }

    /**
     * @return Collection<int, Muscle>
     */
    public function getSecondaryTarget(): Collection
    {
        return $this->secondaryTarget;
    }

    public function addSecondaryTarget(Muscle $secondaryTarget): static
    {
        if (!$this->secondaryTarget->contains($secondaryTarget)) {
            $this->secondaryTarget->add($secondaryTarget);
        }

        return $this;
    }

    public function removeSecondaryTarget(Muscle $secondaryTarget): static
    {
        $this->secondaryTarget->removeElement($secondaryTarget);

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
            $program->addExercice($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): static
    {
        if ($this->programs->removeElement($program)) {
            $program->removeExercice($this);
        }

        return $this;
    }
}
