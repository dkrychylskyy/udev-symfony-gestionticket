<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{

    /**
     * @Route("/text/{text}")
     */
    public function showAction(Request $request, $text)
    {
        // comme ça on peut récupere des parametres plus jolie
        // au lieu de /?text=hello on fait /text/hello
        dump([$text]);
        // Ex de requperation des parametres depuis page web par GET, POST etc...
        $text = $request->query->get('text');

        return $this->render('@Website/Accueil/show.html.twig', array(
        ));
    }


}
