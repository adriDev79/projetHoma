<?php

namespace App\Repository;

use App\Entity\DepenseFixe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepenseFixe|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepenseFixe|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepenseFixe[]    findAll()
 * @method DepenseFixe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepenseFixeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepenseFixe::class);
    }

    // /**
    //  * @return DepenseFixe[] Returns an array of DepenseFixe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DepenseFixe
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
