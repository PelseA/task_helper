<?php

namespace App\Repository;

use App\Entity\TaskTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TaskTitle|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskTitle|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskTitle[]    findAll()
 * @method TaskTitle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskTitleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskTitle::class);
    }

    // /**
    //  * @return TaskTitle[] Returns an array of TaskTitle objects
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
    public function findOneBySomeField($value): ?TaskTitle
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
