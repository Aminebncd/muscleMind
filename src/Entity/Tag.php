<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
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

    public function tagTextColor (): string
    {

        $tag = $this->getLabel();

        switch ($tag) {
            case 'weight lifting':
                return 'white';
            case 'health':
                return 'black';
            case 'nutrition':
                return 'white';
            
            default:
                return 'white';
        }
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->Ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->Ressource->contains($ressource)) {
            $this->Ressource->add($ressource);
            $ressource->setTag($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->Ressource->removeElement($ressource)) {
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
