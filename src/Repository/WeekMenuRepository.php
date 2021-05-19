<?php

namespace App\Repository;

use App\Entity\WeekMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeekMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeekMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeekMenu[]    findAll()
 * @method WeekMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeekMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeekMenu::class);
    }

    // /**
    //  * @return WeekMenu[] Returns an array of WeekMenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeekMenu
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
