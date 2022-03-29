<?php

namespace App\Controller;

use App\Entity\ENTREPRISE;
use App\Entity\PERSONNE;
use App\Form\EntrepriseType;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEntrepriseController extends AbstractController
{
    /**
     * @Route("/liste_entreprise", name="listeEntreprise")
     */
    public function listeEntreprises(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->AffichageEntreprise();
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises]);

    }

    /**
     * @Route("/ajoutentreprise", name="AjoutEntreprise")
     */
    public function ajoutEntreprise(ManagerRegistry $em, Request $request): Response
    {
        $entreprise = new ENTREPRISE();
        $AjoutEntrepriseForm = $this->createForm(EntrepriseType::class, $entreprise);

        if  ( $request->isMethod('POST'))
        {
            $AjoutEntrepriseForm->handleRequest($request);

            $em = $em->getManager();
            $em->persist($entreprise);
            $em->flush();
            return $this->redirectToRoute('listeEntreprise');
        }
        return $this->render('AjoutEntreprise.html.twig', ['AjoutEntrepriseForm' => $AjoutEntrepriseForm->createView()]);
    }

    /**
     * @Route("/infos_entreprise/{id}", name="InfosEntreprise")
     */
    public function InfosEntreprise(ManagerRegistry $em, $id): Response
    {
        $em = $em->getManager();
        $entreprise = $em->getRepository(ENTREPRISE::class)->find($id);
<<<<<<< HEAD
        $entPersonne = $em->getRepository(PERSONNE::class)->findLastBy($entreprise);
=======
        $entPersonne = $em->getRepository(PERSONNE::class)->findlastby($entreprise);
        dd($entreprise, $entPersonne);
>>>>>>> 76eb1159c20527ade96fa7efbcd953942c18106c


        return $this->render('InfosEntreprise.html.twig', array('uneEntreprise' => $entreprise));
    }
}