<?php

namespace App\Repository;

use App\Entity\Grf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Grf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grf[]    findAll()
 * @method Grf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grf::class);
    }

    // /**
    //  * @return Grf[] Returns an array of Grf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grf
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
