<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerformanceRepository::class)]
class Performance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $personnalRecord = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userPerforming = null;

    #[ORM\ManyToOne(inversedBy: 'performances', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exerciceMesured = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
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
        return $this->dateOfPerformance->format('d/m/Y') ;
    }
        
    public function setDateOfPerformance($dateOfPerformance): static
    {
        $this->dateOfPerformance = $dateOfPerformance;
        
        return $this;
    }
        
    public function __tostring()
    {
        return $this->personnalRecord."kg : ".$this->exerciceMesured;
    }
}
