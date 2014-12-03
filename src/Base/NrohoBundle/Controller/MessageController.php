<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
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
        return $this->render('BaseNrohoBundle:Message:message.html.twig', array(
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
                   ->setMaxResults(7)
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
}
