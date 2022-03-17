<?php

namespace App\Repository;

use App\Entity\SPECIALITE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SPECIALITE|null find($id, $lockMode = null, $lockVersion = null)
 * @method SPECIALITE|null findOneBy(array $criteria, array $orderBy = null)
 * @method SPECIALITE[]    findAll()
 * @method SPECIALITE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SPECIALITERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SPECIALITE::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SPECIALITE $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(SPECIALITE $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return SPECIALITE[] Returns an array of SPECIALITE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SPECIALITE
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
