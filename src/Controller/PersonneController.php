<?php

namespace App\Controller;

use App\Entity\PERSONNE;
use App\Entity\ENTREPRISE;
use App\Entity\FONCTION;
use App\Form\FonctionType;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/ajouterpersonne", name="AjouterPersonne")
     */
    public function AjoutPersonne(Request $request, ManagerRegistry $em): Response
    {
        $session = $request->getSession();
        if ($session->get('Role') == null){
            return $this->redirectToRoute("app_login");
        }
        if ($session->get('Role')["UTI_ROLE"] == "0"){
            return $this->redirectToRoute("listeEntreprise");
        }

        $Personne = new PERSONNE();
        $Fonction = new FONCTION();
        $PersonneForm = $this->createForm(PersonneType::class, $Personne);
        $perFonctionForm = $this->createForm(FonctionType::class, $Fonction);
        if ($request->isMethod('POST'))
        {
            $PersonneForm->handleRequest($request);

            if ($PersonneForm->isSubmitted() && $PersonneForm->isValid())
            {

                $em = $em->getManager();
                $em->persist($Personne);
                $em->flush(); 
                return $this->redirectToRoute('listeEntreprise');
            }
        }
        return $this->render('AjoutPersonne.html.twig', ["AjoutPersonneForm" => $PersonneForm->createView()]);
    }
}
