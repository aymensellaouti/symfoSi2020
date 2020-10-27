<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    // /**
    //  * @return Personne[] Returns an array of Personne objects
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
    public function findOneBySomeField($value): ?Personne
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getPersonnesByIntervalAge($min = 0, $max = 0) {
        $qb = $this->createQueryBuilder('p');
        $this->extractPersonneByAge($qb, $min, $max);
        $qb->orderBy('p.age', 'asc');
        return $qb->getQuery()->getResult();
    }

    public function getAvgAgePersonnesByIntervalAge($min = 0, $max = 0) {
        $qb = $this->createQueryBuilder('p');
        $qb->select('avg(p.age) as ageMoyen');
        $this->extractPersonneByAge($qb, $min, $max);
        return $qb->getQuery()->getSingleScalarResult();
    }

    private function extractPersonneByAge($qb, $min, $max) {
        if($min) {
            $qb->andWhere('p.age > :ageMin')
                ->setParameter('ageMin', $min);
        }
        if($max) {
            $qb->andWhere('p.age < :ageMax')
               ->setParameter('ageMax', $max);
        }
        return $qb;
    }



}
