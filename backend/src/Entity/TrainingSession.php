<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(securityPostDenormalize: "object.getProgram().getOwner() == user"),
        new Patch(security: "object.getProgram().getOwner() == user"),
        new Delete(security: "is_granted('ROLE_ADMIN') or object.getProgram().getOwner() == user")
    ],
    normalizationContext: ['groups' => ['session:read']],
    denormalizationContext: ['groups' => ['session:write']]
)]
#[ApiFilter(DateFilter::class, properties: ['scheduledAt'])]
#[ApiFilter(SearchFilter::class, properties: ['program.name' => 'partial'])]
class TrainingSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['session:read', 'program:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull]
    #[Groups(['session:read', 'session:write', 'program:read'])]
    private ?\DateTimeImmutable $scheduledAt = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive]
    #[Groups(['session:read', 'session:write', 'program:read'])]
    private int $durationMinutes = 60;

    #[ORM\Column(type: 'json')]
    #[Groups(['session:read', 'session:write'])]
    private array $exercises = [];

    #[ORM\ManyToOne(targetEntity: TrainingProgram::class, inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['session:read', 'session:write'])]
    private ?TrainingProgram $program = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['session:read', 'session:write'])]
    private string $intensity = 'moderate';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScheduledAt(): ?\DateTimeImmutable
    {
        return $this->scheduledAt;
    }

    public function setScheduledAt(\DateTimeImmutable $scheduledAt): self
    {
        $this->scheduledAt = $scheduledAt;
        return $this;
    }

    public function getDurationMinutes(): int
    {
        return $this->durationMinutes;
    }

    public function setDurationMinutes(int $durationMinutes): self
    {
        $this->durationMinutes = $durationMinutes;
        return $this;
    }

    public function getExercises(): array
    {
        return $this->exercises;
    }

    public function setExercises(array $exercises): self
    {
        $this->exercises = $exercises;
        return $this;
    }

    public function getProgram(): ?TrainingProgram
    {
        return $this->program;
    }

    public function setProgram(?TrainingProgram $program): self
    {
        $this->program = $program;
        return $this;
    }

    public function getIntensity(): string
    {
        return $this->intensity;
    }

    public function setIntensity(string $intensity): self
    {
        $this->intensity = $intensity;
        return $this;
    }
}
