<?php

namespace App\Repository;

use App\Entity\ENTREPRISE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ENTREPRISE|null find($id, $lockMode = null, $lockVersion = null)
 * @method ENTREPRISE|null findOneBy(array $criteria, array $orderBy = null)
 * @method ENTREPRISE[]    findAll()
 * @method ENTREPRISE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ENTREPRISERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ENTREPRISE::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ENTREPRISE $entity, bool $flush = true): void
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
    public function remove(ENTREPRISE $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function AffichageEntreprise()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT  id, ent_raison_sociale, ent_site_web
        FROM Entreprise
        ORDER BY ent_raison_sociale ASC';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function AffichagePersonnesEntreprise(string $RS)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT ent_raison_sociale, PER_NOM, PER_PRENOM
        FROM personne as P INNER JOIN entreprise as E ON E.id = P.entreprise_id
        WHERE ent_raison_sociale = :RS
        ORDER BY ent_raison_sociale';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['RS' => $RS]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function RechercheParNom(string $nom)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT DISTINCT ent_raison_sociale FROM entreprise
        INNER JOIN personne ON personne.entreprise_id=entreprise.id
        WHERE PER_NOM = :nom
        ORDER BY ent_raison_sociale';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['nom' => $nom]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function RechercheParCP(int $CP)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT DISTINCT ent_raison_sociale FROM entreprise
        WHERE ent_cp = :CP
        ORDER BY ent_raison_sociale";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['CP' => $CP]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    public function RechercheParEntreprise(string $RS)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT DISTINCT ent_raison_sociale FROM entreprise
        WHERE ent_raison_sociale LIKE :RS
        ORDER BY ent_raison_sociale";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['RS' => '%'.$RS.'%']);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    public function findOneEntreprise($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM entreprise as e INNER JOIN personne as p 
            on e.id = p.id
            WHERE entreprise_id = :ent_id';
        $stmt = $conn->prepare($sql);
        $resultat = $stmt->executeQuery(['ent_id' => $id]);
        // returns an array of arrays (i.e. a raw data set)
        return $resultat->fetchAssociative();
    }
    // /**//  * @return ENTREPRISE[] Returns an array of ENTREPRISE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ENTREPRISE
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // /**
    //  * @return ENTREPRISE[] Returns an array of ENTREPRISE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ENTREPRISE
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
