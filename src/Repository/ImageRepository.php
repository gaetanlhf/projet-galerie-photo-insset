<?php

namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function findAllImage($user)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.user = :val')
            ->setParameter('val', $user)
            ->orderBy('i.position', 'ASC')
        ;
    }

    public function findImagePublished($user)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.user = :val')
            ->setParameter('val', $user)
            ->andWhere('i.position != 0')
            ->orderBy('i.position', 'ASC')
        ;
    }

    public function countImage($user)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.user = :val')
            ->setParameter('val', $user)
            ->select('count(i.id)')
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

    public function findImageByUserAndPosition($user, $position)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.user = :user')
            ->setParameter('user', $user)
            ->andWhere('i.position != :position')
            ->setParameter('position', $position)
            ->orderBy('i.position', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
