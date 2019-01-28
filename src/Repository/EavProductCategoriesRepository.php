<?php

namespace App\Repository;

use App\Entity\EavProductCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EavProductCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method EavProductCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method EavProductCategories[]    findAll()
 * @method EavProductCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EavProductCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EavProductCategories::class);
    }

    // /**
    //  * @return EavProductCategories[] Returns an array of EavProductCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EavProductCategories
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
