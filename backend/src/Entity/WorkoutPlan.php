<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\WorkoutPlanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutPlanRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(security: "is_granted('ROLE_USER')"),
        new Patch(security: "is_granted('ROLE_USER')"),
        new Delete(security: "is_granted('ROLE_USER')")
    ],
    normalizationContext: ['groups' => ['workout_plan:read']],
    denormalizationContext: ['groups' => ['workout_plan:write']]
)]
class WorkoutPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['workout_plan:read', 'program:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['workout_plan:read', 'workout_plan:write', 'program:read'])]
    private ?int $numberOfRepetitions = null;

    #[ORM\Column]
    #[Groups(['workout_plan:read', 'workout_plan:write', 'program:read'])]
    private ?int $weightsUsed = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['workout_plan:read', 'workout_plan:write', 'program:read'])]
    private ?string $intensificationMethod = null;

    #[ORM\ManyToOne(inversedBy: 'workoutPlans')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['workout_plan:read', 'workout_plan:write', 'program:read'])]
    private ?Exercice $exercice = null;

    #[ORM\ManyToOne(inversedBy: 'workoutPlans')]
    #[Groups(['workout_plan:read'])]
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

    public function getIntensificationMethod(): ?string
    {
        return $this->intensificationMethod;
    }

    public function setIntensificationMethod(?string $intensificationMethod): static
    {
        $this->intensificationMethod = $intensificationMethod;

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
