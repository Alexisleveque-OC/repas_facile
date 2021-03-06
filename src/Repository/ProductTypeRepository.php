<?php

namespace App\Repository;

use App\Entity\ProductType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductType[]    findAll()
 * @method ProductType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductType::class);
    }

    public function findAllProductType()
    {
        $qb = $this->getBaseQueryBuilder();

        return $qb->getQuery()->getResult();
    }

    protected function getBaseQueryBuilder()
    {
        return $this->createQueryBuilder("pt")
            ->select('product_type');
    }


}
