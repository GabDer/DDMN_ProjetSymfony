<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Utilisateur $entity, bool $flush = true): void
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
    public function remove(Utilisateur $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Utilisateur[] Returns an array of Utilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function LoginVerification(string $Login, string $MDP)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT UTI_Login, UTI_MDP FROM Utilisateur
            WHERE UTI_Login = :login AND UTI_MDP = MD5(:mdp)
            ';
        $stmt = $conn->prepare($sql);
        $resultat = $stmt->executeQuery(['login' => $Login, 'mdp' => $MDP]);
        // returns an array of arrays (i.e. a raw data set)
        return $resultat->fetchAssociative();
    }

    public function GetRole(string $Login)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT UTI_ROLE FROM Utilisateur
            WHERE UTI_Login = :login
            ';
        $stmt = $conn->prepare($sql);
        $resultat = $stmt->executeQuery(['login' => $Login]);
        // returns an array of arrays (i.e. a raw data set)
        return $resultat->fetchAssociative();
    }
    /*
    public function findOneBySomeField($value): ?Utilisateur
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
