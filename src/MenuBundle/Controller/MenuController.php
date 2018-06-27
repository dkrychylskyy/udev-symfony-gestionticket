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
        $items = array(
            'accueil' => "Accueil",
            'ml' => "Mention legale",
            'societe' => "La societe",
            'ticket' =>array('saisie' => "Saisie",
                'ouvert' => "Ouvert",
                'trait' => "En traitement",
                'ferm' => "Fermes",
                'tous' => "Tous")
        );
        return $this->render('@Menu/Default/menu.html.twig', array("items" => $items));
    }
}
