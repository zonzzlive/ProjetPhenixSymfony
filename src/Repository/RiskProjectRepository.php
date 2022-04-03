<?php

namespace App\Repository;

use App\Entity\RiskProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RiskProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method RiskProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method RiskProject[]    findAll()
 * @method RiskProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiskProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RiskProject::class);
    }

    // /**
    //  * @return RiskProject[] Returns an array of RiskProject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RiskProject
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
