<?php

namespace App\Repository;

use App\Entity\MesureType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MesureType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MesureType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MesureType[]    findAll()
 * @method MesureType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesureTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MesureType::class);
    }

    // /**
    //  * @return MesureType[] Returns an array of MesureType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MesureType
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
