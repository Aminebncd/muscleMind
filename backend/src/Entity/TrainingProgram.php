<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(security: "is_granted('ROLE_COACH')"),
        new Patch(security: "object.getOwner() == user"),
        new Delete(security: "is_granted('ROLE_ADMIN') or object.getOwner() == user")
    ],
    normalizationContext: ['groups' => ['program:read']],
    denormalizationContext: ['groups' => ['program:write']]
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial', 'owner.email' => 'exact'])]
class TrainingProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['program:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['program:read', 'program:write', 'session:read'])]
    private string $name = '';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['program:read', 'program:write'])]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['program:read'])]
    private ?User $owner = null;

    #[ORM\OneToMany(mappedBy: 'program', targetEntity: TrainingSession::class, cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['program:read'])]
    private Collection $sessions;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['program:read', 'program:write'])]
    private bool $isPublished = false;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return Collection<int, TrainingSession>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(TrainingSession $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setProgram($this);
        }

        return $this;
    }

    public function removeSession(TrainingSession $session): self
    {
        if ($this->sessions->removeElement($session) && $session->getProgram() === $this) {
            $session->setProgram(null);
        }

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $published): self
    {
        $this->isPublished = $published;
        return $this;
    }
}
