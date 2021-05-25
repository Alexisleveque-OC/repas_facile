<?php

namespace App\Repository;

use App\Entity\RecipeSpecial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeSpecial|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeSpecial|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeSpecial[]    findAll()
 * @method RecipeSpecial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeSpecialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeSpecial::class);
    }

    // /**
    //  * @return RecipeSpecial[] Returns an array of RecipeSpecial objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipeSpecial
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
