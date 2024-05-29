<?php

namespace App\Entity;

use App\Repository\AncienEtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AncienEtudiantRepository::class)]
class AncienEtudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;

    #[ORM\Column(length: 25)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $tel = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $anneeSortie = null;

    #[ORM\Column(length: 255)]
    private ?string $posteOccuper = null;

    #[ORM\ManyToOne(inversedBy: 'ancienEtudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\ManyToMany(targetEntity: Filiere::class, inversedBy: 'ancienEtudiants')]
    private Collection $Filiere;

    #[ORM\ManyToMany(targetEntity: Diplome::class, inversedBy: 'ancienEtudiants')]
    private Collection $diplome;

    #[ORM\ManyToOne(inversedBy: 'ancienEtudiants')]
    private ?Contrat $contrat = null;

    #[ORM\ManyToOne(inversedBy: 'ancienEtudiants')]
    private ?StatutTravail $statut = null;

    #[ORM\ManyToMany(targetEntity: Statistique::class, inversedBy: 'ancienEtudiants')]
    private Collection $statistique;

    public function __construct()
    {
        $this->Filiere = new ArrayCollection();
        $this->diplome = new ArrayCollection();
        $this->statistique = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAnneeSortie(): ?\DateTimeImmutable
    {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(\DateTimeImmutable $anneeSortie): static
    {
        $this->anneeSortie = $anneeSortie;

        return $this;
    }

    public function getPosteOccuper(): ?string
    {
        return $this->posteOccuper;
    }

    public function setPosteOccuper(string $posteOccuper): static
    {
        $this->posteOccuper = $posteOccuper;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Filiere>
     */
    public function getFiliere(): Collection
    {
        return $this->Filiere;
    }

    public function addFiliere(Filiere $filiere): static
    {
        if (!$this->Filiere->contains($filiere)) {
            $this->Filiere->add($filiere);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): static
    {
        $this->Filiere->removeElement($filiere);

        return $this;
    }

    /**
     * @return Collection<int, Diplome>
     */
    public function getDiplome(): Collection
    {
        return $this->diplome;
    }

    public function addDiplome(Diplome $diplome): static
    {
        if (!$this->diplome->contains($diplome)) {
            $this->diplome->add($diplome);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): static
    {
        $this->diplome->removeElement($diplome);

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): static
    {
        $this->contrat = $contrat;

        return $this;
    }

    public function getStatut(): ?statutTravail
    {
        return $this->statut;
    }

    public function setStatut(?statutTravail $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Statistique>
     */
    public function getStatistique(): Collection
    {
        return $this->statistique;
    }

    public function addStatistique(Statistique $statistique): static
    {
        if (!$this->statistique->contains($statistique)) {
            $this->statistique->add($statistique);
        }

        return $this;
    }

    public function removeStatistique(Statistique $statistique): static
    {
        $this->statistique->removeElement($statistique);

        return $this;
    }
}
