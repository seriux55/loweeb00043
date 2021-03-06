<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Base\NrohoBundle\Entity\Message;
use Base\NrohoBundle\Form\Type\MessageType;
use Base\NrohoBundle\Entity\Comment;
use Base\NrohoBundle\Form\Type\CommentType;
use Base\NrohoBundle\Entity\Demande;
use Base\NrohoBundle\Entity\Product;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            "46 - Ain Temouchent", "47 - Ghardaia", "48 - Relizane"
        );
        $gc      = $this->get('database_connection');
        $em      = $this->getDoctrine();
        $product = new Product();
        $depart  = $product->getSearchDepart($gc);
        $ways    = $product->getListeWays($em);
        //If not, we build the Response as usual and then put it in cache !
        return $this->render('BaseNrohoBundle:Default:index.html.twig', array(
            'product' => $ways,
            'wilaya'  => $wilaya,
            'ville'   => $depart['0'],
            'nbr'     => $depart['1'],
        ));
    }
    
    public function productAction(Request $request, $id)
    {
        // detail du covoiturage
        $product = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
            ->createQueryBuilder('a')
            ->leftJoin('a.user', 'b')->addSelect('b')
            ->where("a.id = :id AND a.valid = '1'")
            ->setParameter('id', $id)
            ->getQuery()->getResult();
        // nombre de places max
        foreach($product as $value) {
            $nbrPlace = $value->getPlace();
            $userDist = $value->getUser();
            $nbrVue   = $value->getVue();
            $name     = $value->getUser()->getSecondename();
            $depart   = $value->getDepart();
            $arrivee  = $value->getArrivee();
            $email    = $value->getUser()->getEmail();
        }
        if (!isset($nbrPlace)) {
            throw new NotFoundHttpException("L'annonce n'existe pas :-( ");
        }
        // le nombre de vue
        $em = $this->getDoctrine()->getManager();
        $em->find('BaseNrohoBundle:Product', $id)->setVue($nbrVue+1);
        $em->flush();
        // formulaire de reservation
        $reservation = new Demande();
        $reservation->setIp($this->getRequest()->getClientIp());
        $formD = $this->createFormBuilder($reservation)->add('nombre', 'integer', array('attr' => array('min' =>1, 'max' => $nbrPlace)))->getForm();  
        // formulaire de message
        $message = new Message();
        $formM = $this->createForm(new MessageType, $message);
        // --- Gestion du commentaire ---
        $comment = new Comment();
        $comment->setIp($this->getRequest()->getClientIp());
        $form = $this->createForm(new CommentType, $comment);
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
                $message = \Swift_Message::newInstance()
                    ->setSubject('Vous avez reçu une demande de réservation sur nroho.com') //Votre commande chez bledvoyage.com
                    ->setFrom('contact@nroho.com')
                    ->setTo(array($email, 'validation@nroho.com'))
                    ->setBody($this->renderView('BaseNrohoBundle:Email:user_reservation_envoye.txt.twig', array(
                        'name'    => $name,
                        'fname'   => $this->get('security.context')->getToken()->getUser()->getSecondename(),
                        'depart'  => $depart,
                        'arrivee' => $arrivee,
                    )));
                $this->get('mailer')->send($message);
                $em->flush();
                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $id)));
            }
            $formM->bind($request);
            if ($formM->isValid()){
                $message->setUser($this->get('security.context')->getToken()->getUser());
                $message->setProduct($this->getDoctrine()->getManager()->getRepository('BaseNrohoBundle:Product')->find($id));
                $message->setUserDist($userDist);
                $message->setIp($this->getRequest()->getClientIp());
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $message = \Swift_Message::newInstance()
                    ->setSubject('Vous avez reçu un message sur nroho.com') //Votre commande chez bledvoyage.com
                    ->setFrom('contact@nroho.com')
                    ->setTo(array($email, 'validation@nroho.com'))
                    ->setBody($this->renderView('BaseNrohoBundle:Email:user_message_envoye.txt.twig', array(
                        'name'    => $name,
                        'fname'   => $this->get('security.context')->getToken()->getUser()->getSecondename(),
                        'depart'  => $depart,
                        'arrivee' => $arrivee,
                    )));
                $this->get('mailer')->send($message);
                $em->flush();
                return $this->redirect($this->generateUrl('nroho_base_product', array('id' => $id)));
            }
        }
        // --- Fin de la gestion du commentaire ---
        // Affichage des commentaires
        $comments = $this->getDoctrine()->getRepository('BaseNrohoBundle:Comment')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.product', 'b')->addSelect('b')
                   ->leftJoin('a.user', 'c')->addSelect('c')
                   ->where('a.product = :id')
                   ->setParameter('id', $id)
                   ->getQuery()->getResult();
        // Le nombre de commentaires
        $nbr = 0;
        foreach($comments as $c){
            $nbr++;
        }
        
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $response = $this->render('BaseNrohoBundle:Default:produit.html.twig', array(
                'product'  => $product,
                'comments' => $comments,
                'nbr'      => $nbr,
                'form'     => $form->createView(),
                'formD'    => $formD->createView(),
                'formM'    => $formM->createView(),
                'id'       => $id,
            ));
        }else{
            $response = $this->render('BaseNrohoBundle:Default:product.html.twig', array(
                'product'  => $product,
                'comments' => $comments,
                'nbr'      => $nbr,
                'form'     => $form->createView(),
                'formD'    => $formD->createView(),
                'formM'    => $formM->createView(),
                'id'       => $id,
            ));
        }
        return $response;
    }
    
    public function aideAction()
    {
        return $this->render('BaseNrohoBundle:Default:aide.html.twig');
    }
}
