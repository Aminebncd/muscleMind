<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Tracking;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Tracking>
 *
 * @method Tracking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tracking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tracking[]    findAll()
 * @method Tracking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tracking::class);
    }

    public function getLatest(User $user)
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.userTracked = :user')
        ->setParameter('user', $user)
        ->orderBy('t.dateOfTracking', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
}



    //    /**
    //     * @return Tracking[] Returns an array of Tracking objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Tracking
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
