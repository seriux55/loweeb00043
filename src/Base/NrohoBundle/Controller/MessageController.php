<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Base\NrohoBundle\Entity\Message;

class MessageController extends Controller
{
    public function messageAction()
    {
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $db  = $this->get('database_connection');
        $row = $db->prepare(
            "SELECT u1.id AS u1_id, u1.secondename AS u1_secondename, u1.gender AS u1_gender, u2.id AS u2_id, u2.secondename AS u2_secondename, u2.gender AS u2_gender, nroho__Message.depot, nroho__Message.user_id AS M_user_id, nroho__Product.user_id AS P_user_id, nroho__Message.userDist_id, nroho__Product.id AS P_id
            FROM nroho__Message
            LEFT  JOIN nroho__Product ON nroho__Message.product_id = nroho__Product.id
            LEFT  JOIN nroho__User u1 ON nroho__Message.user_id = u1.id
            RIGHT JOIN nroho__User u2 ON nroho__Message.userDist_id = u2.id
            WHERE 
               ( nroho__Product.user_id  = ? AND nroho__Message.user_id != ? )
               OR 
               ( nroho__Product.user_id != ? AND nroho__Message.userDist_id =? )"
        );
        $row->bindValue(1, $idc);
        $row->bindValue(2, $idc);
        $row->bindValue(3, $idc);
        $row->bindValue(4, $idc);
        $row->execute();
        $d = array();
        $message = array();
        while ($data = $row->fetch()) {
            if(!in_array($data['M_user_id'],$d)){
		$message[] = array(
                    'user_id'       => $data['M_user_id'],
                    'product_id'    => $data['P_id'],
                    'gender'        => $data['u1_gender'],
                    'secondename'   => $data['u1_secondename'],
                    'depot'         => $data['depot']
		);
		$d[] = $data['M_user_id'];
            }
        }
        //If not, we build the Response as usual and then put it in cache !
        $response = $this->render('BaseNrohoBundle:Message:message.html.twig', array(
            'product' => $message,
        ));
        return $response;
    }
    
    public function messageidAction($id, $product)
    {
        $session = new Session();
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $message = $this->getDoctrine()->getRepository('BaseNrohoBundle:Message')
                        ->createQueryBuilder('a')
                        ->addSelect('b')->leftJoin('a.user', 'b')
                        ->addSelect('c')->leftJoin('a.product', 'c')
                        ->addSelect('d')->leftJoin('a.userDist', 'd')
                        ->where('((a.user = :idc AND a.userDist = :id) OR (a.user = :id AND a.userDist = :idc)) AND a.product = :product')
                        ->setParameter('idc', $idc)->setParameter('id', $id)->setParameter('product', $product)
                        ->orderBy('a.id','ASC')
                        ->setMaxResults(7)
                        ->getQuery()->getResult();
        foreach($message as $value){
            $lastId = $value->getId(); // recuperer le dernier id de message
        }
        $session->set('MessageLastId', $lastId); // On met en session le dernier id de message
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($message, 'json');
        $session->set('messagearray', $reports);
        return new Response($reports);
    }
    
    public function messagesubmitAction($id, $product, $msg)
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
    
    public function messageidlastAction($id, $product)
    {
        $session = new Session();
        $lastId  = $session->get('MessageLastId');
        $idc     = $this->get('security.context')->getToken()->getUser()->getId();
        $message = $this->getDoctrine()->getRepository('BaseNrohoBundle:Message')
                        ->createQueryBuilder('a')
                        ->addSelect('b')->leftJoin('a.user', 'b')
                        ->addSelect('c')->leftJoin('a.product', 'c')
                        ->addSelect('d')->leftJoin('a.userDist', 'd')
                        ->where('((a.user = :idc AND a.userDist = :id) OR (a.user = :id AND a.userDist = :idc)) AND a.product = :product')
                        ->andWhere('a.id > :lastId')
                        ->setParameter('idc', $idc)->setParameter('id', $id)->setParameter('product', $product)->setParameter('lastId', $lastId)
                        ->orderBy('a.id','ASC')
                        ->setMaxResults(1)
                        ->getQuery()->useResultCache(true, 600, '_message_last_'.$lastId)->getResult();
        foreach($message as $value){
            $lastId = $value->getId(); // recuperer le dernier id de message
        }
        $session->set('MessageLastId', $lastId); // On met en session le dernier id de message
        $serializer = $this->container->get('serializer');
        //$reports    = $serializer->serialize($message, 'json');
        //$reports    = $serializer->serialize($session->get('messagearray'), 'json');
        //$reports    = $serializer->deserialize($session->get('messagearray'),'Base\NrohoBundle\Entity\Message','json');
        $reports    = $session->get('messagearray');
        return new Response($reports);
    }
}
