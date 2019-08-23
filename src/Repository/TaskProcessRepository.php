<?php

namespace App\Repository;

use App\Entity\TaskProcess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TaskProcess|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskProcess|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskProcess[]    findAll()
 * @method TaskProcess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskProcessRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TaskProcess::class);
    }

    // /**
    //  * @return TaskProcess[] Returns an array of TaskProcess objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TaskProcess
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
