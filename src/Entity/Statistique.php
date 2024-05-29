<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatistiqueRepository::class)]
class Statistique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nombreEtudiantChomage = null;

    #[ORM\Column]
    private ?int $nombreEtudiantEmploye = null;

    #[ORM\Column]
    private ?int $nombreEtudiantLicence = null;

    #[ORM\Column]
    private ?int $nombreEtudiantDUT = null;

    #[ORM\Column]
    private ?int $nombreEtudiantEntrepreneur = null;

    #[ORM\Column]
    private ?int $nombreEtudiantFonctionneur = null;


    #[ORM\Column]
    private ?float $pourcentageEtudiantChomage = null;

    #[ORM\Column]
    private ?float $pourcentageEtudiantEmploye = null;

    #[ORM\Column]
    private ?float $pourcentageEtudiantAutoEntrepreneur = null;

    #[ORM\ManyToMany(targetEntity: AncienEtudiant::class, mappedBy: 'statistique')]
    private Collection $ancienEtudiants;

    public function __construct()
    {
        $this->ancienEtudiants = new ArrayCollection();
    }

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEtudiantChomage(): ?int
    {
        return $this->nombreEtudiantChomage;
    }

    public function setNombreEtudiantChomage(int $nombreEtudiantChomage): static
    {
        $this->nombreEtudiantChomage = $nombreEtudiantChomage;

        return $this;
    }

    public function getNombreEtudiantEmploye(): ?int
    {
        return $this->nombreEtudiantEmploye;
    }

    public function setNombreEtudiantEmploye(int $nombreEtudiantEmploye): static
    {
        $this->nombreEtudiantEmploye = $nombreEtudiantEmploye;

        return $this;
    }

    public function getNombreEtudiantLicence(): ?int
    {
        return $this->nombreEtudiantLicence;
    }

    public function setNombreEtudiantLicence(int $nombreEtudiantLicence): static
    {
        $this->nombreEtudiantLicence = $nombreEtudiantLicence;

        return $this;
    }

    public function getNombreEtudiantDUT(): ?int
    {
        return $this->nombreEtudiantDUT;
    }

    public function setNombreEtudiantDUT(int $nombreEtudiantDUT): static
    {
        $this->nombreEtudiantDUT = $nombreEtudiantDUT;

        return $this;
    }

    public function getNombreEtudiantEntrepreneur(): ?int
    {
        return $this->nombreEtudiantEntrepreneur;
    }

    public function setNombreEtudiantEntrepreneur(int $nombreEtudiantEntrepreneur): static
    {
        $this->nombreEtudiantEntrepreneur = $nombreEtudiantEntrepreneur;

        return $this;
    }

    public function getPourcentageEtudiantChomage(): ?float
    {
        return $this->pourcentageEtudiantChomage;
    }

    public function setPourcentageEtudiantChomage(float $pourcentageEtudiantChomage): static
    {
        $this->pourcentageEtudiantChomage = $pourcentageEtudiantChomage;

        return $this;
    }

    public function getPourcentageEtudiantEmploye(): ?float
    {
        return $this->pourcentageEtudiantEmploye;
    }

    public function setPourcentageEtudiantEmploye(float $pourcentageEtudiantEmploye): static
    {
        $this->pourcentageEtudiantEmploye = $pourcentageEtudiantEmploye;

        return $this;
    }

    public function getPourcentageEtudiantAutoEntrepreneur(): ?float
    {
        return $this->pourcentageEtudiantAutoEntrepreneur;
    }

    public function setPourcentageEtudiantAutoEntrepreneur(float $pourcentageEtudiantAutoEntrepreneur): static
    {
        $this->pourcentageEtudiantAutoEntrepreneur = $pourcentageEtudiantAutoEntrepreneur;

        return $this;
    }

    public function getNombreEtudiantFonctionneur(): ?int
    {
        return $this->nombreEtudiantFonctionneur;
    }

    public function setNombreEtudiantFonctionneur(int $nombreEtudiantFonctionneur): static
    {
        $this->nombreEtudiantFonctionneur = $nombreEtudiantFonctionneur;

        return $this;
    }

    /**
     * @return Collection<int, AncienEtudiant>
     */
    public function getAncienEtudiants(): Collection
    {
        return $this->ancienEtudiants;
    }

    public function addAncienEtudiant(AncienEtudiant $ancienEtudiant): static
    {
        if (!$this->ancienEtudiants->contains($ancienEtudiant)) {
            $this->ancienEtudiants->add($ancienEtudiant);
            $ancienEtudiant->addStatistique($this);
        }

        return $this;
    }

    public function removeAncienEtudiant(AncienEtudiant $ancienEtudiant): static
    {
        if ($this->ancienEtudiants->removeElement($ancienEtudiant)) {
            $ancienEtudiant->removeStatistique($this);
        }

        return $this;
    }

    
}
