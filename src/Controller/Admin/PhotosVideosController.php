<?php

namespace App\Controller\Admin;

use App\Entity\PhotosVideos;
use App\Form\PhotosVideosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhotosVideosController extends AbstractController
{
    /**
     * @Route("/admin/photos-videos", name="photosVideos")
     */
    public function index(): Response
    {
        return $this->render('photosVideos/index.html.twig', [
            'controller_name' => 'PhotosVideosController',
        ]);
    }

    /**
    * @Route("/admin/ajouter-photos-videos", name="ajouterphotosVideos" )
    */
    public function ajouterphotosVideos(Request $request, EntityManagerInterface $manager): Response {
    
    $photosVideos = new PhotosVideos();
    
    $form = $this->createForm(PhotosVideosType::class,$photosVideos);
    
    $form->handleRequest($request);
    
    if($form->isSubmitted()){
        if($form->isValid()){
        $manager->persist($photosVideos); $manager->flush();
        
        return $this->redirectToRoute('photosVideos');
    }
    }
        return $this->render('photosVideos/index.html.twig',
    [
        'photosVideos' => $photosVideos,
        'form' =>$form->createView()
        ]); 
    }
}
