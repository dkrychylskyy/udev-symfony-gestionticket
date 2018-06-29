<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use WebsiteBundle\Entity\Ticket;
use WebsiteBundle\Resources\enum\TicketsStatus;
use WebsiteBundle\Entity\User;
/**
 * @Route("ticket")
 */
class GestionTicketController extends Controller
{
    /**
     * @Route("/new")
     */
    public function createTicketAction(Request $request)
    {
        $ticket = new Ticket("Mon demande", "Mon commentaire", "non", TicketsStatus::OUVERT);

        $form = $this->createFormBuilder($ticket)
                ->add('demande', TextType::class)
                ->add('commentaire', TextareaType::class, array('required' => false))
                ->add('save', SubmitType::class, array('label'=> 'Create Ticket'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $ticket = $form->getData();

            // On sauvgarde un Ticket en BD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('add_ticket_success');
        }

        // Rendering template avec la forme
        return $this->render('@Website/GestionTicket/create_ticket.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    /**
     * @Route("/all-tickets")
     */
    public function getTousTicketsAction()
    {
        return $this->render('@Website/GestionTicket/get_tous_tickets.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/ouvert-tickets")
     */
    public function getOpenTicketsAction()
    {
        return $this->render('@Website/GestionTicket/get_open_tickets.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/en-traitement-tickets")
     */
    public function getEnTraitementTicketsAction()
    {
        return $this->render('@Website/GestionTicket/get_en_traitement_tickets.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/fermes-tickets")
     */
    public function getFermesTicketsAction()
    {
        return $this->render('@Website/GestionTicket/get_fermes_tickets.html.twig', array(
            // ...
        ));
    }

    public function addTicketSuccessAction() {
        return $this->render('@Website/add_ticket_success.html.twig');
    }
}
