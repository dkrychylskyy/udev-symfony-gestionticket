<?php

namespace MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    public function indexAction()
    {
        $sub_items['Create Ticket']='/ticket/new';
        $sub_items["Tous"]='/ticket/all-tickets';
        $sub_items["Ouvert"]='/ticket/ouvert-tickets';
        $sub_items["En traitement"]='/ticket/en-traitement-tickets';
        $sub_items["Fermes"]='/ticket/fermes-tickets';

        $items['Accueil'] = '/';
        $items['Mention legale'] = '/mention-legale';
        $items['Societe'] = '/societe';
        $items['Tickets'] = $sub_items;

        return $this->render('@Menu/Default/menu.html.twig', array("items" => $items, 'user' => $this->getUser()));
    }
}
