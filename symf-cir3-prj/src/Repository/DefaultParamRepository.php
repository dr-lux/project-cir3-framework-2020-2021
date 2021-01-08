<?php

namespace App\Repository;

use App\Entity\DefaultParam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method DefaultParam|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefaultParam|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefaultParam[]    findAll()
 * @method DefaultParam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefaultParamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DefaultParam::class);
    }

    public function findApi()
    {
        return $this->createQueryBuilder('c')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }
}
