<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAllProduct()
    {
        $qb = $this->getBaseQueryBuilder();
        return $qb->getQuery()->getResult();
    }

    public function findOneById(int $product_id)
    {
        $qb = $this->getBaseQueryBuilder();
        self::addIdClause($qb, $product_id);
//dd($qb->getQuery());
        return $qb->getQuery()
            ->getOneOrNullResult();
    }

    protected function getBaseQueryBuilder()
    {
        return $this->createQueryBuilder("p")
            ->select('p');
    }

    protected static function addIdClause(QueryBuilder $qb, int $product_id)
    {
        return $qb->andWhere("p.id = :product_id")
            ->setParameter('product_id', $product_id);
    }
}
