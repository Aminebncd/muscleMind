<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(security: "is_granted('ROLE_USER') and object.getUser() == user"),
        new Get(security: "is_granted('ROLE_USER') and object.getUser() == user"),
        new Post(security: "is_granted('ROLE_USER')"),
        new Patch(security: "is_granted('ROLE_USER') and object.getUser() == user"),
        new Delete(security: "is_granted('ROLE_USER') and object.getUser() == user")
    ],
    normalizationContext: ['groups' => ['session:read']],
    denormalizationContext: ['groups' => ['session:write']]
)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['session:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['session:read', 'session:write'])]
    private ?\DateTimeInterface $dateSession = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['session:read', 'session:write'])]
    private ?Program $program = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['session:read'])]
    private ?User $user = null;

    
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

    public function getDateFormatted(): string
    {
        return $this->dateSession->format('d.m.Y');
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
    
    public function getUser(): ?User
    {
        return $this->user;
    }
    
    public function setUser(?User $user): static
    {
        $this->user = $user;
        
        return $this;
    }
    
    public function __toString()
    {
        return $this->program.' - '.$this->dateSession->format('d.m.Y');
    }
    

}
