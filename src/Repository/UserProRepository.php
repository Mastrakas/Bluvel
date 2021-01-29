<?php

namespace App\Repository;

use App\Entity\UserPro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserPro|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPro|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPro[]    findAll()
 * @method UserPro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserProRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPro::class);
    }

    // /**
    //  * @return UserPro[] Returns an array of UserPro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserPro
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
