<?php

namespace App\Repository;

use App\Entity\PhotosVideos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotosVideos|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotosVideos|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotosVideos[]    findAll()
 * @method PhotosVideos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotosVideosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotosVideos::class);
    }

    // /**
    //  * @return PhotosVideos[] Returns an array of PhotosVideos objects
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

    /*
    public function findOneBySomeField($value): ?PhotosVideos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
