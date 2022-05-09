<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginFormType;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
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
        $entityManager = $doctrine->getManager();
        $listeUtilisateurs = $entityManager->getRepository(UTILISATEUR::class)->AffichageUtilisateurs(); //On récupère toute les utilisateurs existants
        return $this->render('/ListeUtilisateurs.html.twig', ['listeUtilisateurs' => $listeUtilisateurs]);
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

        $utilisateur = new Utilisateur();
        $ajoutUserForm = $this->createForm(LoginFormType::class, $utilisateur);
        if ($request->isMethod('POST'))
        {
            $ajoutUserForm->handleRequest($request);
            $em = $em->getManager();
            $em->persist($utilisateur);
            $em->flush();
            $this->addFlash('success', 'L\'utilisateur a bien été ajouté');
            return $this->redirectToRoute('listeUtilisateurs');
        }
        return $this->render('AjoutUtilisateur.html.twig', ['ajoutUserForm'=>$ajoutUserForm->createView()]);
    }

    /**
    *  @Route("/modifier_utilisateur/{id}", name="ModifierUtilisateur")
    */
    public function ModifierUtilisatuer(ManagerRegistry $em,Request $request, $id):Response
    {
        $em = $em->getManager();
        $utilisateur = $em->getRepository(Utilisateur::class)->find($id);

        $utilisateurFormModif = $this->createForm(LoginFormType::class, $utilisateur);
        if( $request->isMethod('POST'))
        {
            $utilisateurFormModif->handleRequest($request);

            if($utilisateurFormModif->isValid())
            {
                try
                {
                    $em->persist($utilisateur);
                    $em->flush();
                    return $this->redirectToRoute('listeUtilisateurs', ['id'=> $utilisateur->getId()]);
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
    public function SupprimerEntreprise(ManagerRegistry $em, $id, Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        $em = $em->getManager();
        $utilisateur = $em->getRepository(Utilisateur::class)->find($id);
        
        $userFormSupp = $this->get('form.factory')->create();
        if( $request->isMethod('POST'))
        {
            $userFormSupp->handleRequest($request);
            if($userFormSupp->isSubmitted())
            {
                try
                {
                    $em->remove($utilisateur);
                    $em->flush();
                    $this->addFlash('success', 'L\'utilisateur a bien été supprimée');
                    return $this->redirectToRoute('listeEntreprise');
                }
                catch(Exception $e)
                {
                    $this->addFlash('Error', 'une erreur s\'est produite l\'utilisateur n\'a pas pu etre supprimer');
                }
            }
        }
        return $this->render('SupprimerUtilisateur.html.twig', ['Utilisateur'=>$utilisateur, 'userFormSupp'=>$userFormSupp->createView()]);
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