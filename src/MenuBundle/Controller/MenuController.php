<?php

namespace MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    /**
     * @Route("/test")
     */
    public function indexAction()
    {
//        $items = array(
//            'accueil' => "Accueil",
//            'ml' => "Mention legale",
//            'societe' => "La societe",
//            'ticket' =>array('saisie' => "Saisie",
//                'ouvert' => "Ouvert",
//                'trait' => "En traitement",
//                'ferm' => "Fermes",
//                'tous' => "Tous")
//        );

        /**
         * TODO
         * new menu
         */
        $sub_items["Ouvert"]='/ouvert';
        $sub_items["En traitement"]='/en-traitement';
        $sub_items["Fermes"]='/fermes';
        $sub_items["Tous"]='/tous';

        $items['Accueil'] = '/';
        $items['Mention legale'] = '/mention-legale';
        $items['Societe'] = '/societe';
        $items['Tickets'] = $sub_items;

        return $this->render('@Menu/Default/menu.html.twig', array("items" => $items));
    }
}
