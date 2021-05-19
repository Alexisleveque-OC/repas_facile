<?php

namespace App\Repository;

use App\Entity\RecipeLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeLine[]    findAll()
 * @method RecipeLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeLine::class);
    }

    // /**
    //  * @return RecipeLine[] Returns an array of RecipeLine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipeLine
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
