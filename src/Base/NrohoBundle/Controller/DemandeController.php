<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemandeController extends Controller
{
    public function demandeAction()
    {
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Demande')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.product', 'b')->addSelect('b')
                   ->leftJoin('a.user', 'c')->addSelect('c')
                   ->where('b.user = :id')
                   ->setParameter('id', $this->get('security.context')->getToken()->getUser())
                   ->orderBy('a.depot', 'DESC')
                   ->orderBy('a.etat', 'DESC')
                ;
        
        $demande = $qb->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Demande:demande.html.twig', array(
            'product' => $demande,
        ));
    }
    
    public function yes_demandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->find('BaseNrohoBundle:Demande', $id)->setEtat('1');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Demande:demande');
    }
    
    public function no_demandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->find('BaseNrohoBundle:Demande', $id)->setEtat('0');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Demande:demande');
    }
}
