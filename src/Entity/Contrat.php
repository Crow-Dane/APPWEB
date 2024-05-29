<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $typeContrat = null;

    #[ORM\OneToMany(targetEntity: AncienEtudiant::class, mappedBy: 'contrat')]
    private Collection $ancienEtudiants;

    public function __construct()
    {
        $this->ancienEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?string $typeContrat): static
    {
        $this->typeContrat = $typeContrat;

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
            $ancienEtudiant->setContrat($this);
        }

        return $this;
    }

    public function removeAncienEtudiant(AncienEtudiant $ancienEtudiant): static
    {
        if ($this->ancienEtudiants->removeElement($ancienEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($ancienEtudiant->getContrat() === $this) {
                $ancienEtudiant->setContrat(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->typeContrat ;
    }
}
