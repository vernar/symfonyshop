<?php

namespace App\Repository;

use App\Entity\Adminuser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adminuser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adminuser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adminuser[]    findAll()
 * @method Adminuser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminuserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adminuser::class);
    }

    // /**
    //  * @return Adminuser[] Returns an array of Adminuser objects
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
    public function findOneBySomeField($value): ?Adminuser
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
