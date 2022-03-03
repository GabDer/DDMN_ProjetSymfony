<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEntrepriseController extends AbstractController
{
    /**
     * @Route("/liste_entreprise", name="ListeEntreprise")
     */
    public function listeEntreprises()
    {
        $listeEntreprises = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises]);
    }
}