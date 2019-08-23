<?php

namespace App\Repository;

use App\Entity\PriceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PriceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceType[]    findAll()
 * @method PriceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PriceType::class);
    }

    // /**
    //  * @return PriceType[] Returns an array of PriceType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PriceType
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
