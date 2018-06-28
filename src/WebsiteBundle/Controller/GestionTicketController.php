<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GestionTicketController extends Controller
{
    /**
     * @Route("new-ticket")
     */
    public function createTicketAction()
    {
        return $this->render('WebsiteBundle:GestionTicket:create_ticket.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("all-tickets")
     */
    public function getTousTicketsAction()
    {
        return $this->render('WebsiteBundle:GestionTicket:get_tous_tickets.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("ouvert-tickets")
     */
    public function getOpenTicketsAction()
    {
        return $this->render('WebsiteBundle:GestionTicket:get_open_tickets.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("en-traitement-tickets")
     */
    public function getEnTraitementTicketsAction()
    {
        return $this->render('WebsiteBundle:GestionTicket:get_en_traitement_tickets.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("fermes-tickets")
     */
    public function getFermesTicketsAction()
    {
        return $this->render('WebsiteBundle:GestionTicket:get_fermes_tickets.html.twig', array(
            // ...
        ));
    }

}
