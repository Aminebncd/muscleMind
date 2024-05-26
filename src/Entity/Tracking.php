<?php

namespace App\Entity;

use App\Repository\TrackingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackingRepository::class)]
class Tracking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $height = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $weight = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $age = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $sex = null;

    #[ORM\ManyToOne(inversedBy: 'tracking')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userTracked = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
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

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getUserTracked(): ?User
    {
        return $this->userTracked;
    }

    public function setUserTracked(User $userTracked): static
    {
        $this->userTracked = $userTracked;

        return $this;
    }

    public function getDateOfTracking(): ?string
    {
        return $this->dateOfTracking->format('d.m.Y');
    }

    public function setDateOfTracking(\DateTimeInterface $dateOfTracking): static
    {
        $this->dateOfTracking = $dateOfTracking;

        return $this;
    }

}
