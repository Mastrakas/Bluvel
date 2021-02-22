<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param $value
     * @return Article[] Returns an array of Article objects
     */

    public function findByTypeArticle($value = null)
    {
        return $this->createQueryBuilder('article')
            ->select('article')

            ->leftJoin(
                'article.typeArticle',
                'typeArticle'
            )
            ->addSelect('typeArticle')
            //->andWhere('typearticle.name = :val')
            //->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Article
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
