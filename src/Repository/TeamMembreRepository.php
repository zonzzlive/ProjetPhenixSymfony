<?php

namespace App\Repository;

use App\Entity\TeamMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TeamMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamMembre[]    findAll()
 * @method TeamMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamMembre::class);
    }

    // /**
    //  * @return TeamMembre[] Returns an array of TeamMembre objects
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
    public function findOneBySomeField($value): ?TeamMembre
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
