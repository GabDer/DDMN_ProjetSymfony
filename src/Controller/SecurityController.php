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
                $session->set('Role', $doctrine->getManager()->getRepository(Utilisateur::class)->getRole($InfoSaisies['UTI_Login']));
                return $this->redirectToRoute("listeEntreprise");
            }
            else{
                return $this->render('login.html.twig', ['loginform' => $form->createView(), 'FalseLogin' => 'Identifiant ou mot de passe incorrect']);
            }
        }
        return $this->render('login.html.twig', ['loginform' => $form->createView(), 'FalseLogin' => ' ']);   
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->render('login.html.twig', ['loginform' => $form->createView()]);
    }
}