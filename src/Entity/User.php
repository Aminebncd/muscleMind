<?php

namespace App\Entity;

// use App\Entity\Tracking;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $username = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $sex = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\Column]
    private ?int $lastResetYear = null;




    #[ORM\OneToMany(targetEntity: Tracking::class, mappedBy: 'userTracked', orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $trackings;

    #[ORM\OneToMany(targetEntity: Performance::class, mappedBy: 'userPerforming', orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $performances;

    #[ORM\OneToMany(targetEntity: Session::class, mappedBy: 'user', orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $sessions;

    #[ORM\OneToMany(targetEntity: Program::class, mappedBy: 'creator', orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $programs;

    #[ORM\OneToMany(targetEntity: Ressource::class, mappedBy: 'Author', cascade: ['persist'])]
    private Collection $ressources;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\ManyToMany(targetEntity: Ressource::class)]
    private Collection $favorites;

    






    public function __construct()

    {
        $this->performances = new ArrayCollection();
        $this->trackings = new ArrayCollection();
        $this->programs = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->favorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getAge(): ?int
    {
        $now = new \DateTime();
        $interval = $this->dateOfBirth->diff($now);
        return $interval->y;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getLastResetYear(): ?int
    {
        return $this->lastResetYear;
    }

    public function setLastResetYear(int $lastResetYear): static
    {
        $this->lastResetYear = $lastResetYear;

        return $this;
    }







    // TRAINING RELATED PROPERTIES //
    /**
     * @return Collection<int, Tracking>
     */
    public function getTrackings(): Collection
    {
        return $this->trackings;
    }

    public function addTracking(Tracking $tracking): static
    {
        // set the owning side of the relation if necessary
        if (!$this->trackings->contains($tracking)) {
            $this->trackings->add($tracking);
            $tracking->setUserTracked($this);
        }

        return $this;
    }

    public function removeTracking(Tracking $tracking): static
    {
        if ($this->trackings->removeElement($tracking)) {
            // set the owning side to null (unless already changed)
            if ($tracking->getUserTracked() === $this) {
                $tracking->setUserTracked(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): static
    {
        if (!$this->performances->contains($performance)) {
            $this->performances->add($performance);
            $performance->setUserPerforming($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): static
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getUserPerforming() === $this) {
                $performance->setUserPerforming(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setUser($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getUser() === $this) {
                $session->setUser(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection<int, Session>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(program $program): static
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->setCreator($this);
        }

        return $this;
    }

    public function removeprogram(program $program): static
    {
        if ($this->programs->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getCreator() === $this) {
                $program->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
            $ressource->setAuthor($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getAuthor() === $this) {
                $ressource->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Ressource $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
        }

        return $this;
    }

    public function removeFavorite(Ressource $favorite): static
    {
        $this->favorites->removeElement($favorite);

        return $this;
    }

    public function isFavorite(Ressource $ressource): bool
    {
        return $this->favorites->contains($ressource);
    }


        



    public function __toString ()
    {
        return $this->username;
    }

   
}
