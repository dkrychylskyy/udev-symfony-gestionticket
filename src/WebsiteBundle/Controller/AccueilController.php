<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{
    // resuper le content de file txt
    private function dataLoader($file) {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../Resources/assets/')->name($file.'.txt');
        foreach ($finder as $file) $content = file_get_contents($file);

        return $content;
    }

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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/mention-legale")
     */
    public function showMentionLegale() {

        $content = $this->dataLoader('ml');
        return $this->render('@Website/MentionLegale/indexML.html.twig', array('content'=>$content));
    }

    /**
     * @Route("/societe")
     */
    public function showSociete(){
        $content = $this->dataLoader('societe');
        return $this->render('@Website/Societe/indexSociete.html.twig', array('content'=>$content));
    }
}
