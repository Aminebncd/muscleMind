<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\PerformanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerformanceRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(security: "is_granted('ROLE_USER')"),
        new Patch(security: "is_granted('ROLE_USER') and object.getUserPerforming() == user"),
        new Delete(security: "is_granted('ROLE_USER') and object.getUserPerforming() == user")
    ],
    normalizationContext: ['groups' => ['performance:read']],
    denormalizationContext: ['groups' => ['performance:write']]
)]
class Performance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['performance:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['performance:read', 'performance:write'])]
    private ?string $personnalRecord = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['performance:read'])]
    private ?User $userPerforming = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['performance:read', 'performance:write'])]
    private ?Exercice $exerciceMesured = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['performance:read', 'performance:write'])]
    private ?\DateTimeInterface $dateOfPerformance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonnalRecord(): ?string
    {
        return $this->personnalRecord;
    }

    public function setPersonnalRecord(string $personnalRecord): static
    {
        $this->personnalRecord = $personnalRecord;

        return $this;
    }

    public function getUserPerforming(): ?User
    {
        return $this->userPerforming;
    }

    public function setUserPerforming(?User $userPerforming): static
    {
        $this->userPerforming = $userPerforming;

        return $this;
    }

    public function getExerciceMesured(): ?Exercice
    {
        return $this->exerciceMesured;
    }

    public function setExerciceMesured(?Exercice $exerciceMesured): static
    {
        $this->exerciceMesured = $exerciceMesured;

        return $this;
    }
    
    public function getDateOfPerformance(): ?string
    {
        return $this->dateOfPerformance?->format('d.m.Y');
    }

    public function setDateOfPerformance(\DateTimeInterface $dateOfPerformance): static
    {
        $this->dateOfPerformance = $dateOfPerformance;

        return $this;
    }
        
    public function __toString()
    {
        return $this->personnalRecord."kg : ".$this->exerciceMesured;
    }
}
