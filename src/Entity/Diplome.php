<?php

namespace App\Entity;

use App\Repository\DiplomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomeRepository::class)]
class Diplome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: AncienEtudiant::class, mappedBy: 'diplome')]
    private Collection $ancienEtudiants;

    #[ORM\ManyToMany(targetEntity: StatutTravail::class, inversedBy: 'diplomes')]
    private Collection $statut;

    public function __construct()
    {
        $this->ancienEtudiants = new ArrayCollection();
        $this->statut = new ArrayCollection(); // Initialisation de la collection statut
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, AncienEtudiant>
     */
    public function getAncienEtudiants(): Collection
    {
        return $this->ancienEtudiants;
    }

    public function addAncienEtudiant(AncienEtudiant $ancienEtudiant): self
    {
        if (!$this->ancienEtudiants->contains($ancienEtudiant)) {
            $this->ancienEtudiants[] = $ancienEtudiant;
            $ancienEtudiant->addDiplome($this);
        }

        return $this;
    }

    public function removeAncienEtudiant(AncienEtudiant $ancienEtudiant): self
    {
        if ($this->ancienEtudiants->removeElement($ancienEtudiant)) {
            $ancienEtudiant->removeDiplome($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, StatutTravail>
     */
    public function getStatut(): Collection
    {
        return $this->statut;
    }

    public function addStatut(StatutTravail $statut): self
    {
        if (!$this->statut->contains($statut)) {
            $this->statut[] = $statut;
            $statut->addDiplome($this);
        }

        return $this;
    }

    public function removeStatut(StatutTravail $statut): self
    {
        if ($this->statut->removeElement($statut)) {
            $statut->removeDiplome($this);
        }

        return $this;
    }
}
