<?php

namespace App\Repository;

use App\Entity\FONCTION;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FONCTION>
 *
 * @method FONCTION|null find($id, $lockMode = null, $lockVersion = null)
 * @method FONCTION|null findOneBy(array $criteria, array $orderBy = null)
 * @method FONCTION[]    findAll()
 * @method FONCTION[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FONCTIONRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FONCTION::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FONCTION $entity, bool $flush = true): void
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
    public function remove(FONCTION $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function findFonctionPersonne()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT per_nom, per_prenom, fon_libelle 
        FROM fonction_personne AS FB INNER JOIN fonction AS F ON FB.fonction_id = F.id 
        INNER JOIN personne AS P ON P.id = FB.personne_id 
        ORDER BY per_nom';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
    }
    // /**
    //  * @return FONCTION[] Returns an array of FONCTION objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FONCTION
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
