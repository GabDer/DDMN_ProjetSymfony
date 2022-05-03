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
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->redirectToRoute("app_login");
    }
}