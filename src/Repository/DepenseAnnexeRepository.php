<?php

namespace App\Repository;

use App\Entity\DepenseAnnexe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepenseAnnexe|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepenseAnnexe|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepenseAnnexe[]    findAll()
 * @method DepenseAnnexe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepenseAnnexeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepenseAnnexe::class);
    }

    // /**
    //  * @return DepenseAnnexe[] Returns an array of DepenseAnnexe objects
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
    public function findOneBySomeField($value): ?DepenseAnnexe
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
