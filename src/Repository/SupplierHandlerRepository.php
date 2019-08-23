<?php

namespace App\Repository;

use App\Entity\SupplierHandler;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SupplierHandler|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplierHandler|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplierHandler[]    findAll()
 * @method SupplierHandler[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierHandlerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SupplierHandler::class);
    }

    // /**
    //  * @return SupplierHandler[] Returns an array of SupplierHandler objects
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
    public function findOneBySomeField($value): ?SupplierHandler
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
