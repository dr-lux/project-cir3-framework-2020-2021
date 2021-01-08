<?php

namespace App\Repository;

use App\Entity\TablePlongee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method TablePlongee|null find($id, $lockMode = null, $lockVersion = null)
 * @method TablePlongee|null findOneBy(array $criteria, array $orderBy = null)
 * @method TablePlongee[]    findAll()
 * @method TablePlongee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TablePlongeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TablePlongee::class);
    }

    // /**
    //  * @return TablePlongee[] Returns an array of TablePlongee objects
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
    public function findOneBySomeField($value): ?TablePlongee
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // public function findApiAll()
    // {
    //     return $this->createQueryBuilder('c')
    //         ->getQuery()
    //         ->getResult(Query::HYDRATE_ARRAY)
    //     ;
    // }
}
