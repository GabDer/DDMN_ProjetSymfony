<?php

namespace App\Repository;

use App\Entity\PERSONNE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PERSONNE|null find($id, $lockMode = null, $lockVersion = null)
 * @method PERSONNE|null findOneBy(array $criteria, array $orderBy = null)
 * @method PERSONNE[]    findAll()
 * @method PERSONNE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PERSONNERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PERSONNE::class);
    }

    public function findPersonne($entreprise)
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findlastby($id)
    {
        return $this->createQueryBuilder('p')
        ->orderBy('p.id','ASC')
        ->andWhere('p.ENTREPRISE = :val')
        ->setParameter('val', $id)
        ->getQuery()
        ->getResult();
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PERSONNE $entity, bool $flush = true): void
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
    public function remove(PERSONNE $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findPersonneByEnt()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT ent_raison_sociale, PER_NOM, PER_PRENOM FROM `personne` 
            INNER JOIN entreprise ON personne.entreprise_id=entreprise.id ';
        $stmt = $conn->prepare($sql);
        $resultat = $stmt->executeQuery();
        // returns an array of arrays (i.e. a raw data set)
        return $resultat->fetchAllAssociative();
    }

    public function AffichagePersonneProfil(int $per_id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT PER.id, pro_libelle
            FROM Profil as Pro
            INNER JOIN PersonneProfil as PERPRO ON Pro.id=pro_id_id
            INNER JOIN Personne as Per ON per_id_id=per.id 
            WHERE PERPRO.PER_id_id = :per_id ';
        $stmt = $conn->prepare($sql);
        $resultat = $stmt->executeQuery(['per_id' => $per_id]);
        // returns an array of arrays (i.e. a raw data set)
        return $resultat->fetchAllAssociative();
    }

    // /**
    //  * @return PERSONNE[] Returns an array of PERSONNE objects
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
    public function findOneBySomeField($value): ?PERSONNE
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
