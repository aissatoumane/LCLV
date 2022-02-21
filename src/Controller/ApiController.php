<?php

namespace App\Controller;

use DateTime;
use App\Entity\Calendar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /* *
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Calendar $calendar, Request $request)
    {   
        // On récupère les données envoyées par FullCalendar
        
        $donnees = json_decode($request->getContent());

        if(
        isset($donnees->title) && !empty($donnees->title) &&
        isset($donnees->start) && !empty($donnees->start) &&
        isset($donnees->description) && !empty($donnees->description) &&
        isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
        isset($donnees->borderColor) && !empty($donnees->borderColor) &&
        isset($donnees->textColor) && !empty($donnees->textColor) 
        ){
            // si les données sont complètes, on initialise le code 200 pour indiquer que l'évènement a été MAJ
            $code = 200;

            // on vérifie si l'ID existe
            if(!$calendar){
                // on instancie un rdv
                $calendar = new Calendar;
                // on change le code
                $code = 201;

            // on "hydrate" l'objet avec les données
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new DateTime($donnees->start));
            if($donnees->allDay){
                $calendar->setEnd(new DateTime($donnees->start));

            } else {
                $calendar->setEnd(new DateTime($donnees->end));
            }

            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->TextColor);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            // on retourne un code
            return new Response('Ok', $code);

        } else {
            // les données sont imcomplètes 
            return new Response('Données incomplètes', 404);
        }
            
        
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
