<?php

namespace WebsiteBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Expression;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

            return $this->render('@Website/GestionTicket/add_ticket_success.html.twig',
                array('demande'=>$ticket->getDemande(),));
            // redirection vers une page selon les regles dans routin.yml
            //return $this->redirectToRoute('add_ticket_success');

            //Une façon de faire retour vers page twig apré avoir faire une action
            //return new Response('Saved new ticket with demande '.$ticket->getDemande());
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
        /**
         * TODO
         * get tickets from DB
         *
         */
        /**
         * TODO
         * orderBy = plus recentes
         */
        $result = $this->getDoctrine()->getRepository(Ticket::class)->findBy(array(), null, "5");
        $ticketsArray = array();


        foreach ($result as $value){
            $ticketsArray[] = $value;
        }

        if (sizeof($ticketsArray) <= 0 ) {
            throw $this->createNotFoundException(
                'Il n\'y a pas de tickets dans BD'
            );
        }
        return $this->render('@Website/GestionTicket/get_tous_tickets.html.twig', array(
            'tickets'=>$ticketsArray,
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

    /**
     * @Route("/edit")
     */
    public function editTicket(Request $request) {
        $id = $request->query->get('id');

        // Recuperation ticket de BD
        $entityManager = $this->getDoctrine()->getManager();

        $ticket = $entityManager->getRepository(Ticket::class)->find($id);
        if(!$ticket){
            throw $this->createNotFoundException(
                'Je n\'arrive pas trouver un ticket avec id : '. $id
            );
        }

        // Creation une form selon le ticket
        $form = $this->createFormBuilder($ticket)
            ->add('demande', TextType::class)
            ->add('commentaire', TextareaType::class, array('required' => false))
//            ->add('Status', )
            ->add('save', SubmitType::class, array('label'=> 'Update Ticket'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $ticket = $form->getData();

            // On sauvgarde un Ticket en BD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->getTousTicketsAction();
        }

        return $this->render('@Website/GestionTicket/update_ticket.html.twig', array('form' =>$form->createView()));
    }
}
