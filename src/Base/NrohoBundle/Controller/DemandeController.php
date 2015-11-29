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
        
        $demande = $em->getRepository('BaseNrohoBundle:Demande')
            ->createQueryBuilder('a')
            ->leftJoin('a.user', 'b')->addSelect('b')
            ->leftJoin('a.product', 'c')->addSelect('c')
            ->leftJoin('c.user', 'd')->addSelect('d')
            ->where("a.id = :id")
            ->setParameter('id', $id)
            ->getQuery()->getResult();
        
        foreach($demande as $data){
            $data->setEtat('1');
            $email   = $data->getUser()->getEmail();
            $depart  = $data->getProduct()->getDepart();
            $arrivee = $data->getProduct()->getArrivee();
            $name    = $data->getUser()->getSecondename();
            $fname   = $data->getProduct()->getUser()->getSecondename();
        }
        
        $message = \Swift_Message::newInstance()
            ->setSubject('Votre demande de covoiturage sur nroho.com') //Votre commande chez bledvoyage.com
            ->setFrom('contact@nroho.com')
            ->setTo(array($email, 'validation@nroho.com'))
            ->setBody($this->renderView('BaseNrohoBundle:Email:user_demande_acceptee.txt.twig', array(
                'name'    => $name,
                'fname'   => $fname,
                'depart'  => $depart,
                'arrivee' => $arrivee,
            )));
        $this->get('mailer')->send($message);
        
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
