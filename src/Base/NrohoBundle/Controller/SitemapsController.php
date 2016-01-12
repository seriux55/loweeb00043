<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitemapsController extends Controller
{
    public function sitemapAction()
    {
        $urls = array();
        $hostname = $this->getRequest()->getHost();

        // add some urls homepage
        $urls[] = array('loc' => $this->get('router')->generate('nroho_base_default'), 'changefreq' => 'monthly', 'priority' => '1.0');

        $urls[] = array('loc' => $this->get('router')->generate('nroho_base_add'), 'changefreq' => 'monthly', 'priority' => '1.0');

        $urls[] = array('loc' => $this->get('router')->generate('fos_user_security_login'), 'changefreq' => 'monthly', 'priority' => '1.0');
        
        // detail du covoiturage
        $products = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
            ->createQueryBuilder('a')
            ->where("a.valid = '1'")
            ->getQuery()->getResult();
        
        // service
        foreach ($products as $product) {
            $urls[] = array('loc' => $this->get('router')->generate('nroho_base_produit', 
                    array('id' => $product->getId())), 'changefreq' => 'weekly', 'priority' => '0.5');
        }

        return $this->render('BaseNrohoBundle:Sitemaps:sitemap.xml.twig', array(
            'urls' => $urls,
            'hostname' => $hostname,
        ));
    }
}
