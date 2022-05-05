<?php

namespace App\Repository;

use App\Entity\PERSONNEPROFIL;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PERSONNEPROFIL>
 *
 * @method PERSONNEPROFIL|null find($id, $lockMode = null, $lockVersion = null)
 * @method PERSONNEPROFIL|null findOneBy(array $criteria, array $orderBy = null)
 * @method PERSONNEPROFIL[]    findAll()
 * @method PERSONNEPROFIL[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PERSONNEPROFILRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PERSONNEPROFIL::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PERSONNEPROFIL $entity, bool $flush = true): void
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
    public function remove(PERSONNEPROFIL $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PERSONNEPROFIL[] Returns an array of PERSONNEPROFIL objects
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
    public function findOneBySomeField($value): ?PERSONNEPROFIL
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
