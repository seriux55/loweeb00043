<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Base\NrohoBundle\Entity\Product;
use Base\NrohoBundle\Form\Type\ProductType;
use Base\NrohoBundle\Entity\Comment;
use Base\NrohoBundle\Form\Type\CommentType;
use Base\NrohoBundle\Entity\Demande;
use Base\NrohoBundle\Entity\Avis;
use Base\NrohoBundle\Form\Type\AvisType;
use Base\NrohoBundle\Entity\Message;
use Symfony\Component\HttpFoundation\Request;
//use Doctrine\ORM\Query\Expr;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\SerializerBundle\JMSSerializerBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $wilaya = array(
                    "01 - Adrar", "02 - Chlef", "03 - Laghouat", "04 - Oum El Bouaghi", "05 - Batna",
                    "06 - Bejaia", "07 - Biskra", "08 - Bechar", "09 - Blida", "10 - Bouira", "11 - Tamanrasset",
                    "12 - Tebessa", "13 - Tlemcen", "14 - Tiaret", "15 - Tizi Ouzou", "16 - Alger",
                    "17 - Djelfa", "18 - Jijel", "19 - Setif", "20 - Saida", "21 - Skikda",
                    "22 - Sidi Bel Abbes", "23 - Annaba", "24 - Guelma", "25 - Constantine", "26 - Medea",
                    "27 - Mostaganem", "28 - MSila", "29 - Mascara", "30 - Ouargla", "31 - Oran",
                    "32 - Bayadh", "33 - Illizi", "34 - Bordj Bou Arreridj", "35 - Boumerdes",
                    "36 - El Tarf", "37 - Tindouf", "38 - Tissemsilt", "39 - El Oued", "40 - Khenchela",
                    "41 - Souk Ahras", "42 - Tipaza", "43 - Mila", "44 - Ain Defla", "45 - Naama",
                    "46 - Ain Temouchent", "47 - Ghardaia", "48 - Relizane");
        
        
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->addSelect('b')
                   ->leftJoin('a.user', 'b')
                   ->where('a.valid = :valid')
                   ->setParameter('valid', '1')
                   ->orderBy('a.id','DESC')
                   ->setMaxResults(2)
                ;
        $product = $qb->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:index.html.twig', array(
            'product' => $product,
            'wilaya'  => $wilaya,
        ));
    }
    
    public function inscriptionAction(Request $request)
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
            return $this->redirect($this->generateUrl('nroho_base_default', array('id' => $product->getId())));
        }
            
        return $this->render('BaseNrohoBundle:Default:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function addddAction() 
    {
        /*
        // On teste que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if (!$this->get('security.context')->isGranted('ROLE_AUTEUR')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedHttpException('Accès limité aux auteurs');
        }
        */
        // On crée un objet User
        $user = new User();
        $user->setIp($this->getRequest()->getClientIp());
        
        // On crée le formulaire depuis Form UserType
        $form = $this->createForm(new UserType, $user);
        
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
                $em->persist($user);
                $em->flush();

                // On redirige vers la page de visualisation de l'article nouvellement créé
                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $user->getId())));

            }
        }
        
        // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('BaseNrohoBundle:Default:add.html.twig', array(
           'form' => $form->createView(),
        ));
    }
    
    public function addAction()
    {
        return $this->render('BaseNrohoBundle:Default:add.html.twig');
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $product = $em->getRepository('BaseNrohoBundle:Product')->find($id);

        if (null === $product) {
          throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
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
                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $product->getId())));

            }
        }
        
        return $this->render('BaseNrohoBundle:Default:edit.html.twig', array(
           'form' => $form->createView(),
        ));
    }
    
    public function productAction($id)
    {
        // detail du covoiturage
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->where('a.id = :id')
                   ->setParameter('id', $id)
                ;
        $product = $qb->getQuery()->getResult();
        
        // nombre de places max
        foreach($product as $value) {
            $nbrPlace = $value->getPlace();
        }
        
        // formulaire de reservation
        $reservation = new Demande();
        $reservation->setIp($this->getRequest()->getClientIp());
        $formD = $this->createFormBuilder($reservation)->add('nombre', 'integer', array('attr' => array('min' =>1, 'max' => $nbrPlace)))->getForm();
        
        // --- Gestion du commentaire ---
        $comment = new Comment();
        $comment->setIp($this->getRequest()->getClientIp());
        $form = $this->createForm(new CommentType, $comment);
        
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
        
            $form->bind($request);
            if ($form->isValid()) {
                $comment->setProduct($this->getDoctrine()->getManager()->getRepository('BaseNrohoBundle:Product')->find($id));
                $comment->setUser($this->get('security.context')->getToken()->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();

                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $comment->getId())));
            }
            
            $formD->bind($request);
            if ($formD->isValid()){
                $reservation->setUser($this->get('security.context')->getToken()->getUser());
                $reservation->setProduct($this->getDoctrine()->getManager()->getRepository('BaseNrohoBundle:Product')->find($id));
                $em = $this->getDoctrine()->getManager();
                $em->persist($reservation);
                $em->flush();

                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $id)));
            }
            
        }
        // --- Fin de la gestion du commentaire ---
        
        // Affichage des commentaires
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Comment')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.product', 'b')->addSelect('b')
                   ->leftJoin('a.user', 'c')->addSelect('c')
                   ->where('a.product = :id')
                   ->setParameter('id', $id)
                ;
        $comments = $qb->getQuery()->getResult();
        
        // Le nombre de commentaires
        $nbr = $this->getDoctrine()->getRepository('BaseNrohoBundle:Comment')
                    ->createQueryBuilder('a')
                    ->addSelect('COUNT(a) AS nbr')
                    ->where('a.product = :id')
                    ->setParameter('id', $id)
                    ->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:product.html.twig', array(
            'product'  => $product,
            'comments' => $comments,
            'nbr'      => $nbr,
            'form'     => $form->createView(),
            'formD'    => $formD->createView(),
        ));
    }
    
    public function deleteAction($id)
    {
        return $this->render('BaseNrohoBundle:Default:delete.html.twig', array($id));
    }
    
    public function compteAction()
    {
        return $this->render('BaseNrohoBundle:Default:compte.html.twig');
    }
    
    public function ajoutAction()
    {
        return $this->render('BaseNrohoBundle:Default:ajout.html.twig');
    }
    
    public function annonceAction()
    {
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->where('a.user = :id')
                   ->setParameter('id', $this->get('security.context')->getToken()->getUser())
                   ->setFirstResult(0) //offset
                   ->setMaxResults(2)  //limit
                ;
        $product = $qb->getQuery()->getResult();
        // afficher en session $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
        return $this->render('BaseNrohoBundle:Default:annonce.html.twig', array(
            'product' => $product
        ));
    }
    
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
        
        return $this->render('BaseNrohoBundle:Default:demande.html.twig', array(
            'product' => $demande,
        ));
    }
    
    public function messageAction()
    {     
        $id = $this->get('security.context')->getToken()->getUser()->getId();
        $db  = $this->get('database_connection');
        $row = $db->prepare("SELECT User.secondename, User.gender, Message.depot, Message.user_id AS user_id
                           FROM Message LEFT JOIN Product ON Message.product_id = Product.id 
                           LEFT JOIN User ON Message.user_id = User.id 
                           WHERE Product.user_id = ? AND Message.user_id != ?");
        $row->bindValue(1, $id);
        $row->bindValue(2, $id);
        $row->execute();
        $d = array();
        $message = array();
        while ($data = $row->fetch()) {
            if(!in_array($data['user_id'],$d)){	
		$message[] = array(
                    'user_id'       => $data['user_id'],
                    'gender'        => $data['gender'],
                    'secondename'   => $data['secondename'],
                    'depot'         => $data['depot'],
		);
		$d[] = $data['user_id'];
            }
        }
        return $this->render('BaseNrohoBundle:Default:message.html.twig', array(
            'product' => $message,
        ));
    }
    
    public function messageidAction($id)
    {
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Message')
                   ->createQueryBuilder('a')
                   ->addSelect('b')
                   ->leftJoin('a.user', 'b')
                   ->addSelect('c')
                   ->leftJoin('a.product', 'c')
                   ->where('c.user = :user')
                   ->setParameter('user', $idc)
                   ->andwhere('a.user = :id OR (a.user = :user AND a.userDist = :id)')
                   ->setParameter('id', $id)
                   ->orderBy('a.id','ASC')
                   ->setMaxResults(7)  //limit
                ;
        $message = $qb->getQuery()->getResult();
        
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($message, 'json');
        return new Response($reports);
    }
    
    public function messagesubmitAction($msg, $id, $product)
    {
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $message    = new Message();
        
        $user       = $this->getDoctrine()->getRepository('BaseUserBundle:User')->find($idc);
        $userDist   = $this->getDoctrine()->getRepository('BaseUserBundle:User')->find($id);
        $productId  = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')->find($product);
           
        $message->setUser($user);
        $message->setProduct($productId);
        $message->setMessage($msg);
        $message->setUserDist($userDist);
        $message->setIp($this->getRequest()->getClientIp());

        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();
        return new Response('ok'); 
    }
    
    public function rechercheAction()
    {

        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->setFirstResult(0) //offset
                   ->setMaxResults(5)  //limit
                ;
        $product = $qb->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:recherche.html.twig', array(
            'product' => $product,
        ));
    }
    
    public function profilAction($id)
    {
        $avis = new Avis;
        $avis->setIp($this->getRequest()->getClientIp());
        $form = $this->createForm(new AvisType(), $avis);
        
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
        
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Avis')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->orderBy('a.id','ASC')
                   ->where('a.user_avis = :id')
                   ->setParameter('id', $id)
                ;
        $tout_avis = $qb->getQuery()->getResult();
        
        $qb = $this->getDoctrine()->getRepository('BaseUserBundle:User')
                   ->createQueryBuilder('a')
                   ->where('a.id = :id')
                   ->setParameter('id', $id)
                   ->setMaxResults(1)
                ;
        $user = $qb->getQuery()->getResult();
        
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Message')
                   ->createQueryBuilder('a')
                   ->addSelect('b')
                   ->leftJoin('a.user', 'b')
                   ->addSelect('c')
                   ->leftJoin('a.product', 'c')
                   ->where('c.user = :user')
                   ->setParameter('user', $idc)
                   ->andwhere('a.user = :id OR (a.user = :user AND a.userDist = :id)')
                   ->setParameter('id', 2)
                   ->orderBy('a.id','ASC')
                   ->setMaxResults(7)
                ;
        $message = $qb->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:profil.html.twig', array(
            'form' => $form->createView(),
            'avis' => $tout_avis,
            'user' => $user,
            'id'   => $id,
        ));
    }
    
    public function aideAction()
    {
        return $this->render('BaseNrohoBundle:Default:aide.html.twig');
    }
    
    public function yes_demandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->find('BaseNrohoBundle:Demande', $id)->setEtat('1');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Default:demande');
    }
    
    public function no_demandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->find('BaseNrohoBundle:Demande', $id)->setEtat('0');
        $em->flush();
        return $this->forward('BaseNrohoBundle:Default:demande');
    }
    
    public function topAction($page = 8)
    {
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->addSelect('b')
                   ->leftJoin('a.user', 'b')
                   ->where('a.valid = :valid')
                   ->setParameter('valid', '1')
                   ->orderBy('a.id','DESC')
                   ->setFirstResult($page)
                   ->setMaxResults(2)
                ;
        $product = $qb->getQuery()->getResult();
        
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($product, 'json');
        return new Response($reports);
    }
}
