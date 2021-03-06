<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginFormType;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Form\UtilisateurFormType;
use Doctrine\Persistence\ManagerRegistry;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function Login(Request $request, ManagerRegistry $doctrine){
        $form = $this->createForm(LoginFormType :: class);
        $form->handleRequest($request);
        $session = $request->getSession();
        if ($form->isSubmitted() && $form->isValid()){
            $InfoSaisies = $form->getData();
            $VerifLogin = $doctrine->getManager()->getRepository(Utilisateur::class)->LoginVerification($InfoSaisies['UTI_Login'],$InfoSaisies['UTI_MDP']);
            if ($VerifLogin != False){
                $session->set('Role', $doctrine->getManager()->getRepository(Utilisateur::class)->GetRole($InfoSaisies['UTI_Login']));
                $session->set('Login', $InfoSaisies['UTI_Login']);
                return $this->redirectToRoute("listeEntreprise");
            }
            else{
                return $this->render('login.html.twig', ['loginform' => $form->createView(), 'FalseLogin' => 'Identifiant ou mot de passe incorrect']);
            }
        }
        return $this->render('login.html.twig', ['loginform' => $form->createView(), 'FalseLogin' => ' ']);   
    }

    /**
     * @Route("/liste_utilisateurs", name="listeUtilisateurs")
     */
    public function listeUtilisateurs(Request $request ,ManagerRegistry $doctrine)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }
        $entityManager = $doctrine->getManager();
        $listeUtilisateurs = $entityManager->getRepository(UTILISATEUR::class)->AffichageUtilisateurs(); //On récupère toute les utilisateurs existants
        sort($listeUtilisateurs);
        //dd($listeUtilisateurs) 
        if (isset($_GET['ParamRecue']))
            return $this->render('/ListeUtilisateurs.html.twig', ['listeUtilisateurs'=>$listeUtilisateurs, 'ParamRecue'=>$_GET['ParamRecue']]);
        return $this->render('/ListeUtilisateurs.html.twig', ['listeUtilisateurs' => $listeUtilisateurs, 'ParamRecue']);
    }

    /**
     * @Route("/ajout_utilisateur", name="AjoutUtilisateurs")
     */
    public function ajoutUtilisateur(Request $request, ManagerRegistry $em)
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }

        $utilisateur = new Utilisateur();
        $ajoutUserForm = $this->createForm(UtilisateurFormType::class, $utilisateur);
        if ($request->isMethod('POST'))
        {
            $ajoutUserForm->handleRequest($request);
            $em = $em->getManager();
            //On récupère le mpasse saisie
            $data = $utilisateur->getUTIMDP('UTI_MDP');
            //On hashe le mot de passe saisie
            $mdp = hash('MD5', $data);
            
            $utilisateur->setUTIMDP($mdp);
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('listeUtilisateurs');
        }
        return $this->render('AjoutUtilisateur.html.twig', ['ajoutUserForm'=>$ajoutUserForm->createView()]);
    }

    /**
    *  @Route("/modifier_utilisateur/{id}", name="ModifierUtilisateur")
    */
    public function ModifierUtilisatuer(ManagerRegistry $em,Request $request, $id):Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }

        $em = $em->getManager();
        $utilisateur = $em->getRepository(Utilisateur::class)->find($id);

        $utilisateurFormModif = $this->createForm(UtilisateurFormType::class, $utilisateur);
        if( $request->isMethod('POST'))
        {
            $utilisateurFormModif->handleRequest($request);

            if($utilisateurFormModif->isValid())
            {
                try
                {
                    //On récupère le mpasse saisie
                    $data = $utilisateur->getUTIMDP('UTI_MDP');
                    //On hashe le mot de passe saisie
                    $mdp = hash('MD5', $data);
                    
                    $utilisateur->setUTIMDP($mdp);
                    $em->persist($utilisateur);
                    $em->flush();
                    return $this->redirectToRoute('listeUtilisateurs');
                }
                catch(Exeption $e)
                {
                    $this->addFlash('error', 'Une erreur s\'est produite l\'utilisateur n\'a pas pu être modifier.');
                }
            }
        }
        return $this->render('ModifierUtilisateur.html.twig', ['Utilisateur'=>$utilisateur, 'utilisateurFormModif'=>$utilisateurFormModif->createView()]);
    }

    /**
    *  @Route("/supprimer_utilisateur/{id}", name="SupprimerUtilisateur")
    */
    public function SupprimerUtilisateur(ManagerRegistry $em, $id, Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }

        $em = $em->getManager();
        $utilisateur = $em->getRepository(Utilisateur::class)->find($id);
        try
        {
            $em->remove($utilisateur);
            $em->flush();
            return $this->redirectToRoute('listeUtilisateurs',['ParamRecue'=>'success']);
        }
        catch(Exception $e)
        {
            return $this->redirectToRoute('listeUtilisateurs',['ParamRecue'=>'error']);
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->redirectToRoute("app_login");
    }
}