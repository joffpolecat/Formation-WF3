<?php

namespace App\Repository;

use App\Entity\ArticleFollow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\Article;
use App\Entity\User;

/**
 * @method ArticleFollow|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleFollow|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleFollow[]    findAll()
 * @method ArticleFollow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleFollowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleFollow::class);
    }

    public function findOneByArticleAndUser(Article $article, $user)
    {
        if(!is_object($user))
        {
            return null;
        }
        
        return $this->createQueryBuilder('a')
            ->andWhere('a.article = :article')
            ->andWhere('a.user = :user')
            ->setParameter('user', $user)
            ->setParameter('article', $article)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return ArticleFollow[] Returns an array of ArticleFollow objects
//     */
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
    public function findOneBySomeField($value): ?ArticleFollow
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
