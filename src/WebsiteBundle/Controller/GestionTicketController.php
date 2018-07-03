<?php

namespace WebsiteBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use WebsiteBundle\Entity\Ticket;
use WebsiteBundle\Repository\TicketRepository;
use WebsiteBundle\Resources\enum\TicketsStatus;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("ticket")
 */
class GestionTicketController extends Controller
{

    /**
     * ****************************************************************************
     * CRUD
     * ****************************************************************************
     */

    /**
     * @Route("/new")
     */
    public function createTicketAction(Request $request)
    {
        $ticket = new Ticket("Mon demande", "Mon commentaire", "non", TicketsStatus::getStatusName("ouvert"));

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
     * @Route("/edit/{id}")
     * @param $id int
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editTicket(Request $request, $id) {

        $ticket = $this->getCurrentTicket($id);

        // Creation une form selon le ticket
        $form = $this->createFormBuilder($ticket)
            ->add('demande', TextType::class)
            ->add('commentaire', TextareaType::class, array('required' => false))
            ->add('status', ChoiceType::class, array(
                'required' => true,
                'choices' => TicketsStatus::getAvaliableStatus(),
                'choices_as_values' => true,
                'choice_label' => function($choice) {
                    return TicketsStatus::getStatusName($choice);
                },
            ))
            ->add('save', SubmitType::class, array('label'=> 'Update Ticket'))
            ->getForm();

        $form->handleRequest($request);

        // Verification que tous les champs sont valides
        if ($form->isSubmitted() && $form->isValid()){
            $ticket = $form->getData();

            // On sauvgarde un Ticket modifié en BD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            // Exemple de redirection
            return $this->redirectToRoute('website_gestionticket_gettoustickets');
        }

        return $this->render('@Website/GestionTicket/update_ticket.html.twig', array(
            'form' =>$form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteTicket(Request $request, $id){
        $ticket = $this->getCurrentTicket($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ticket);
        $entityManager->flush();

        return $this->redirectToRoute('website_gestionticket_gettoustickets');
    }

    /**
     * @Route("/fermer/{id}")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function terminerTicket(Request $request, $id) {
        $ticket = $this->getCurrentTicket($id);
        $ticket->setStatus(TicketsStatus::STATUS_FERME);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ticket);
        $entityManager->flush();

        // Exemple de redirection
        return $this->redirectToRoute('website_gestionticket_gettoustickets');

    }

    /**
     * @return Response
     */
    public function addTicketSuccessAction() {
        return $this->render('@Website/add_ticket_success.html.twig');
    }

    /**
     * *********************** FETCHING DATA FROM DB ************************
     */

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
            return new Response('<h3>Il n\'y a pas de tickets dans BD</h3><br><a href="/ticket/new">Ajouter un Ticket</a> ');
//            throw $this->createNotFoundException(
//                'Il n\'y a pas de tickets dans BD'
//            );
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
        $params['status'] = TicketsStatus::STATUS_OUVERT;
        $result = $this->getDataWithQueriParam($params, EntityManager::class);

        $ticketsArray = array();


        foreach ($result as $value){
            $ticketsArray[] = $value;
        }

        if (sizeof($ticketsArray) <= 0 ) {
            return new Response('<h3>Il n\'y a pas de tickets dans BD</h3><br><a href="/ticket/new">Ajouter un Ticket</a> ');
        }
        return $this->render('@Website/GestionTicket/get_open_tickets.html.twig', array(
           'tickets' => $ticketsArray,
        ));
    }

    /**
     * @Route("/en-traitement-tickets")
     */
    public function getEnTraitementTicketsAction()
    {
        $params['status'] = TicketsStatus::STATUS_EN_TRAITEMENT;
        $result = $this->getDataWithQueriParam($params, EntityManager::class);

        $ticketsArray = array();


        foreach ($result as $value){
            $ticketsArray[] = $value;
        }

        if (sizeof($ticketsArray) <= 0 ) {
            return new Response('<h3>Il n\'y a pas de tickets dans BD</h3><br><a href="/ticket/new">Ajouter un Ticket</a> ');
        }
        return $this->render('@Website/GestionTicket/get_en_traitement_tickets.html.twig', array(
            'tickets'=>$ticketsArray,
        ));
    }

    /**
     * @Route("/fermes-tickets")
     */
    public function getFermesTicketsAction()
    {   $params['status'] = TicketsStatus::STATUS_FERME;
        $result = $this->getDataWithQueriParam($params, EntityManager::class);

        $ticketsArray = array();


        foreach ($result as $value){
            $ticketsArray[] = $value;
        }

        if (sizeof($ticketsArray) <= 0 ) {
            return new Response('<h3>Il n\'y a pas de tickets dans BD</h3><br><a href="/ticket/new">Ajouter un Ticket</a> ');
        }

        return $this->render('@Website/GestionTicket/get_fermes_tickets.html.twig', array(
            'tickets'=>$ticketsArray,
        ));
    }

    /**
     * ***********************************************************************************************
     * Services
     * ***********************************************************************************************
     */

    public function getCurrentTicket($id) {

        // Recuperation ticket de BD
        $entityManager = $this->getDoctrine()->getManager();

        $ticket = $entityManager->getRepository(Ticket::class)->find($id);
        if(!$ticket){
            throw $this->createNotFoundException(
                'Je n\'arrive pas trouver un ticket avec id : '. $id
            );
        }
        return $ticket;
    }

    public function getDataWithQueriParam($params) {

        /**
         * @var TicketRepository $repository
         */
        $repository = $this->getDoctrine()->getRepository(Ticket::class);
        $query = $repository->createQueryBuilder('t')
            ->where('t.status = :status')
            ->setParameter('status', $params['status'])
            ->orderBy('t.dateCreation', 'DESC')
            ->getQuery();

        $tickets = $query->getResult();
        return $tickets;
    }
}
