<?php

namespace App\Entity;

use App\Repository\MuscleGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MuscleGroupRepository::class)]
class MuscleGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $muscleGroup = null;

    // #[ORM\ManyToMany(targetEntity: Program::class, mappedBy: 'muscleGroupTargeted')]
    // private Collection $programs;

    #[ORM\OneToMany(targetEntity: Muscle::class, mappedBy: 'muscleGroup')]
    private Collection $muscles;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $muscleGroupImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $muscleGroupSvgFront = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $muscleGroupSvgBack = null;

    public function __construct()
    {
        // $this->programs = new ArrayCollection();
        $this->muscles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // a little bit useless but easier for me in a 
    // function that needs to return a string
    // please don't judge me
    public function getName(): ?string
    {
        return $this->muscleGroup;
    }

    public function getMuscleGroup(): ?string
    {
        return $this->muscleGroup;
    }

    public function setMuscleGroup(string $muscleGroup): static
    {
        $this->muscleGroup = $muscleGroup;

        return $this;
    }

    // /**
    //  * @return Collection<int, Program>
    //  */
    // public function getPrograms(): Collection
    // {
    //     return $this->programs;
    // }

    // public function addProgram(Program $program): static
    // {
    //     if (!$this->programs->contains($program)) {
    //         $this->programs->add($program);
    //         $program->addMuscleGroupTargeted($this);
    //     }

    //     return $this;
    // }

    // public function removeProgram(Program $program): static
    // {
    //     if ($this->programs->removeElement($program)) {
    //         $program->removeMuscleGroupTargeted($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Muscle>
     */
    public function getMuscles(): Collection
    {
        return $this->muscles;
    }

    public function addMuscle(Muscle $muscle): static
    {
        if (!$this->muscles->contains($muscle)) {
            $this->muscles->add($muscle);
            $muscle->setMuscleGroup($this);
        }

        return $this;
    }

    public function removeMuscle(Muscle $muscle): static
    {
        if ($this->muscles->removeElement($muscle)) {
            // set the owning side to null (unless already changed)
            if ($muscle->getMuscleGroup() === $this) {
                $muscle->setMuscleGroup(null);
            }
        }

        return $this;
    }

    // public function muscleGroupImage()
    // {
    //     $muscleGroup = $this->muscleGroup;
    //     // dd($muscleGroup);

    //     switch ($muscleGroup) {
    //         case 'CHEST':
    //             $muscleGroupImage = 'chest.webp';
    //             break;
    //         case 'BACK':
    //             $muscleGroupImage = 'back.webp';
    //             break;
    //         case 'SHOULDERS':
    //             $muscleGroupImage = 'shoulders.webp';
    //             break;
    //         case 'BICEPS':
    //             $muscleGroupImage = 'biceps.webp';
    //             break;
    //         case 'TRICEPS':
    //             $muscleGroupImage = 'triceps.webp';
    //             break;
    //         case 'FOREARMS':
    //             $muscleGroupImage = 'forearms.webp';
    //             break;
    //         case 'ABS':
    //             $muscleGroupImage = 'abs.webp';
    //             break; 
    //         case 'LEGS':
    //             $muscleGroupImage = 'legs.webp';
    //             break;
        
    //         default:
    //             return 'TEST';
    //     }
        
    //     return $muscleGroupImage;
    // }

    // public function muscleGroupSvg()
    // {
    //     $muscleGroup = $this->muscleGroup;
    //     // dd($muscleGroup);

    //     switch ($muscleGroup) {
    //         case 'CHEST':
    //             $muscleGroupSvg = 'chest.svg';
    //             break;
    //         case 'BACK':
    //             $muscleGroupSvg = 'back.svg';
    //             break;
    //         case 'SHOULDERS':
    //             $muscleGroupSvg = 'shoulders.svg';
    //             break;
    //         case 'BICEPS':
    //             $muscleGroupSvg = 'biceps.svg';
    //             break;
    //         case 'TRICEPS':
    //             $muscleGroupSvg = 'triceps.svg';
    //             break;
    //         case 'FOREARMS':
    //             $muscleGroupSvg = 'forearms.svg';
    //             break;
    //         case 'ABS':
    //             $muscleGroupSvg = 'abs.svg';
    //             break; 
    //         case 'LEGS':
    //             $muscleGroupSvg = 'legs.svg';
    //             break;
        
    //         default:
    //             return 'TEST';
    //     }

    //     return $muscleGroupSvg;
    // }

    public function getMuscleGroupImage(): ?string
    {
        return $this->muscleGroupImage;
    }

    public function setMuscleGroupImage(?string $muscleGroupImage): static
    {
        $this->muscleGroupImage = $muscleGroupImage;

        return $this;
    }

    public function getMuscleGroupSvgFront(): ?string
    {
        return $this->muscleGroupSvgFront;
    }

    public function setMuscleGroupSvgFront(?string $muscleGroupSvgFront): static
    {
        $this->muscleGroupSvgFront = $muscleGroupSvgFront;

        return $this;
    }

    public function getMuscleGroupSvgBack(): ?string
    {
        return $this->muscleGroupSvgBack;
    }

    public function setMuscleGroupSvgBack(?string $muscleGroupSvgBack): static
    {
        $this->muscleGroupSvgBack = $muscleGroupSvgBack;

        return $this;
    }
    
    public function __tostring()
    {
        return $this->muscleGroup;
    }

    
}
