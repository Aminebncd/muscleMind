<?php

namespace App\Entity;

use App\Repository\MuscleGroupRepository;
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
}
