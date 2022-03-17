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
        $form = $this->createForm(LoginFormType :: class);
        $form->handleRequest($request);
        $session = $request->getSession();
        if ($form->isSubmitted() && $form->isValid()){
            $InfoSaisies = $form->getData();
            $VerifLogin = $this->getDoctrine()->getRepository(Utilisateur::class)->LoginVerification($InfoSaisies['UTI_Login'],$InfoSaisies['UTI_MDP']);
            if ($VerifLogin != False){
                $session->set('Role', $this->getDoctrine()->getRepository(Utilisateur::class)->getRole($InfoSaisies['UTI_Login']));
                if ($session->get('Role') == true){
                    dd($session->get('Role')['UTI_ROLE']);
                    //return $this->render('ListeEntreprise.html.twig');
                }
            }
        }
        return $this->render('login.html.twig', ['loginform' => $form->createView()]);   
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->render('login.html.twig', ['loginform' => $form->createView()]);
    }
}