<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'app_user')]
#[ApiResource(
    operations: [
        new Get(security: "is_granted('ROLE_ADMIN') or object == user"),
        new GetCollection(security: "is_granted('ROLE_ADMIN')"),
        new Post(denormalizationContext: ['groups' => ['user:write']], security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN') or object == user"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'program:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email]
    #[Groups(['user:read', 'user:write'])]
    private string $email = '';

    #[ORM\Column(type: 'json')]
    #[Groups(['user:read', 'user:write'])]
    private array $roles = ['ROLE_USER'];

    #[ORM\Column(type: 'string')]
    #[Groups(['user:write'])]
    private string $password = '';

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: TrainingProgram::class, cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['user:read'])]
    private Collection $programs;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return array_unique(array_merge($this->roles, ['ROLE_USER']));
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    /**
     * @return Collection<int, TrainingProgram>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(TrainingProgram $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->setOwner($this);
        }

        return $this;
    }

    public function removeProgram(TrainingProgram $program): self
    {
        if ($this->programs->removeElement($program) && $program->getOwner() === $this) {
            $program->setOwner(null);
        }

        return $this;
    }
}
