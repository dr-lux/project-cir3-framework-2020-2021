<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * TempsRepository.php
 * 
 * Repository of the 'Temps' entity with API's functions.
 */
namespace App\Repository;

use App\Entity\Temps;
use App\Entity\Profondeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Temps|null find($id, $lockMode = null, $lockVersion = null)
 * @method Temps|null findOneBy(array $criteria, array $orderBy = null)
 * @method Temps[]    findAll()
 * @method Temps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Temps::class);
    }

    // /**
    //  * findApiAll()
    //  * 
    //  * Function to query the database to get all "Temps" entities.
    //  */
    public function findApiAll()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

    // /**
    //  * findApi_Temps_by_Depth_and_Time($depth, $time)
    //  * 
    //  * Function to query the database to get the first result from "Temps" where the depth and the time have some values.
    //  * The equivalent MySQL query look like this: 
    //  * SELECT * FROM temps INNER JOIN profondeur ON temps.est_a_id = profondeur.id WHERE profondeur>=`$depth` AND temps>=`$Time` LIMIT 1;
    //  */
    public function findApi_Temps_by_Depth_and_Time($depth, $time)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin(Profondeur::class, 'p', 'WITH', 't.est_a = p.id')
            ->where('p.profondeur >= :depth')
            ->setParameter('depth', $depth)
            ->andWhere('t.temps >= :time')
            ->setParameter('time', $time)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}
