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

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $sex = null;

    #[ORM\ManyToOne(inversedBy: 'tracking', cascade: ['persist', 'remove'])]
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
        return $this->height.'cm';
    }

    public function setHeight(?string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight.'kg';
    }

    public function setWeight(?string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age.'years old';
    }

    public function setAge(?string $age): static
    {
        $this->age = $age;

        return $this;
    }

    // had problems because by default my getter was set to expect an int (: ?int)
    // changed to (: ?string) and it works fine
    public function getSex(): ?string
    {
        // if sex value is 0, return male ,if else return female
        return $this->sex === 0 ? 'male' : 'female';
    }

    public function setSex(?int $sex): static
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

    public function getDateOfTracking(): ?\DateTimeInterface
    {
        return $this->dateOfTracking;
    }

    public function setDateOfTracking(\DateTimeInterface $dateOfTracking): static
    {
        $this->dateOfTracking = $dateOfTracking;

        return $this;
    }

}
