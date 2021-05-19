<?php

namespace App\Repository;

use App\Entity\DayMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DayMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayMenu[]    findAll()
 * @method DayMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayMenu::class);
    }

    // /**
    //  * @return DayMenu[] Returns an array of DayMenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DayMenu
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
