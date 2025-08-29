<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param $searchTerm
     * @return Product[]
     */
    public function searchBySearchTerm($searchTerm): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.translations', 't')
            ->andWhere('p.productNumber LIKE :search')
            ->orWhere('t.name LIKE :search')
            ->setParameter('search', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();
    }
}
