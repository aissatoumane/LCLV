<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    /**
     * @Route("mes_services", name="services")
     */
    public function index(): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    /**
    * @Route("/admin/ajouter-services", name="ajouterServices" )
    */
    public function ajouterServices(Request $request, EntityManagerInterface $manager): Response {
    
    $services = new Services();
    
    $form = $this->createForm(ServicesType::class,$services);
    
    $form->handleRequest($request);
    
    if($form->isSubmitted()){
        if($form->isValid()){
        $manager->persist($services); $manager->flush();
        
        return $this->redirectToRoute('services');
    }
    }
        return $this->render('services/index.html.twig',
            [
            'services' => $services,
            'form' =>$form->createView()
            ]); 
    }
}
