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

        $personne = $entityManager->getRepository(PERSONNE::class)->findPersonneByEnt();
        
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->findAll();
    
        return $this->render('/ListeEntreprise.html.twig', array('listeEntreprises' => $listeEntreprises, 'InfosPersonne' => $personne));
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
        $entPersonne = $em->getRepository(PERSONNE::class)->findPersonne($entreprise);
        dd($entreprise, $entPersonne);

        return $this->render('InfosEntreprise.html.twig', array('uneEntreprise'=>$entreprise));
    }
}