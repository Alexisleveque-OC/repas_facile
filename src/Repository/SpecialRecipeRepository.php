<?php

namespace App\Repository;

use App\Entity\SpecialRecipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecialRecipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialRecipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialRecipe[]    findAll()
 * @method SpecialRecipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialRecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialRecipe::class);
    }

    // /**
    //  * @return SpecialRecipe[] Returns an array of SpecialRecipe objects
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
    public function findOneBySomeField($value): ?SpecialRecipe
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
