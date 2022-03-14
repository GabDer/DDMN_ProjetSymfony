<?php

namespace App\Controller;

use App\Entity\ENTREPRISE;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEntrepriseController extends AbstractController
{
    /**
     * @Route("/listeEntreprise", name="listeEntreprise")
     */
    public function listeEntreprises(ManagerRegistery $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->findAll();
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises]);
    }
}