<?php

namespace Base\NrohoBundle\Controller;

use Doctrine\Common\Cache\ApcCache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemandeController extends Controller
{
    public function demandeAction()
    {
        //We get the cache before anything else
        $cacheDriver = new ApcCache();
        //If the cache exists and is not expired for _home_rssNews, we simply return its content !
        if ($cacheDriver->contains('_demande'))
        {
           return $cacheDriver->fetch('_demande');
        }
        $id = $this->get('security.context')->getToken()->getUser();
        // Les reservations du trajet que je propose
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Demande')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.product', 'b')->addSelect('b')
                   ->leftJoin('a.user', 'c')->addSelect('c')
                   ->where('a.user = :id')
                   ->setParameter('id', $id)
                   ->orderBy('a.depot', 'DESC')
                   ->orderBy('a.etat', 'DESC')
                ;
        $demande = $qb->getQuery()->getResult();
        // Les demandes que je veux y alle
        $qbb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Demande')
                    ->createQueryBuilder('a')
                    ->leftJoin('a.product', 'b')->addSelect('b')
                    ->leftJoin('a.user', 'c')->addSelect('c')
                    ->where('b.user = :id')
                    ->setParameter('id', $id)
                    ->orderBy('a.depot', 'DESC')
                    ->orderBy('a.etat', 'DESC')
                ;
        $reservation = $qbb->getQuery()->getResult();
        
        $response = $this->render('BaseNrohoBundle:Demande:demande.html.twig', array(
            'product'     => $demande,
            'reservation' => $reservation,
        ));
        //We put this response in cache for a 3 minutes period !
        $cacheDriver->save('_demande', $response, "180");
        return $response;
    }
    
    public function yesDemandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Demande', $id)->setEtat('1');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Demande:demande');
    }
    
    public function noDemandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Demande', $id)->setEtat('0');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Demande:demande');
    }
    
    public function cancelDemandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Demande', $id)->setEtat('3');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Demande:annulerDemande');
    }
    
    public function annulerDemandeAction()
    {
        return $this->render('BaseNrohoBundle:Confirmation:cancelDemande.html.twig');
    }
}
