<?php

namespace App\Repository;

use App\Entity\Cupcake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cupcake|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cupcake|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cupcake[]    findAll()
 * @method Cupcake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupcakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cupcake::class);
    }

    // /**
    //  * @return Cupcake[] Returns an array of Cupcake objects
    //  */
    /*


    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cupcake
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
