<?php

namespace App\Entity;

use App\Repository\StatutTravailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutTravailRepository::class)]
class StatutTravail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeStatut = null;

    #[ORM\OneToMany(targetEntity: AncienEtudiant::class, mappedBy: 'statut')]
    private Collection $ancienEtudiants;

    #[ORM\ManyToMany(targetEntity: Filiere::class, mappedBy: 'statut')]
    private Collection $filieres;

    #[ORM\ManyToMany(targetEntity: Diplome::class, mappedBy: 'statut')]
    private Collection $diplomes;

    public function __construct()
    {
        $this->ancienEtudiants = new ArrayCollection();
        $this->filieres = new ArrayCollection();
        $this->diplomes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeStatut(): ?string
    {
        return $this->typeStatut;
    }

    public function setTypeStatut(string $typeStatut): static
    {
        $this->typeStatut = $typeStatut;

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
            $ancienEtudiant->setStatut($this);
        }

        return $this;
    }

    public function removeAncienEtudiant(AncienEtudiant $ancienEtudiant): static
    {
        if ($this->ancienEtudiants->removeElement($ancienEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($ancienEtudiant->getStatut() === $this) {
                $ancienEtudiant->setStatut(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->typeStatut ;
    }

    /**
     * @return Collection<int, Filiere>
     */
    public function getFilieres(): Collection
    {
        return $this->filieres;
    }

    public function addFiliere(Filiere $filiere): static
    {
        if (!$this->filieres->contains($filiere)) {
            $this->filieres->add($filiere);
            $filiere->addStatut($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): static
    {
        if ($this->filieres->removeElement($filiere)) {
            $filiere->removeStatut($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Diplome>
     */
    public function getDiplomes(): Collection
    {
        return $this->diplomes;
    }

    public function addDiplome(Diplome $diplome): static
    {
        if (!$this->diplomes->contains($diplome)) {
            $this->diplomes->add($diplome);
            $diplome->addStatut($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): static
    {
        if ($this->diplomes->removeElement($diplome)) {
            $diplome->removeStatut($this);
        }

        return $this;
    }
}
