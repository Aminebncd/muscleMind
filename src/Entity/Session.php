<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSession = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSession(): ?\DateTimeInterface
    {
        return $this->dateSession;
    }

    public function setDateSession(\DateTimeInterface $dateSession): static
    {
        $this->dateSession = $dateSession;

        return $this;
    }
}
