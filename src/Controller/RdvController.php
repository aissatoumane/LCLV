<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvType;
use App\Repository\CalendarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RdvController extends AbstractController
{
    /**
     * @Route("/prendre-rdv", name="rdv")
     */
    public function index(CalendarRepository $calendar)
    {   
        $user = $this->getUser();
        if($user == null){
            return$this->redirectToRoute('app_register');
        }

        $events = $calendar->findAll();

        //dd($events);
        $rdvs = [];
        foreach($events as $event) {
            $rdvs[] = [
                'id' =>$event->getId(),
                'start' =>$event->getStart()->format('Y-m-d H:i:s'),
                'end' =>$event->getEnd()->format('Y-m-d H:i:s'),
                'title' =>$event->getTitle(),
                'description' =>$event->getDescription(),
                'backgroundColor' =>$event->getBackgroundColor(),
                'borderColor' =>$event->getBorderColor(),
                'textColor' =>$event->getTextColor(),
                'allDay' =>$event->getAllDay()
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('rdv/index.html.twig', compact('data'));
    }

    /**
    * @Route("/ajouter-rdv", name="ajouterRdv" )
    */
    public function ajouterRdv(Request $request, EntityManagerInterface $manager): Response {
    
    $rdv = new Rdv();
    
    $form = $this->createForm(RdvType::class,$rdv);
    
    $form->handleRequest($request);
    
    if($form->isSubmitted()){
        if($form->isValid()){
        $manager->persist($rdv); $manager->flush();
        
        return $this->redirectToRoute('rdv');
    }
    }
        return $this->render('rdv/index.html.twig',
    [
        'rdv' => $rdv,
        'form' =>$form->createView()
        ]); 
    }
}
