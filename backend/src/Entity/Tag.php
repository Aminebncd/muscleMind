<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ],
    normalizationContext: ['groups' => ['tag:read']],
    denormalizationContext: ['groups' => ['tag:write']]
)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['tag:read', 'ressource:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['tag:read', 'tag:write', 'ressource:read'])]
    private ?string $label = null;

    #[ORM\OneToMany(targetEntity: Ressource::class, mappedBy: 'tag', orphanRemoval: true)]
    private Collection $Ressources;

    public function __construct()
    {
        $this->Ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function tagColor (): string
    {

        $tag = $this->getLabel();

        switch ($tag) {
            case 'weight lifting':
                return 'quinary';
            case 'health':
                return 'quaternary';
            case 'nutrition':
                return 'senary';
            
            default:
                return 'quinary';
        }
    }

    // public function tagTextColor (): string
    // {

    //     $tag = $this->getLabel();

    //     switch ($tag) {
    //         case 'weight lifting':
    //             return 'white';
    //         case 'health':
    //             return 'black';
    //         case 'nutrition':
    //             return 'white';
            
    //         default:
    //             return 'white';
    //     }
    // }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->Ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->Ressources->contains($ressource)) {
            $this->Ressources->add($ressource);
            $ressource->setTag($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->Ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getTag() === $this) {
                $ressource->setTag(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->label;
    }
}
