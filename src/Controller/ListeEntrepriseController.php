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
    public function listeEntreprises(): Response
    {
        return $this->render('liste_entreprise/index.html.twig', [
            'controller_name' => 'ListeEntreprises.html.twig',
        ]);
    }
}