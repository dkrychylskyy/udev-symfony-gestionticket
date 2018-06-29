<?php

namespace MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    public function indexAction()
    {
        $sub_items['Create Ticket']='/create-ticket';
        $sub_items["Ouvert"]='/ouvert-tickets';
        $sub_items["En traitement"]='/en-traitement-tickets';
        $sub_items["Fermes"]='/fermes-tickets';
        $sub_items["Tous"]='/all-tickets';

        $items['Accueil'] = '/';
        $items['Mention legale'] = '/mention-legale';
        $items['Societe'] = '/societe';
        $items['Tickets'] = $sub_items;

        return $this->render('@Menu/Default/menu.html.twig', array("items" => $items));
    }
}
