<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MuscleRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ],
    normalizationContext: ['groups' => ['muscle:read']],
    denormalizationContext: ['groups' => ['muscle:write']]
)]
class Muscle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['muscle:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['muscle:read', 'muscle:write', 'exercice:read'])]
    private ?string $muscleName = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['muscle:read', 'muscle:write'])]
    private ?string $muscleFunction = null;

    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'target')]
    private Collection $exercices;

    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'secondaryTarget')]
    private Collection $subExercices;

    #[ORM\ManyToOne(inversedBy: 'muscles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['muscle:read', 'muscle:write'])]
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

    public function __toString(): string
    {
        return $this->muscleName;
    }
}
