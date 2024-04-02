<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberOfRepetitions = null;

    #[ORM\Column]
    private ?int $weightUsed = null;

    #[ORM\ManyToMany(targetEntity: Exercice::class, inversedBy: 'programs')]
    private Collection $exercice;

    #[ORM\ManyToMany(targetEntity: Muscle::class, inversedBy: 'programs')]
    private Collection $muscle;

    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'program', orphanRemoval: true)]
    private Collection $session;

    public function __construct()
    {
        $this->exercice = new ArrayCollection();
        $this->muscle = new ArrayCollection();
        $this->session = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfRepetitions(): ?int
    {
        return $this->numberOfRepetitions;
    }

    public function setNumberOfRepetitions(int $numberOfRepetitions): static
    {
        $this->numberOfRepetitions = $numberOfRepetitions;

        return $this;
    }

    public function getWeightUsed(): ?int
    {
        return $this->weightUsed;
    }

    public function setWeightUsed(int $weightUsed): static
    {
        $this->weightUsed = $weightUsed;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercice(): Collection
    {
        return $this->exercice;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercice->contains($exercice)) {
            $this->exercice->add($exercice);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        $this->exercice->removeElement($exercice);

        return $this;
    }

    /**
     * @return Collection<int, Muscle>
     */
    public function getMuscle(): Collection
    {
        return $this->muscle;
    }

    public function addMuscle(Muscle $muscle): static
    {
        if (!$this->muscle->contains($muscle)) {
            $this->muscle->add($muscle);
        }

        return $this;
    }

    public function removeMuscle(Muscle $muscle): static
    {
        $this->muscle->removeElement($muscle);

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSession(): Collection
    {
        return $this->session;
    }

    public function addSession(Session $session): static
    {
        if (!$this->session->contains($session)) {
            $this->session->add($session);
            $session->setProgram($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->session->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getProgram() === $this) {
                $session->setProgram(null);
            }
        }

        return $this;
    }
}
