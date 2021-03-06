<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="level")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=PlanningEvent::class, mappedBy="level")
     */
    private $planningEvents;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numericLevel;

    /**
     * @ORM\OneToMany(targetEntity=Module::class, mappedBy="level")
     */
    private $modules;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->planningEvents = new ArrayCollection();
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setLevel($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getLevel() === $this) {
                $student->setLevel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanningEvent[]
     */
    public function getPlanningEvents(): Collection
    {
        return $this->planningEvents;
    }

    public function addPlanningEvent(PlanningEvent $planningEvent): self
    {
        if (!$this->planningEvents->contains($planningEvent)) {
            $this->planningEvents[] = $planningEvent;
            $planningEvent->setLevel($this);
        }

        return $this;
    }

    public function removePlanningEvent(PlanningEvent $planningEvent): self
    {
        if ($this->planningEvents->removeElement($planningEvent)) {
            // set the owning side to null (unless already changed)
            if ($planningEvent->getLevel() === $this) {
                $planningEvent->setLevel(null);
            }
        }

        return $this;
    }


    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value): self
    {
        $this->$name = $value;

        return $this;
    }

    public function __add($name, $value): self
    {
        if (!$this->$name->contains($value)) {
            $this->$name[] = $value;

            if (method_exists($value, 'setLevel')) {
                $value->setLevel($this);
            }

            if (method_exists($value, 'addLevel')) {
                $value->addLevel($this);
            }
        }

        return $this;
    }

    public function getNumericLevel(): ?int
    {
        return $this->numericLevel;
    }

    public function setNumericLevel(?int $numericLevel): self
    {
        $this->numericLevel = $numericLevel;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setLevel($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getLevel() === $this) {
                $module->setLevel(null);
            }
        }

        return $this;
    }
}
