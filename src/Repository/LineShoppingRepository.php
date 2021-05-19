<?php

namespace App\Repository;

use App\Entity\LineShopping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LineShopping|null find($id, $lockMode = null, $lockVersion = null)
 * @method LineShopping|null findOneBy(array $criteria, array $orderBy = null)
 * @method LineShopping[]    findAll()
 * @method LineShopping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineShoppingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LineShopping::class);
    }

    // /**
    //  * @return LineShopping[] Returns an array of LineShopping objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LineShopping
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
