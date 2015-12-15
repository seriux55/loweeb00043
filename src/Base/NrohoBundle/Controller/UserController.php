<?php

namespace Base\NrohoBundle\Controller;

use Base\NrohoBundle\Entity\Avis;
use Base\NrohoBundle\Form\Type\AvisType;
use Symfony\Component\HttpFoundation\Request;
use Base\NrohoBundle\Entity\Product;
use Base\NrohoBundle\Form\Type\ProductType;
use Base\NrohoBundle\Entity\Permis;
use Base\NrohoBundle\Form\Type\PermisType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{ 
    public function profilAction(Request $request, $id)
    {
        $ip = $this->getRequest()->getClientIp();
        $permis = new Permis;
        $permis->setIp($ip);
        $form_permis = $this->createForm(new PermisType, $permis);
        $avis = new Avis;
        $avis->setIp($ip);
        $form = $this->createForm(new AvisType(), $avis);
        $av = $this->get('database_connection')
            ->prepare("SELECT nroho__Demande.id FROM nroho__Demande JOIN nroho__Product ON nroho__Demande.product_id=nroho__Product.id "
            . "WHERE nroho__Demande.etat=? AND nroho__Demande.user_id=? AND nroho__Product.user_id=?");
        $av->bindValue(1, '1');
        $av->bindValue(2, $this->get('security.context')->getToken()->getUser()->getId());
        $av->bindValue(3, $id);
        $av->execute();
        $i = 0;
        while ($av->fetch()) {
            $i++;
        }
        if ($form->handleRequest($request)->isValid()) {
            $avis->setUser($this->get('security.context')->getToken()->getUser());
            $avis->setUserAvis($this->getDoctrine()->getRepository('BaseUserBundle:User')->find($id));
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Votre avis a bien été enregistrée.');
            return $this->redirect($this->generateUrl('nroho_base_profil', array('id' => $id)));
        }elseif ($form_permis->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            $permis->uploadProfilePicture();
            //$permis->setUser($this->get('security.context')->getToken()->getUser());
            
            $this->get('security.context')->getToken()->getUser()->setPermis($permis);
            
            $em->persist($permis);
            $em->flush();


            $request->getSession()->getFlashBag()->add('notice', 'Votre permis est en cours de vérification.');
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
        $j = $u = $voiture = 0;
        foreach ($tout_avis as $v) {
            $j++;
        }
        $user = $this->getDoctrine()->getRepository('BaseUserBundle:User')
            ->createQueryBuilder('a')
            ->leftJoin('a.permis', 'b')->addSelect('b')
            ->where('a.id = :id')
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
        foreach ($ways as $v) {
            $voiture = $v->getVehicule();
            $u++;
        }
        $response = $this->render('BaseNrohoBundle:Default:profil.html.twig', array(
            'form'        => $form->createView(),
            'avis'        => $tout_avis,
            'user'        => $user,
            'id'          => $id,
            'ways'        => $ways,
            'av'          => $i,
            'nbra'        => $j,
            'nbrw'        => $u,
            'voiture'     => $voiture,
            'form_permis' => $form_permis->createView(),
        ));
        return $response;
    }
    
    public function editProfilAction(Request $request, $id)
    {
        if ($this->get('security.context')->getToken()->getUser()->getId() == $id){
            $em   = $this->getDoctrine()->getManager();
            $user = $em->find('BaseUserBundle:User', $id);

            if ($request->getMethod() == 'POST') {
                $user->setGender($request->request->get('gender'));
                $user->setFirstname($request->request->get('nom'));
                $user->setSecondename($request->request->get('prenom'));
                $user->setBorn($request->request->get('naissance'));
                $user->setPhone($request->request->get('telephone'));
                $em->persist($user);
                $em->flush();
                return $this->forward('BaseNrohoBundle:User:Profil', array(
                    'id' => $id
                ));
            }

            $response = $this->render('BaseNrohoBundle:Default:editProfil.html.twig', array(
                'gender'    => $user->getGender(),
                'nom'       => $user->getFirstname(),
                'prenom'    => $user->getSecondename(),
                'naissance' => $user->getBorn(),
                'telephone' => $user->getPhone(),
                'id'        => $id,
            ));
        }else{
            $response = $this->redirect($this->generateUrl('homepage', array(
                'id' => $id,
            )));
        }
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
            $product->setMaj($request->request->get('maj'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->forward('BaseNrohoBundle:User:confirmationAdd');
        }  
        return $this->render('BaseNrohoBundle:Default:add.html.twig', array(
            'form'   => $form->createView(),
            'gender' => $this->get('security.context')->getToken()->getUser()->getGender(),
        ));
    }
    
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $product = $em->getRepository('BaseNrohoBundle:Product')->find($id);
        $form = $this->createForm(new productType(), $product);
        // On récupère la requête
        //$request = $this->get('request');
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
                $product->setMaj($request->request->get('maj'));
                $em->persist($product);
                $em->flush();
                // On redirige vers la page de visualisation de l'article nouvellement créé
                return $this->forward('BaseNrohoBundle:User:confirmationEdit');
            }
        }
        return $this->render('BaseNrohoBundle:Default:edit.html.twig', array(
            'form' => $form->createView(),
            'maj'  => $product->getMaj(),
        ));
    }
    
    public function annonceAction()
    {
        $a = 0;
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
        foreach($product as $data){
            $a++;
        }
        // afficher en session $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
        return $this->render('BaseNrohoBundle:Default:annonce.html.twig', array(
            'product' => $product,
            'nbrA'    => $a,
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
