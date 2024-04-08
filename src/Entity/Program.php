<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'program', orphanRemoval: true)]
    private Collection $sessions;

    #[ORM\ManyToMany(targetEntity: MuscleGroup::class, inversedBy: 'programs')]
    private Collection $muscleGroupTargeted;

    #[ORM\OneToMany(targetEntity: WorkoutPlan::class, mappedBy: 'program')]
    private Collection $workoutPlans;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;


    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->muscleGroupTargeted = new ArrayCollection();
        $this->workoutPlans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setProgram($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getProgram() === $this) {
                $session->setProgram(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MuscleGroup>
     */
    public function getMuscleGroupTargeted(): Collection
    {
        return $this->muscleGroupTargeted;
    }

    public function addMuscleGroupTargeted(MuscleGroup $muscleGroupTargeted): static
    {
        if (!$this->muscleGroupTargeted->contains($muscleGroupTargeted)) {
            $this->muscleGroupTargeted->add($muscleGroupTargeted);
        }

        return $this;
    }

    public function removeMuscleGroupTargeted(MuscleGroup $muscleGroupTargeted): static
    {
        $this->muscleGroupTargeted->removeElement($muscleGroupTargeted);

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
            $workoutPlan->setProgram($this);
        }

        return $this;
    }

    public function removeWorkoutPlan(WorkoutPlan $workoutPlan): static
    {
        if ($this->workoutPlans->removeElement($workoutPlan)) {
            // set the owning side to null (unless already changed)
            if ($workoutPlan->getProgram() === $this) {
                $workoutPlan->setProgram(null);
            }
        }

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    public function __tostring()
    {
        return $this->title;
    }
}
