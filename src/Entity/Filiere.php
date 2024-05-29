<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiliereRepository::class)]
class Filiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: AncienEtudiant::class, mappedBy: 'Filiere')]
    private Collection $ancienEtudiants;

    #[ORM\ManyToMany(targetEntity: StatutTravail::class, inversedBy: 'filieres')]
    private Collection $statut;

    public function __construct()
    {
        $this->ancienEtudiants = new ArrayCollection();
        $this->statut = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
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

    public function addAncienEtudiant(AncienEtudiant $ancienEtudiant): static
    {
        if (!$this->ancienEtudiants->contains($ancienEtudiant)) {
            $this->ancienEtudiants->add($ancienEtudiant);
            $ancienEtudiant->addFiliere($this);
        }

        return $this;
    }

    public function removeAncienEtudiant(AncienEtudiant $ancienEtudiant): static
    {
        if ($this->ancienEtudiants->removeElement($ancienEtudiant)) {
            $ancienEtudiant->removeFiliere($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->nom ;
    }

    /**
     * @return Collection<int, StatutTravail>
     */
    public function getStatut(): Collection
    {
        return $this->statut;
    }

    public function addStatut(StatutTravail $statut): static
    {
        if (!$this->statut->contains($statut)) {
            $this->statut->add($statut);
        }

        return $this;
    }

    public function removeStatut(StatutTravail $statut): static
    {
        $this->statut->removeElement($statut);

        return $this;
    }
}
