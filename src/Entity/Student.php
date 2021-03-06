<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="student", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="students")
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class, inversedBy="students")
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity=Module::class, inversedBy="students")
     */
    private $modules;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class)
     */
    private $entryLevel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $entryYear;
    
    /**
     * @ORM\ManyToOne(targetEntity=Level::class)
     */
    private $exitLevel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $exitYear;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $professionalTrainingContract;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accountsPaid;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accountsPaymentDue;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accountsReminded;

    /**
     * @ORM\ManyToOne(targetEntity=AccountsPaymentType::class, inversedBy="students")
     */
    private $accountsPaymentType;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="studentsTrainingContract")
     */
    private $companyTrainingContract;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="studentsCompanyHired")
     */
    private $companyHired;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateStartContract;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $employedAs;

    /**
     * @ORM\ManyToOne(targetEntity=Diploma::class, inversedBy="students")
     */
    private $lastDiploma;

    /**
     * @ORM\OneToMany(targetEntity=Grade::class, mappedBy="student")
     */
    private $grades;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=Gender::class, inversedBy="students")
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="students")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="students")
     */
    private $speciality;

    /**
     * @ORM\OneToMany(targetEntity=AccountsStudentComment::class, mappedBy="student", orphanRemoval=true, cascade={"persist"})
     */
    private $accountsComments;

    /**
     * @ORM\OneToMany(targetEntity=Absence::class, mappedBy="student", cascade={"persist"})
     */
    private $absences;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSCT;

    /**
     * @ORM\OneToMany(targetEntity=Thesis::class, mappedBy="student")
     */
    private $theses;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->grades = new ArrayCollection();
        $this->accountsComments = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->theses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

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
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        $this->modules->removeElement($module);

        return $this;
    }

    public function getEntryLevel(): ?Level
    {
        return $this->entryLevel;
    }

    public function setEntryLevel(?Level $entryLevel): self
    {
        $this->entryLevel = $entryLevel;

        return $this;
    }

    public function getEntryYear(): ?int
    {
        return $this->entryYear;
    }

    public function setEntryYear(?int $entryYear): self
    {
        $this->entryYear = $entryYear;

        return $this;
    }
    
    public function getExitLevel(): ?Level
    {
        return $this->exitLevel;
    }

    public function setExitLevel(?Level $exitLevel): self
    {
        $this->exitLevel = $exitLevel;

        return $this;
    }

    public function getExitYear(): ?int
    {
        return $this->exitYear;
    }

    public function setExitYear(?int $exitYear): self
    {
        $this->exitYear = $exitYear;

        return $this;
    }

    public function getProfessionalTrainingContract(): ?bool
    {
        return $this->professionalTrainingContract;
    }

    public function setProfessionalTrainingContract(?bool $professionalTrainingContract): self
    {
        $this->professionalTrainingContract = $professionalTrainingContract;

        return $this;
    }

    public function getAccountsPaid(): ?bool
    {
        return $this->accountsPaid;
    }

    public function setAccountsPaid(?bool $accountsPaid): self
    {
        $this->accountsPaid = $accountsPaid;

        return $this;
    }

    public function getAccountsPaymentDue(): ?float
    {
        return $this->accountsPaymentDue;
    }

    public function setAccountsPaymentDue(?float $accountsPaymentDue): self
    {
        $this->accountsPaymentDue = $accountsPaymentDue;

        return $this;
    }

    public function isAccountsReminded(): ?bool
    {
        return $this->accountsReminded;
    }

    public function setAccountsReminded(?bool $accountsReminded): self
    {
        $this->accountsReminded = $accountsReminded;

        return $this;
    }

    public function getAccountsPaymentType(): ?AccountsPaymentType
    {
        return $this->accountsPaymentType;
    }

    public function setAccountsPaymentType(?AccountsPaymentType $accountsPaymentType): self
    {
        $this->accountsPaymentType = $accountsPaymentType;

        return $this;
    }

    public function getCompanyTrainingContract(): ?Company
    {
        return $this->companyTrainingContract;
    }

    public function setCompanyTrainingContract(?Company $companyTrainingContract): self
    {
        $this->companyTrainingContract = $companyTrainingContract;

        return $this;
    }

    public function getCompanyHired(): ?Company
    {
        return $this->companyHired;
    }

    public function setCompanyHired(?Company $companyHired): self
    {
        $this->companyHired = $companyHired;

        return $this;
    }

    public function getDateStartContract(): ?\DateTimeInterface
    {
        return $this->dateStartContract;
    }

    public function setDateStartContract(?\DateTimeInterface $dateStartContract): self
    {
        $this->dateStartContract = $dateStartContract;

        return $this;
    }

    public function getEmployedAs(): ?string
    {
        return $this->employedAs;
    }

    public function setEmployedAs(?string $employedAs): self
    {
        $this->employedAs = $employedAs;

        return $this;
    }

    public function getLastDiploma(): ?Diploma
    {
        return $this->lastDiploma;
    }

    public function setLastDiploma(?Diploma $lastDiploma): self
    {
        $this->lastDiploma = $lastDiploma;

        return $this;
    }

    /**
     * @return Collection|Grade[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setStudent($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getStudent() === $this) {
                $grade->setStudent(null);
            }
        }

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }
    
    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * @return Collection|AccountsStudentComment[]
     */
    public function getAccountsComments(): Collection
    {
        return $this->accountsComments;
    }

    public function addAccountsComment(AccountsStudentComment $accountsComment): self
    {
        if (!$this->accountsComments->contains($accountsComment)) {
            $this->accountsComments[] = $accountsComment;
            $accountsComment->setStudent($this);
        }

        return $this;
    }

    public function removeAccountsComment(AccountsStudentComment $accountsComment): self
    {
        if ($this->accountsComments->removeElement($accountsComment)) {
            // set the owning side to null (unless already changed)
            if ($accountsComment->getStudent() === $this) {
                $accountsComment->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Absence[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setStudent($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getStudent() === $this) {
                $absence->setStudent(null);
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

            if (method_exists($value, 'setStudent')) {
                $value->setStudent($this);
            }

            if (method_exists($value, 'addStudent')) {
                $value->addStudent($this);
            }
        }

        return $this;
    }

    public function getIsSCT(): ?bool
    {
        return $this->isSCT;
    }

    public function setIsSCT(?bool $isSCT): self
    {
        $this->isSCT = $isSCT;

        return $this;
    }

    /**
     * @return Collection|Thesis[]
     */
    public function getTheses(): Collection
    {
        return $this->theses;
    }

    public function addThesis(Thesis $thesis): self
    {
        if (!$this->theses->contains($thesis)) {
            $this->theses[] = $thesis;
            $thesis->setStudent($this);
        }

        return $this;
    }

    public function removeThesis(Thesis $thesis): self
    {
        if ($this->theses->removeElement($thesis)) {
            // set the owning side to null (unless already changed)
            if ($thesis->getStudent() === $this) {
                $thesis->setStudent(null);
            }
        }

        return $this;
    }
}
