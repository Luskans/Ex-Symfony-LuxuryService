<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(nullable: true)]
    private ?bool $havePassport = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $passport = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $curriculum = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $placeOfBirth = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isAvailable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sector = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $experience = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $file = null;

    #[ORM\OneToOne(inversedBy: 'candidate', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $isDeleted = false;

    #[ORM\OneToMany(mappedBy: 'candidate', targetEntity: Candidacy::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $candidacies;

    #[ORM\Column(nullable: true)]
    private ?int $percentCompleted = null;

    public function __construct()
    {
        $this->candidacies = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
    }

    public function __toString(): string
    {
        $completeName = $this->getFirstname() . ' ' . $this->getLastname();
        return $completeName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function isHavePassport(): ?bool
    {
        return $this->havePassport;
    }

    public function setHavePassport(?bool $havePassport): static
    {
        $this->havePassport = $havePassport;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(?string $passport): static
    {
        $this->passport = $passport;

        return $this;
    }

    public function getCurriculum(): ?string
    {
        return $this->curriculum;
    }

    public function setCurriculum(?string $curriculum): static
    {
        $this->curriculum = $curriculum;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): static
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(?bool $isAvailable): static
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): static
    {
        $this->sector = $sector;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @return Collection<int, Candidacy>
     */
    public function getCandidacies(): Collection
    {
        return $this->candidacies;
    }

    public function addCandidacy(Candidacy $candidacy): static
    {
        if (!$this->candidacies->contains($candidacy)) {
            $this->candidacies->add($candidacy);
            $candidacy->setCandidate($this);
        }

        return $this;
    }

    public function removeCandidacy(Candidacy $candidacy): static
    {
        if ($this->candidacies->removeElement($candidacy)) {
            // set the owning side to null (unless already changed)
            if ($candidacy->getCandidate() === $this) {
                $candidacy->setCandidate(null);
            }
        }

        return $this;
    }

    public function getPercentCompleted(): ?int
    {
        return $this->percentCompleted;
    }

    public function setPercentCompleted(?int $percentCompleted): static
    {
        $this->percentCompleted = $percentCompleted;

        return $this;
    } 

    // // fonction custom pour voir si tous les champs sont remplis
    // public function areFieldsCompleted(): bool
    // {
    //     $reflectionClass = new \ReflectionClass($this);
    //     $fields = $reflectionClass->getProperties();

    //     foreach ($fields as $field) {
    //         $field->setAccessible(true);
    //         $value = $field->getValue($this);

    //         if (empty($value) && !is_bool($value)) {
    //             return false;
    //         }
    //     }

    //     return true;
    // }

    // custom function
    public function checkPercentCompleted(): int
    {
        $totalFields = 15;
        $percentPart = 100/15; //6.66
        $actualPercent = 0;
        $reflectionClass = new \ReflectionClass($this);

        $genderValue = $reflectionClass->getProperty('gender')->getValue($this);
        if (!empty($genderValue) && !is_bool($genderValue)) {
            $actualPercent += $percentPart;
        }
        $firstnameValue = $reflectionClass->getProperty('firstname')->getValue($this);
        if (!empty($firstnameValue) && !is_bool($firstnameValue)) {
            $actualPercent += $percentPart;
        }
        $lastnameValue = $reflectionClass->getProperty('lastname')->getValue($this);
        if (!empty($lastnameValue) && !is_bool($lastnameValue)) {
            $actualPercent += $percentPart;
        }
        $cityValue = $reflectionClass->getProperty('city')->getValue($this);
        if (!empty($cityValue) && !is_bool($cityValue)) {
            $actualPercent += $percentPart;
        }
        $adressValue = $reflectionClass->getProperty('adress')->getValue($this);
        if (!empty($adressValue) && !is_bool($adressValue)) {
            $actualPercent += $percentPart;
        }
        $countryValue = $reflectionClass->getProperty('country')->getValue($this);
        if (!empty($countryValue) && !is_bool($countryValue)) {
            $actualPercent += $percentPart;
        }
        $nationalityValue = $reflectionClass->getProperty('nationality')->getValue($this);
        if (!empty($nationalityValue) && !is_bool($nationalityValue)) {
            $actualPercent += $percentPart;
        }
        $passportValue = $reflectionClass->getProperty('passport')->getValue($this);
        if (!empty($passportValue) && !is_bool($passportValue)) {
            $actualPercent += $percentPart;
        }
        $curriculumValue = $reflectionClass->getProperty('curriculum')->getValue($this);
        if (!empty($curriculumValue) && !is_bool($curriculumValue)) {
            $actualPercent += $percentPart;
        }
        $pictureValue = $reflectionClass->getProperty('picture')->getValue($this);
        if (!empty($pictureValue) && !is_bool($pictureValue)) {
            $actualPercent += $percentPart;
        }
        $dateOfBirthValue = $reflectionClass->getProperty('dateOfBirth')->getValue($this);
        if (!empty($dateOfBirthValue) && !is_bool($dateOfBirthValue)) {
            $actualPercent += $percentPart;
        }
        $placeOfBirthValue = $reflectionClass->getProperty('placeOfBirth')->getValue($this);
        if (!empty($placeOfBirthValue) && !is_bool($placeOfBirthValue)) {
            $actualPercent += $percentPart;
        }
        $sectorValue = $reflectionClass->getProperty('sector')->getValue($this);
        if (!empty($sectorValue) && !is_bool($sectorValue)) {
            $actualPercent += $percentPart;
        }
        $experienceValue = $reflectionClass->getProperty('experience')->getValue($this);
        if (!empty($experienceValue) && !is_bool($experienceValue)) {
            $actualPercent += $percentPart;
        }
        $descriptionValue = $reflectionClass->getProperty('description')->getValue($this);
        if (!empty($descriptionValue) && !is_bool($descriptionValue)) {
            $actualPercent += $percentPart;
        }
        return round($actualPercent);
    }
}
