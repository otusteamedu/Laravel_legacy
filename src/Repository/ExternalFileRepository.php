<?php

namespace App\Repository;

use App\Entity\ExternalFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExternalFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalFile[]    findAll()
 * @method ExternalFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExternalFile::class);
    }

    // /**
    //  * @return ExternalFile[] Returns an array of ExternalFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExternalFile
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
