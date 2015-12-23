<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function annonceAction()
    {
        $a = $p = $m = 0;
        $qb1 = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
            ->createQueryBuilder('a')
            ->leftJoin('a.user', 'b')->addSelect('b')
            ->where("a.valid = '3'")
        ;
        $product = $qb1->getQuery()->getResult();
        foreach($product as $data){
            $a++;
        }
        
        $qb2 = $this->getDoctrine()->getRepository('BaseNrohoBundle:Permis')
            ->createQueryBuilder('a')
            ->where("a.etat = '2'")
        ;
        $permis = $qb2->getQuery()->getResult();
        foreach($permis as $data){
            $p++;
        }
        
        $qb3 = $this->getDoctrine()->getRepository('BaseNrohoBundle:Membership')
            ->createQueryBuilder('a')
            ->where("a.etat = '2'")
        ;
        $membership = $qb3->getQuery()->getResult();
        foreach($membership as $data){
            $m++;
        }
        
        return $this->render('BaseNrohoBundle:Admin:annonce.html.twig', array(
            'product'       => $product,
            'permis'        => $permis,
            'membership'    => $membership,
            'nbrA'          => $a,
            'nbrP'          => $p,
            'nbrM'          => $m,
        ));
    }
    
    public function yesAnnonceAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Product', $id)->setValid('1');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Admin:annonce');
    }
    
    public function noAnnonceAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Product', $id)->setValid('0');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Admin:annonce');
    }
    
    public function yesPermisAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Permis', $id)->setEtat('1');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Admin:annonce');
    }
    
    public function noPermisAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Permis', $id)->setEtat('0');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Admin:annonce');
    }
    
    public function yesMembershipAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Membership', $id)->setEtat('1');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Admin:annonce');
    }
    
    public function noMembershipAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Membership', $id)->setEtat('0');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Admin:annonce');
    }
}
