<?php

namespace App\Repository;

use App\Entity\Produits;
use App\Entity\Categories;
use App\Entity\SousCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    // /**
    //  * @return Produits[] Returns an array of Produits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
  /*public function findGroupBySousCategories(Categories $categorie)
    {
        return $this->createQueryBuilder('p')
            ->select('p','sC.type', 'sC.typeDescription', 'sC.images')
            ->andWhere('p.categorie = :categorie')
            ->setParameter('categorie', $categorie)
           
            ->leftJoin('p.categorie', 'c')
            ->leftJoin('c.sousCategorie', 'sC')
            ->addGroupBy('sC')
            ->getQuery()
            ->getArrayResult()
        ;
    }*/
    
    /* public function findGroupBySousCategories(Categories $categorie )
    {
        return $this->createQueryBuilder('p')
            ->select('p','sC.type','sC.id', 'sC.typeDescription', 'sC.images')
            ->andWhere('p.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->leftJoin('p.categorie', 'c')
            ->leftJoin('c.sousCategorie', 'sC')
            ->addGroupBy('sC')
            ->getQuery()
            ->getArrayResult()
    ;
    }*/

}
