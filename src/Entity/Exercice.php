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

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Muscle $secondaryTarget = null;

    #[ORM\OneToMany(targetEntity: WorkoutPlan::class, mappedBy: 'exercice', orphanRemoval: true)]
    private Collection $workoutPlans;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
        // $this->secondaryTarget = new ArrayCollection();
        $this->workoutPlans = new ArrayCollection();
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

    public function getSecondaryTarget(): ?Muscle
    {
        return $this->secondaryTarget;
    }

    public function setSecondaryTarget(?Muscle $secondaryTarget): static
    {
        $this->secondaryTarget = $secondaryTarget;

        return $this;
    }

    /**
     * @return Collection<int, WorkoutPlan>
     */
    public function getWorkoutPlans(): Collection
    {
        return $this->workoutPlans;
    }

    public function addWorkoutPlan(WorkoutPlan $workoutPlan): static
    {
        if (!$this->workoutPlans->contains($workoutPlan)) {
            $this->workoutPlans->add($workoutPlan);
            $workoutPlan->setExercice($this);
        }

        return $this;
    }

    public function removeWorkoutPlan(WorkoutPlan $workoutPlan): static
    {
        if ($this->workoutPlans->removeElement($workoutPlan)) {
            // set the owning side to null (unless already changed)
            if ($workoutPlan->getExercice() === $this) {
                $workoutPlan->setExercice(null);
            }
        }

        return $this;
    }

    //ici je fais mon __tostring
    public function __tostring()
    {
        return $this->exerciceName;

    }

}
