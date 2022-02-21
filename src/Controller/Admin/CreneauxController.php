<?php

namespace App\Controller\Admin;

use App\Entity\Creneaux;
use App\Form\CreneauxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreneauxController extends AbstractController
{
    /**
     * @Route("/admin/creneaux", name="creneaux")
     */
    public function index(): Response
    {
        return $this->render('admin/creneaux/index.html.twig', [
            'controller_name' => 'CreneauxController',
        ]);
    }

    /**
    * @Route("/admin/ajouter-creneaux", name="ajouterCreneaux" )
    */
    public function ajouterCreneaux(Request $request, EntityManagerInterface $manager): Response {
    
    $creneau = new Creneaux();
    
    $form = $this->createForm(CreneauxType::class,$creneau);
    
    $form->handleRequest($request);
    
    if($form->isSubmitted()){
        if($form->isValid()){
        $manager->persist($creneau); $manager->flush();
        
        return $this->redirectToRoute('creneaux');
    }
    }
        return $this->render('creneaux/index.html.twig',
            [
            'creneau' => $creneau,
            'form' =>$form->createView()
            ]); 
    }
}
