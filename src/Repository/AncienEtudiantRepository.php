<?php

namespace App\Repository;

use App\Entity\AncienEtudiant;  
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<AncienEtudiant>
 *
 * @method AncienEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method AncienEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method AncienEtudiant[]    findAll()
 * @method AncienEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncienEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AncienEtudiant::class);
    }

    public function countTotal(): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->getQuery() 
            ->getSingleScalarResult(); 
    }
    
    public function countByStatut(string $statut): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->join('a.statut', 's')
            ->andWhere('s.typeStatut = :statut')
            ->setParameter('statut', $statut)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByDiplome(string $diplome): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->join('a.diplome', 'd')
            ->andWhere('d.nom = :diplome')
            ->setParameter('diplome', $diplome)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByFonctionnaire(): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->join('a.statut', 's')
            ->andWhere('s.typeStatut = :fonctionnaire')
            ->setParameter('fonctionnaire', 'Fonctionnaire')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByEntrepreneur(): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->join('a.statut', 's')
            ->andWhere('s.typeStatut = :entrepreneur')
            ->setParameter('entrepreneur', 'Entrepreneur')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByAutoEntrepreneur(): int
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->join('a.statut', 's')
            ->andWhere('s.typeStatut = :autoEntrepreneur')
            ->setParameter('autoEntrepreneur', 'Auto Entrepreneur')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findByMultipleCriteria($criteria): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('a');

        foreach ($criteria as $key => $value) {
            if ($key === 'anneeSortie') {
                $queryBuilder->andWhere($queryBuilder->expr()->eq('YEAR(a.anneeSortie)', ':criteria'.$key))
                    ->setParameter('criteria'.$key, $value);
            } else {
                $queryBuilder->andWhere(
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like('a.nom', ':criteria'.$key),
                        $queryBuilder->expr()->like('a.prenom', ':criteria'.$key),
                        $queryBuilder->expr()->like('a.tel', ':criteria'.$key),
                        $queryBuilder->expr()->like('a.anneeSortie', ':criteria'.$key),
                        $queryBuilder->expr()->like('a.posteOccuper', ':criteria'.$key)
                    )
                )->setParameter('criteria'.$key, '%'.$value.'%');
            }
        }

        return $queryBuilder;
    }

    public function sortByNom(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.nom', 'ASC');
    }

    public function sortByPrenom(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.prenom', 'ASC');
    }

    public function sortByPosteOccuper(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.posteOccuper', 'ASC');
    }

    public function sortByAnneeSortie(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.anneeSortie', 'DESC');
    }

    public function sortByDiplome(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->join('a.diplome', 'd')
            ->orderBy('d.nom', 'ASC');
    }

    public function sortByFiliere(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->join('a.filiere', 'f')
            ->orderBy('f.nom', 'ASC');
    }

    public function sortByStatutTravail(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->join('a.statutTravail', 's')
            ->orderBy('s.type', 'ASC');
    }

    public function sortByContrat(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->join('a.contrat', 'c')
            ->orderBy('c.type', 'ASC');
    }
}
