<?php

namespace WebsiteBundle\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class WebsiteController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $php_info = phpinfo();
        dump($php_info);
        return $this->render('@Website/Default/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/mention-legale")
     */
    public function showMentionLegale() {

        $data_loader = $this->get('app.data_loader');
        $content = $data_loader->dataLoader('ml');
        return $this->render('@Website/MentionLegale/indexML.html.twig', array('content'=>$content));
    }

    /**
     * @Route("/societe")
     */
    public function showSociete(){
        $data_loader = $this->get('app.data_loader');
        $content = $data_loader->dataLoader('societe');
        return $this->render('@Website/Societe/indexSociete.html.twig', array('content'=>$content));
    }
}
