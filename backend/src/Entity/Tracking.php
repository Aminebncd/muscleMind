<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TrackingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackingRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(security: "is_granted('ROLE_USER')"),
        new Get(security: "is_granted('ROLE_USER') and object.getUserTracked() == user"),
        new Post(security: "is_granted('ROLE_USER')"),
        new Patch(security: "is_granted('ROLE_USER') and object.getUserTracked() == user"),
        new Delete(security: "is_granted('ROLE_USER') and object.getUserTracked() == user")
    ],
    normalizationContext: ['groups' => ['tracking:read']],
    denormalizationContext: ['groups' => ['tracking:write']]
)]
class Tracking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['tracking:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 3, nullable: true)]
    #[Groups(['tracking:read', 'tracking:write'])]
    private ?string $height = null;

    #[ORM\Column(length: 3, nullable: true)]
    #[Groups(['tracking:read', 'tracking:write'])]
    private ?string $weight = null;

    #[ORM\ManyToOne(inversedBy: 'trackings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['tracking:read'])]
    private ?User $userTracked = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['tracking:read', 'tracking:write'])]
    private ?\DateTimeInterface $dateOfTracking = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getUserTracked(): ?User
    {
        return $this->userTracked;
    }

    public function setUserTracked(?User $userTracked): static
    {
        $this->userTracked = $userTracked;

        return $this;
    }

    public function getDateOfTracking(): ?string
    {
        return $this->dateOfTracking?->format('d.m.Y');
    }

    public function setDateOfTracking(\DateTimeInterface $dateOfTracking): static
    {
        $this->dateOfTracking = $dateOfTracking;

        return $this;
    }

    public function __toString(): string
    {
        return $this->weight.'kg ('.$this->dateOfTracking->format('d.m.Y').')';
    }

}
