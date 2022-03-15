<?php

namespace App\Controller;

use App\Entity\ENTREPRISE;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEntrepriseController extends AbstractController
{
    /**
     * @Route("/liste_entreprise", name="listeEntreprise")
     */
    public function listeEntreprises( ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->findAll();
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises]);
    }
}