<?php

namespace App\Repository;

use App\Entity\Profondeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Profondeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profondeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profondeur[]    findAll()
 * @method Profondeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfondeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profondeur::class);
    }

    // /**
    //  * @return Profondeur[] Returns an array of Profondeur objects
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
    public function findOneBySomeField($value): ?Profondeur
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
