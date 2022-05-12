<?php

namespace App\Controller;

use App\Entity\ENTREPRISE;
use App\Entity\FONCTION;
use App\Entity\PERSONNE;
use App\Entity\PERSONNEPROFIL;
use App\Form\EntrepriseType;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeEntrepriseController extends AbstractController
{
    /**
     * @Route("/liste_entreprise", name="listeEntreprise")
     */
    public function listeEntreprises(Request $request, ManagerRegistry $doctrine)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }   

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->AffichageEntreprise(); //On récupère toute les entreprises existantes
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
        }
        if (isset($_GET['ParamRecue']))
            return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite, 'ParamRecue' => $_GET['ParamRecue']]);
        else
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite, 'ParamRecue' => '']);
    }

    /**
     * @Route("/GestionFiltre", name="GestionFiltre")
     */
    public function GestionFiltre(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if(isset($_POST['RS']) && $_POST['RS']!=null ){
            return $this->redirectToRoute('listeEntrepriseParRS',['RS'=>$_POST['RS']]);
        }
        elseif(isset($_POST['ville']) && $_POST['ville']!=null){
            return $this->redirectToRoute('listeEntrepriseParVille',['ville'=>$_POST['ville']]);
        }
        elseif(isset($_POST['CP']) && $_POST['CP']!=null){
            return $this->redirectToRoute('listeEntrepriseParCP',['CP'=>$_POST['CP']]);
        }
        elseif(isset($_POST['pays']) && $_POST['pays']!=null){
            return $this->redirectToRoute('listeEntrepriseParPays',['pays'=>$_POST['pays']]);
        }
        elseif(isset($_POST['nom']) && $_POST['nom']!=null){
            return $this->redirectToRoute('listeEntrepriseParNom',['nom'=>$_POST['nom']]);
        }
        elseif(isset($_POST['specialite']) && $_POST['specialite']!=null){
            return $this->redirectToRoute('listeEntrepriseParSpecialite',['specialite'=>$_POST['specialite']]);
        }
        else{
            return $this->redirectToRoute('listeEntreprise');
        }
    }

    /**
     * @Route("/liste_entreprise/RS/{RS}", name="listeEntrepriseParRS")
     */
    public function listeEntreprisesParRS(Request $request ,ManagerRegistry $doctrine, $RS)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParEntreprise($RS); //On récupère toute les entreprises en fonction du nom rentré
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite]);
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
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParCP($CP); //On récupère toute les entreprises en fonction du CP rentré
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite]);
    }

    /**
     * @Route("/liste_entreprise/ville/{ville}", name="listeEntrepriseParVille")
     */
    public function listeEntreprisesParVille(Request $request ,ManagerRegistry $doctrine, $ville)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParVille($ville); //On récupère toute les entreprises en fonction de la ville rentré
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite]);
    }

    /**
     * @Route("/liste_entreprise/pays/{pays}", name="listeEntrepriseParPays")
     */
    public function listeEntreprisesParPays(Request $request ,ManagerRegistry $doctrine, $pays)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParPays($pays); //On récupère toute les entreprises en fonction du pays rentré
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite]);
    }

    /**
     * @Route("/liste_entreprise/nom/{nom}", name="listeEntrepriseParNom")
     */
    public function listeEntreprisesParNom(Request $request ,ManagerRegistry $doctrine, $nom)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParNom($nom); //On récupère toute les entreprises en fonction du nom rentré
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite]);
    }

    /**
     * @Route("/liste_entreprise/specialite/{specialite}", name="listeEntrepriseParSpecialite")
     */
    public function listeEntreprisesParSpecialite(Request $request ,ManagerRegistry $doctrine, $specialite)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(ENTREPRISE::class)->RechercheParSpecialite($specialite); //On récupère toute les entreprises en fonction du pays rentré
        $listePersonnes = [];
        $listeSpecialite = $entityManager->getRepository(ENTREPRISE::class)->AffichageSpecialiteEntreprise();  //On récupère toute les spécialités existantes en fonction des entreprises
        foreach ($listeEntreprises as $entreprise){ //Pour chaque entreprise, on y associe un tableau de ses personnes dans le tableau 'listePersonnes'
            $listePersonnes = array_merge($listePersonnes,$entityManager->getRepository(ENTREPRISE::class)->AffichagePersonnesEntreprise($entreprise['ent_raison_sociale'])); //array_merge permet d'ajouter des éléments à un tableau déja existant
            
        }
        return $this->render('/ListeEntreprise.html.twig', ['listeEntreprises' => $listeEntreprises, 'listePersonnes' => $listePersonnes, 'listeSpecialite' => $listeSpecialite]);
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
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
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
    public function InfosEntreprise(ManagerRegistry $em, $id, Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }

        $em = $em->getManager();
        $Entreprise = $em->getRepository(ENTREPRISE::class)->find($id); // Récupère l'entreprise dont l'id est passé en paramètre
        $Personnes = $em->getRepository(PERSONNE::class)->findLastBy($Entreprise); // Récupère les personnes pour chaque entreprises
        $listeProfils = [];
        //dd($Personnes);
        foreach ($Personnes as $personne){
            $listeProfils = array_merge($listeProfils,$em->getRepository(PERSONNE::class)->AffichagePersonneProfil($personne->getId())); //On récupère toute les entreprises en fonction du pays rentré
        }
        //dd($PersonnesFonctions, $Entreprise, $Personnes);
        return $this->render('InfosEntreprise.html.twig', ['Entreprise' => $Entreprise, 'Personnes' => $Personnes, 'Profils' => $listeProfils]);
    }

    /**
    *  @Route("/supprimer_entreprise/{id}", name="SupprimerEntreprise")
    */
    public function SupprimerEntreprise(ManagerRegistry $em, $id, Request $request)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }
        $em = $em->getManager();
        $entreprise = $em->getRepository(ENTREPRISE::class)->find($id);
        $entPersonne = $em->getRepository(PERSONNE::class)->findLastBy($entreprise);
        try
        {
            foreach($entPersonne as $value)
            {
                $em->remove($value);
                $em->flush();
            }
            $em->remove($entreprise);
            $em->flush();
            return $this->redirectToRoute('listeEntreprise',['ParamRecue'=>'success']);
        }
        catch(Exception $e)
        {
            return $this->redirectToRoute('listeEntreprise',['ParamRecue'=>'error']);
        }
    }

    /**
    *  @Route("/modifier_entreprise/{id}", name="ModifierEntreprise")
    */
    public function ModifierEntreprise(ManagerRegistry $em,Request $request, $id):Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }

        $em = $em->getManager();
        $entreprise = $em->getRepository(ENTREPRISE::class)->find($id);

        $entFormModif = $this->createForm(EntrepriseType::class, $entreprise);
        if( $request->isMethod('POST'))
        {
            $entFormModif->handleRequest($request);

            if($entFormModif->isValid())
            {
                try
                {
                    $em->persist($entreprise);
                    $em->flush();
                    return $this->redirectToRoute('listeEntreprise',['addFlashType'=>'success']);
                }
                catch(Exception $e)
                {
                    return $this->redirectToRoute('listeEntreprise',['addFlashType'=>'Error']);
                }
            }
        }
        return $this->render('ModifierEntreprise.html.twig', ['Entreprise'=>$entreprise, 'entFormModif'=>$entFormModif->createView()]);
    }
}