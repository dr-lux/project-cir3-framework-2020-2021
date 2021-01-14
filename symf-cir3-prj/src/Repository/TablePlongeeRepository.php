<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * TablePlongeeRepository.php
 * 
 * Repository of the 'TablePlongee'.
 */


namespace App\Repository;

use App\Entity\TablePlongee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
}
