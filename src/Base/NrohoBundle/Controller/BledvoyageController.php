<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BledvoyageController extends Controller
{
    public function indexAction()
    {
        $serializer = $this->get('jms_serializer');
        $url        = "http://localhost:8888/bledvoyage/web/app_dev.php/api/sortie.json";
        $json       = file_get_contents($url);
        $sorties    = $serializer->deserialize($json, 'array<Base\NrohoBundle\Entity\SortieBledvoyage>', 'json');
        
        return $this->render('BaseNrohoBundle:Bledvoyage:index.html.twig', array(
            'sorties'   => $sorties,
        ));
    }
}
