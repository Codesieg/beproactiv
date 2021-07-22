<?php

namespace App\Repository;

use App\Entity\Materiels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materiels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiels[]    findAll()
 * @method Materiels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiels::class);
    }

    public function findAllWithType()
    {   
        $qb = $this->createQueryBuilder('materiels')
        ->leftJoin ('materiels.type','types')
        ->addSelect('types');
        
        $query = $qb->getQuery(); 
        $results = $query->getResult();
        return $results; 
    }

    public function findAllWithTypeId($idFamille, $idMarque ="null")
    {   
        $qb = $this->createQueryBuilder('materiels')
        ->leftJoin ('materiels.type','types')
        ->addSelect('types')
        ->andwhere('materiels.type = :idFamille')
        ->orWhere('materiels.marque = :idMarque')
        ->setParameter('idFamille', $idFamille)
        ->setParameter('idMarque', $idMarque);
        
        $query = $qb->getQuery(); 
        $results = $query->getResult();
        return $results; 
    }


    /*
    public function findOneBySomeField($value): ?Materiels
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
