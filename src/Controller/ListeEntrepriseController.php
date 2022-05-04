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
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->AffichageEntreprise(); //On récupère toute les entreprises existantes
        $listePersonnes = [];
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes]);

    }
    /**
     * @Route("/liste_entreprise/RS/{RS}", name="listeEntrepriseParNom")
     */
    public function listeEntreprisesParNom(Request $request ,ManagerRegistry $doctrine, $RS)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParEntreprise($RS); //On récupère toute les entreprises en fonction du nom rentré
        $listePersonnes = [];
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes]);
    }

    /**
     * @Route("/liste_entreprise/CP/{CP}", name="listeEntrepriseParCP")
     */
    public function listeEntreprisesParCP(Request $request ,ManagerRegistry $doctrine, $CP)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParCP($CP); //On récupère toute les entreprises en fonction du nom rentré
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
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entreprise = new ENTREPRISE();

        $AjoutEntrepriseForm = $this->createForm(EntrepriseType::class, $entreprise);
        if( $request->isMethod('POST'))
        {
            $AjoutEntrepriseForm->handleRequest($request);
            $em = $em->getManager();
            $em->persist($entreprise);
            $em->flush();
            
            return $this->redirectToRoute('InfosEntreprise', ['id'=>$entreprise->getId()]);
        }
        return $this->render('AjoutEntreprise.html.twig', ['AjoutEntrepriseForm' => $AjoutEntrepriseForm->createView()]);
    }

    /**
     * @Route("/infos_entreprise/{id}", name="InfosEntreprise")
     */
    public function InfosEntreprise(ManagerRegistry $em, $id): Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $em = $em->getManager();
        $entreprise = $em->getRepository(ENTREPRISE::class)->find($id);
        $entPersonne = $em->getRepository(PERSONNE::class)->findLastBy($entreprise);
        /*dd($entreprise, $entPersonne);*/
        return $this->render('InfosEntreprise.html.twig', ['uneEntreprise' => $entreprise, 'unePersonne' => $entPersonne]);
    }

    
}