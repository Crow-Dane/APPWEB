<?php

namespace App\Repository;

use App\Entity\StatutTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatutTravail>
 *
 * @method StatutTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutTravail[]    findAll()
 * @method StatutTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutTravailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutTravail::class);
    }

//    /**
//     * @return StatutTravail[] Returns an array of StatutTravail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatutTravail
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
