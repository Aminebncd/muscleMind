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
    
    #[ORM\OneToMany(targetEntity: WorkoutPlan::class, mappedBy: 'program', cascade: ['persist'], orphanRemoval: true)]
    private Collection $workoutPlans;
    
    #[ORM\ManyToOne(inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;
    
    #[ORM\Column(length: 10)]
    private ?string $color = null;

    
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MuscleGroup $muscleGroupTargeted;

    #[ORM\ManyToOne]
    private ?MuscleGroup $secondaryMuscleGroupTargeted = null;


    public function __construct()
    {
        $this->sessions = new ArrayCollection();
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
    
    public function getMuscleGroupTargeted(): ?MuscleGroup
    {
        return $this->muscleGroupTargeted;
    }

    public function setMuscleGroupTargeted(?MuscleGroup $muscleGroupTargeted): static
    {
        $this->muscleGroupTargeted = $muscleGroupTargeted;

        return $this;
    }
    
    public function getSecondaryMuscleGroupTargeted(): ?MuscleGroup
    {
        return $this->secondaryMuscleGroupTargeted;
    }

    public function setSecondaryMuscleGroupTargeted(?MuscleGroup $secondaryMuscleGroupTargeted): static
    {
        $this->secondaryMuscleGroupTargeted = $secondaryMuscleGroupTargeted;

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

    public function __toString()
    {
        return $this->title;
        // .' ('.$this->muscleGroupTargeted->getName().' - '.$this->secondaryMuscleGroupTargeted->getName().')'
    }


    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Generate a random color if none is set
     */
    public function generateAndSetRandomColor(): void
    {
        if ($this->color === null) {
            $this->color = '#' . substr(md5(mt_rand()), 0, 6); // Generate a random hex color
        }
    }

}
