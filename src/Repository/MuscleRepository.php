<?php

namespace App\Repository;

use App\Entity\Muscle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Muscle>
 *
 * @method Muscle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Muscle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Muscle[]    findAll()
 * @method Muscle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuscleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Muscle::class);
    }

    public function findMusclesInMuscleGroup($muscleGroup)
    {
        return $this->createQueryBuilder('m')
            ->where('m.muscleGroup = :muscleGroup')
            ->setParameter('muscleGroup', $muscleGroup)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Muscle[] Returns an array of Muscle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Muscle
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
