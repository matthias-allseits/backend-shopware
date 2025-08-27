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
            ->andWhere('p.productNumber LIKE :search')
            ->setParameter('search', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult()
        ;
//        $query = $this->getEntityManager()->createQuery(
//            'SELECT p
//            FROM App\Entity\Product p
//            WHERE p.productNumber LIKE :search'
//        )
//            ->setParameter('search', '%' . $searchTerm . '%')
//        ;
//        $results = $query->getResult();
//
//        return $results;
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
}
