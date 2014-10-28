<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Base\NrohoBundle\Entity\Product;
use Base\NrohoBundle\Form\ProductType;
use Base\NrohoBundle\Entity\Comment;
use Base\NrohoBundle\Form\CommentType;
use Base\NrohoBundle\Entity\Demande;
use Base\NrohoBundle\Form\DemandeType;
use Base\NrohoBundle\Entity\Avis;
use Base\NrohoBundle\Form\AvisType;
use Symfony\Component\HttpFoundation\Request;
//use Doctrine\ORM\Query\Expr;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        /*
        $product = $em->getRepository('BaseNrohoBundle:Product')->findBy(
                   array(),     // $where 
                   array(),     // $orderBy
                   3,           // $limit
                   0            // $offset
        );
        */
        
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->addSelect('b')
                   ->leftJoin('a.user', 'b')
                   ->orderBy('a.id','DESC')
                   //->setFirstResult(2) //offset
                   ->setMaxResults(2)  //limit
                ;
        $product = $qb->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:index.html.twig', array(
            'product' => $product
        ));
    }
    
    public function inscriptionAction(Request $request)
    {
        
        $product = new Product();
        
        //$user = $this->get('security.context')->getToken()->getUser(); 
        //$userId = $user->getId();
        
        /*
        $form = $this->get('form.factory')->create(
            new ProductType(
                $this->get('security.context')->getToken()->getUser()
            )
        );
        */
        
        $form = $this->createForm(new ProductType(), $product);
        
        /*
        $form = $this->createForm(new ProductType(array( 'user' => $userId)), $product, array(
            'action' => $this->generateUrl('nroho_base_default'),
            'method' => 'POST'
        ));
        */
        
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
    
    /*
    public function addAction()
    {
        $session = $request->getSession();

        // store an attribute for reuse during a later user request
        $session->set('foo', 'bar');

        // get the attribute set by another controller in another request
        $foobar = $session->get('foobar');

        // use a default value if the attribute doesn't exist
        $filters = $session->get('filters', array());
    
        // création de l'objet
        $user = new User();
        $user->setGender('Mr');
        $user->setFirstname('Karim');
        $user->setSecondename('Mansoura');
        $user->setBorn('1984');
        $user->setPhone('0606060606');
        $user->setMail('a@a.fr');
        $user->setPwd('aaaaaa');
        
        // Création de l'entité manager
        $em  = $this->getDoctrine()->getManager();
        //$rep = $em->getRepository("BlogBundle:User");
        
        // Remplisage de la base de données
        $em->persist($user);
        $em->flush();
        
        // Vérification si c'est la méthode POST
        if ($this->getRequest()->getMethod() == 'POST') {
            // Variable session
            $this->get('session')->getFlashBag()->add('info', 'Article bien enregistré');
            // redirection
            return $this->redirect( $this->generateUrl('nroho_base_product', array('id' => $user->getId())) );
        }
        
        return $this->render('NrohoBaseBundle:Default:add.html.twig');
    }
    */
    
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
        $reservation = new Demande;
        $formD = $this->createForm(new DemandeType(), $reservation);
        //$formD = $this->createFormBuilder($reservation)->add('nombre', 'text');
        
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->where('a.id = :id')
                   ->setParameter('id', $id)
                ;
        $product = $qb->getQuery()->getResult();
        
        // --- Gestion du commentaire ---
        $comment = new Comment();
        //$comment->setComment('Un avis, une question,...');
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

                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $reservation->getId())));
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
        //$nbr = $qb->count();
        $comments = $qb->getQuery()->getResult();
        
        // Le nombre de commentaires
        $nbr = $this->getDoctrine()->getRepository('BaseNrohoBundle:Comment')
                    ->createQueryBuilder('a')
                    ->addSelect('COUNT(a) AS nbr')
                    ->where('a.product = :id')
                    ->setParameter('id', $id)
                    ->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:product.html.twig', array(
            'product' => $product,
            'comments' => $comments,
            'nbr' => $nbr,
            'form' => $form->createView(),
            'formD' => $formD->createView(),
            //'nbrPlace' => $nbrPlace,
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
        //$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
        //return $this->redirect($this->generateUrl('nroho_base_default', array('id' => $product->getId())));
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
                   //->setFirstResult(0) //offset
                   //->setMaxResults(0)  //limit
                ;
        
        $demande = $qb->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:demande.html.twig', array(
            'product' => $demande,
        ));
    }
    
    public function messageAction()
    {     
        $db  = $this->get('database_connection');
        $row = $db->query("SELECT User.secondename, User.gender, Message.depot, Message.user_id
                           FROM Message LEFT JOIN Product ON Message.product_id = Product.id 
                           LEFT JOIN User ON Message.user_id = User.id 
                           WHERE Product.user_id = '".$this->get('security.context')->getToken()->getUser()->getId()."'");
        $d = array();
        while ($data = $row->fetch()) {
            if(!in_array($data['user_id'],$d)){	
		$message[] = array(
			'user_id'	=> $data['user_id'],
			'gender' 	=> $data['gender'],
			'secondename'   => $data['secondename'],
			'depot'		=> $data['depot'],
		);
		$d[] = $data['user_id'];
            }
        }
        return $this->render('BaseNrohoBundle:Default:message.html.twig', array(
            'product' => $message,
        ));
    }
    
    public function rechercheAction()
    {
        //$em = $this->getDoctrine()->getManager();

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
        $form = $this->createForm(new AvisType(), $avis);
        
        $request = $this->get('request');
        if ($form->handleRequest($request)->isValid()) {
            $avis->setUser($this->get('security.context')->getToken()->getUser());
            //$avis->setIp($this->getRequest()->getClientIp());
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
                   //->leftJoin('a.user_avis', 'c')->addSelect('c')
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
        
        /*
        $user = array(
            'secondename' => $this->get('security.context')->getToken()->getUser()->getSecondename(),
            'born' => $this->get('security.context')->getToken()->getUser()->getBorn(),
            'phone' => $this->get('security.context')->getToken()->getUser()->getPhone(),
            'gender' => $this->get('security.context')->getToken()->getUser()->getGender(),
        );
        
        $user = $this->get('security.context')->getToken()->getUser();
        */
        
        return $this->render('BaseNrohoBundle:Default:profil.html.twig', array(
            'form' => $form->createView(),
            'avis' => $tout_avis,
            'user' => $user,
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
}