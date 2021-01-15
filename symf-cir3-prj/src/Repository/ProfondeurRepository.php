<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * ProfondeurRepository.php
 * 
 * Repository of the 'Profondeur' entity with API's function.
 */

namespace App\Repository;

use App\Entity\Profondeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

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

    /**
     * findApiAll()
     * 
     * Function to query the database to get all "Profondeur" entries.
     */
    public function findApiAll()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }

    /**
     * findFirstByDepth()
     * 
     * Function to query the database to get the first "Profondeur" entry by a specified depth.
     */
    public function findFirstByDepth($depth)
    {
        return $this->createQueryBuilder('t')
            ->where('t.profondeur >= :depth')
            ->setParameter('depth', $depth)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;
    }
}
