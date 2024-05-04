<?php

namespace App\Repository;

use App\Entity\Exercice;
use App\Entity\MuscleGroup;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Exercice>
 *
 * @method Exercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercice[]    findAll()
 * @method Exercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercice::class);
    }

    // public function findExercisesByMuscleGroup(MuscleGroup $muscleGroup): array
    // {
    //     return $this->createQueryBuilder('e')
    //         ->where('e.target = :muscleGroup')
    //         ->setParameter('muscleGroup', $muscleGroup)
    //         ->getQuery()
    //         ->getResult();
    // }

    public function findExercisesByMuscle($muscle)
    {
        return $this->createQueryBuilder('e')
            ->where('e.target = :muscle')
            ->setParameter('muscle', $muscle)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Exercice[] Returns an array of Exercice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Exercice
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
