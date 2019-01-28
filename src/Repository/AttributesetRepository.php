<?php

namespace App\Repository;

use App\Entity\Attributeset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Attributeset|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attributeset|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attributeset[]    findAll()
 * @method Attributeset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributesetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Attributeset::class);
    }

    // /**
    //  * @return Attributeset[] Returns an array of Attributeset objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attributeset
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
