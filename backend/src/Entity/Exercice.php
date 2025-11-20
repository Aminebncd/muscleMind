<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ],
    normalizationContext: ['groups' => ['exercice:read']],
    denormalizationContext: ['groups' => ['exercice:write']]
)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['exercice:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?string $exerciceName = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?string $exerciceFunction = null;
    
    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?Muscle $target = null;
    
    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?Muscle $secondaryTarget = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?string $howToPerform = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?string $proTip = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['exercice:read', 'exercice:write'])]
    private ?string $videoExplication = null;
    
    #[ORM\OneToMany(targetEntity: Performance::class, mappedBy: 'exerciceMesured', orphanRemoval: true)]
    private Collection $performances;

    #[ORM\OneToMany(targetEntity: WorkoutPlan::class, mappedBy: 'exercice', orphanRemoval: true)]
    private Collection $workoutPlans;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
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

    public function isIsolationExercice(): bool
    {
        return $this->secondaryTarget === null;
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

    public function getHowToPerform(): ?string
    {
        return $this->howToPerform;
    }

    public function setHowToPerform(?string $howToPerform): static
    {
        $this->howToPerform = $howToPerform;

        return $this;
    }

    public function getProTip(): ?string
    {
        return $this->proTip;
    }

    public function setProTip(?string $proTip): static
    {
        $this->proTip = $proTip;

        return $this;
    }

    public function getVideoExplication(): ?string
    {
        return $this->videoExplication;
    }

    public function setVideoExplication(?string $videoExplication): static
    {
        $this->videoExplication = $videoExplication;

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

    //ici je fais mon __toString
    public function __toString()
    {
        return $this->exerciceName;

    }


}
