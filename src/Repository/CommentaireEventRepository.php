<?php

namespace App\Repository;

use App\Entity\CommentaireEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentaireEvent>
 *
 * @method CommentaireEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireEvent[]    findAll()
 * @method CommentaireEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireEvent::class);
    }

//    /**
//     * @return CommentaireEvent[] Returns an array of CommentaireEvent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommentaireEvent
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
