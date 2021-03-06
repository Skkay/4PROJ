<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="campus")
     */
    private $sections;

    /**
     * @ORM\OneToMany(targetEntity=Staff::class, mappedBy="campus")
     */
    private $staff;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="campus")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=PlanningEvent::class, mappedBy="campus")
     */
    private $planningEvents;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->staff = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->planningEvents = new ArrayCollection();
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setCampus($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getCampus() === $this) {
                $section->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff[] = $staff;
            $staff->setCampus($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getCampus() === $this) {
                $staff->setCampus(null);
            }
        }

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
            $student->setCampus($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getCampus() === $this) {
                $student->setCampus(null);
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
            $planningEvent->setCampus($this);
        }

        return $this;
    }

    public function removePlanningEvent(PlanningEvent $planningEvent): self
    {
        if ($this->planningEvents->removeElement($planningEvent)) {
            // set the owning side to null (unless already changed)
            if ($planningEvent->getCampus() === $this) {
                $planningEvent->setCampus(null);
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

            if (method_exists($value, 'setCampus')) {
                $value->setCampus($this);
            }

            if (method_exists($value, 'addCampus')) {
                $value->addCampus($this);
            }
        }

        return $this;
    }
}
