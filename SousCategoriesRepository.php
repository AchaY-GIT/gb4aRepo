<?php

namespace App\Repository;

use App\Entity\categories;
use App\Entity\SousCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SousCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousCategories[]    findAll()
 * @method SousCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCategories::class);
    }

    // /**
    //  * @return SousCategories[] Returns an array of SousCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findGroupBySousCategories(Categories $categorie )
    {
        return $this->createQueryBuilder('sC')
            ->select('sC')
            ->andWhere('sC.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->leftJoin('c.sousCategorie', 'sC')
            ->addGroupBy('sC')
            ->getQuery()
            ->getArrayResult()
    ;
    }



}
