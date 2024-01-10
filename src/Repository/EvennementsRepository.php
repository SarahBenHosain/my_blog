<?php

namespace App\Repository;

use App\Entity\Evennements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evennements>
 *
 * @method Evennements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evennements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evennements[]    findAll()
 * @method Evennements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvennementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evennements::class);
    }

//    /**
//     * @return Evennements[] Returns an array of Evennements objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Evennements
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
