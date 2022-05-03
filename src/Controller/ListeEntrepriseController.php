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
    public function listeEntreprises(Request $request ,ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->AffichageEntreprise(); //On récupère toute les entreprises existantes
        $listePersonnes = [];
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes]);

    }

    /**
     * @Route("/ajoutentreprise", name="AjoutEntreprise")
     */
    public function ajoutEntreprise(ManagerRegistry $em, Request $request): Response
    {
        $entreprise = new ENTREPRISE();
        $Personne = new PERSONNE();

        $AjoutEntrepriseForm = $this->createForm(EntrepriseType::class, $entreprise);
        if( $request->isMethod('POST'))
        {
            $AjoutEntrepriseForm->handleRequest($request);
            $em = $em->getManager();
            $em->persist($entreprise);
            $em->flush();
            
            return $this->redirectToRoute('AjoutPersonne');
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
        $entPersonne = $em->getRepository(PERSONNE::class)->findLastBy($entreprise);
        //dd($entreprise, $entPersonne);

        return $this->render('InfosEntreprise.html.twig', array('uneEntreprise' => $entreprise));
    }

    
}