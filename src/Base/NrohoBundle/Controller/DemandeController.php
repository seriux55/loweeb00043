<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemandeController extends Controller
{
    public function demandeAction()
    {
        $id = $this->get('security.context')->getToken()->getUser();
        // Les demandes que je veux y alle
        $qbb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Demande')
                    ->createQueryBuilder('a')
                    ->leftJoin('a.product', 'b')->addSelect('b')
                    ->leftJoin('a.user', 'c')->addSelect('c')
                    ->where('b.user = :id')
                    ->setParameter('id', $id)
                    ->orderBy('a.depot', 'ASC')
                    ->orderBy('a.etat', 'DESC')
                ;
        $reservation = $qbb->getQuery()->getResult();
        // Les reservations du trajet que je propose
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Demande')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.product', 'b')->addSelect('b')
                   ->leftJoin('b.user', 'c')->addSelect('c')
                   ->where('a.user = :id')
                   ->setParameter('id', $id)
                   ->orderBy('a.depot', 'ASC')
                   ->orderBy('a.etat', 'DESC')
                ;
        $demande = $qb->getQuery()->getResult();
        
        $response = $this->render('BaseNrohoBundle:Demande:demande.html.twig', array(
            'product'     => $demande,
            'reservation' => $reservation,
        ));
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
