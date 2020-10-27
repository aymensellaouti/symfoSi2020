<?php

namespace App\Repository;

use App\Entity\PieceIdentite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PieceIdentite|null find($id, $lockMode = null, $lockVersion = null)
 * @method PieceIdentite|null findOneBy(array $criteria, array $orderBy = null)
 * @method PieceIdentite[]    findAll()
 * @method PieceIdentite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PieceIdentiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PieceIdentite::class);
    }

    // /**
    //  * @return PieceIdentite[] Returns an array of PieceIdentite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PieceIdentite
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
