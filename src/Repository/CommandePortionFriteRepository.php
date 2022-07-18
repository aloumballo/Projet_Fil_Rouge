<?php

namespace App\Repository;

use App\Entity\CommandePortionFrite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandePortionFrite>
 *
 * @method CommandePortionFrite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandePortionFrite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandePortionFrite[]    findAll()
 * @method CommandePortionFrite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandePortionFriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandePortionFrite::class);
    }

    public function add(CommandePortionFrite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CommandePortionFrite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CommandePortionFrite[] Returns an array of CommandePortionFrite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommandePortionFrite
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
