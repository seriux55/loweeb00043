<?php

namespace Base\NrohoBundle\Controller;

use Base\NrohoBundle\Entity\Avis;
use Base\NrohoBundle\Form\Type\AvisType;
use Symfony\Component\HttpFoundation\Request;
use Base\NrohoBundle\Entity\Product;
use Base\NrohoBundle\Form\Type\ProductType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{ 
    public function profilAction($id)
    {
        $avis = new Avis;
        $avis->setIp($this->getRequest()->getClientIp());
        $form = $this->createForm(new AvisType(), $avis);
        $av = $this->get('database_connection')
                ->prepare("SELECT Demande.id FROM Demande JOIN Product ON Demande.product_id=Product.id "
                . "WHERE Demande.etat=? AND Demande.user_id=? AND Product.user_id=?");
        $av->bindValue(1, '1');
        $av->bindValue(2, $this->get('security.context')->getToken()->getUser()->getId());
        $av->bindValue(3, $id);
        $av->execute();
        $i = 0;
        while ($av->fetch()) {
            $i++;
        }
        $request = $this->get('request');
        if ($form->handleRequest($request)->isValid()) {
            $avis->setUser($this->get('security.context')->getToken()->getUser());
            $avis->setUserAvis($this->getDoctrine()->getRepository('BaseUserBundle:User')->find($id));
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->redirect($this->generateUrl('nroho_base_profil', array('id' => $id)));
        }
        $tout_avis = $this->getDoctrine()->getRepository('BaseNrohoBundle:Avis')
                          ->createQueryBuilder('a')
                          ->leftJoin('a.user', 'b')->addSelect('b')
                          ->orderBy('a.id','ASC')
                          ->where('a.user_avis = :id')
                          ->setParameter('id', $id)
                          ->getQuery()
                          ->useResultCache(true, 360, '_user_tout_avis_'.$id)
                          ->getResult();
        $j = 0;
        foreach ($tout_avis as $v) {
            $j++;
        }
        $user = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                     ->createQueryBuilder('a')
                     ->leftJoin('a.user', 'b')->addSelect('b')
                     ->where('b.id = :id')
                     ->setParameter('id', $id)
                     ->setMaxResults(1)
                     ->getQuery()
                     ->useResultCache(true, 360, '_user_user_'.$id)
                     ->getResult();
        $ways = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                     ->createQueryBuilder('a')
                     ->where('a.user = :id')
                     ->andWhere("a.valid = '1' OR a.valid = '2'")
                     ->orderBy('a.id','DESC')
                     ->setParameter('id', $id)
                     ->setMaxResults(5)
                     ->getQuery()
                     ->useResultCache(true, 360, '_user_ways_'.$id)
                     ->getResult();
        $response = $this->render('BaseNrohoBundle:Default:profil.html.twig', array(
            'form' => $form->createView(),
            'avis' => $tout_avis,
            'user' => $user,
            'id'   => $id,
            'ways' => $ways,
            'av'   => $i,
            'nbra' => $j,
        ));
        return $response;
    }
    
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Product', $id)->setValid('2');
        $em->flush();
        return $this->forward('BaseNrohoBundle:User:confirmationRemove');
    }

    public function addAction(Request $request)
    {
        $product = new Product();
        $product->setIp($this->getRequest()->getClientIp());
        $form = $this->createForm(new ProductType(), $product);
        if ($form->handleRequest($request)->isValid()) {
            $product->setUser($this->get('security.context')->getToken()->getUser());
            $product->setIp($this->getRequest()->getClientIp());
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->forward('BaseNrohoBundle:User:confirmationAdd');
        }  
        return $this->render('BaseNrohoBundle:Default:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $product = $em->getRepository('BaseNrohoBundle:Product')->find($id);
        $form = $this->createForm(new productType(), $product);
        // On récupère la requête
        $request = $this->get('request');
        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire par le visiteur
            $form->bind($request);
            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On l'enregistre notre objet $article dans la base de données
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                // On redirige vers la page de visualisation de l'article nouvellement créé
                return $this->forward('BaseNrohoBundle:User:confirmationEdit');
            }
        }
        return $this->render('BaseNrohoBundle:Default:edit.html.twig', array(
           'form' => $form->createView(),
        ));
    }
    
    public function annonceAction()
    {
        $id = $this->get('security.context')->getToken()->getUser();
        $product = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->where('a.user = :id')
                   ->andWhere("a.valid = '1' OR a.valid= '3'")
                   ->setParameter('id', $id)
                   ->getQuery()
                   ->useResultCache(true, 360, '_user_annonce')
                   ->getResult();
        // afficher en session $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
        return $this->render('BaseNrohoBundle:Default:annonce.html.twig', array(
            'product' => $product
        ));
    }
    
    public function confirmationAddAction()
    {
        return $this->render('BaseNrohoBundle:Confirmation:add.html.twig');
    }
    
    public function confirmationEditAction()
    {
        return $this->render('BaseNrohoBundle:Confirmation:edit.html.twig');
    }
    
    public function confirmationRemoveAction()
    {
        return $this->render('BaseNrohoBundle:Confirmation:remove.html.twig');
    }
}
