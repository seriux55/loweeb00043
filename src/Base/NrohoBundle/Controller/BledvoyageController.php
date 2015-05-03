<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BledvoyageController extends Controller
{
    public function indexAction($id)
    {
        $serializer = $this->get('jms_serializer');
        $url        = "http://www.bledvoyage.com/new/web/api/sortie.json";
        $json       = file_get_contents($url);
        $sorties    = $serializer->deserialize($json, 'array<Base\NrohoBundle\Entity\SortieBledvoyage>', 'json');
        
        return $this->render('BaseNrohoBundle:Bledvoyage:index.html.twig', array(
            'sorties'   => $sorties,
            'id'        => $id,
        ));
    }
}
