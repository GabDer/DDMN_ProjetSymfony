<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginFormType;
use App\Entity\Utilisateur;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function Login(Request $request){
        $UserTemp = new Utilisateur;
        $form = $this->createForm(LoginFormType :: class, $UserTemp);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            // On vérifie que les infos correspondent
            $UserTemp = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy([
                'UTI_Login' => $formData['Login'],
                'UTI_MDP' => $formData['Mdp']
            ]);
            return $this->render('ListeEntreprise.html.twig');
        }
        return $this->render('login.html.twig', ['loginform' => $form->createView()]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        
    }
}