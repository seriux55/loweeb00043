<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SitemapsController extends Controller
{
    /**
     * @Route("/sitemap.{_format}", name="sample_sitemaps_sitemap", Requirements={"_format" = "xml"})
     * @Template("BaseNrohoBundle:Sitemaps:sitemap.xml.twig")
     */
    public function sitemapAction() 
    {
        $em = $this->getDoctrine();
        
        $urls = array();
        $hostname = $this->getRequest()->getHost();

        // add some urls homepage
        $urls[] = array('loc' => $this->get('router')->generate('nroho_base_default'), 'changefreq' => 'monthly', 'priority' => '1.0');

        /*
        // multi-lang pages
        foreach($languages as $lang) {
            $urls[] = array('loc' => $this->get('router')->generate('home_contact', array('_locale' => $lang)), 'changefreq' => 'monthly', 'priority' => '0.3');
        }
        
        // urls from database
        $urls[] = array('loc' => $this->get('router')->generate('nroho_base_produit', array('_locale' => 'fr')), 'changefreq' => 'weekly', 'priority' => '0.7');
        */
        
        // service
        foreach ($em->getRepository('BaseNrohoBundle:Product')->findAll() as $product) {
            $urls[] = array('loc' => $this->get('router')->generate('nroho_base_produit', 
                    array('id' => $product->getId())), 'changefreq' => 'weekly','priority' => '0.5');
        }

        return array('urls' => $urls, 'hostname' => $hostname);
    }
}
