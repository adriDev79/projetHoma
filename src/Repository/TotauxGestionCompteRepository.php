<?php

namespace App\Repository;

use App\Entity\TotauxGestionCompte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TotauxGestionCompte|null find($id, $lockMode = null, $lockVersion = null)
 * @method TotauxGestionCompte|null findOneBy(array $criteria, array $orderBy = null)
 * @method TotauxGestionCompte[]    findAll()
 * @method TotauxGestionCompte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TotauxGestionCompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TotauxGestionCompte::class);
    }

    // /**
    //  * @return TotauxGestionCompte[] Returns an array of TotauxGestionCompte objects
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
    public function findOneBySomeField($value): ?TotauxGestionCompte
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
