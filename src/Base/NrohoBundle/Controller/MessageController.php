<?php

namespace Base\NrohoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Base\NrohoBundle\Entity\Message;

class MessageController extends Controller
{
    public function messageAction()
    {     
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $db  = $this->get('database_connection');
        $row = $db->prepare(
                            "SELECT u1.id AS u1_id, u1.secondename AS u1_secondename, u1.gender AS u1_gender, u2.id AS u2_id, u2.secondename AS u2_secondename, u2.gender AS u2_gender, Message.depot, Message.user_id AS M_user_id, Product.user_id AS P_user_id, Message.userDist_id, Product.id AS P_id
                             FROM Message
                             LEFT  JOIN Product ON Message.product_id = Product.id
                             LEFT  JOIN User u1 ON Message.user_id = u1.id
                             RIGHT JOIN User u2 ON Message.userDist_id = u2.id
                             WHERE 
                                ( Product.user_id  = ? AND Message.user_id != ? )
                                OR 
                                ( Product.user_id != ? AND Message.userDist_id =? )"
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
                //if($data['u1_id'] == $idc) $id = $data['u2_id']; else $id = $data['u1_id'];
		$message[] = array(
                    'user_id'       => $data['M_user_id'], //$data['user_id'],
                    'product_id'    => $data['P_id'],
                    'gender'        => $data['u1_gender'],
                    'secondename'   => $data['u1_secondename'],
                    'depot'         => $data['depot'],
		);
		$d[] = $data['M_user_id'];
            }
        }
        return $this->render('BaseNrohoBundle:Message:message.html.twig', array(
            'product' => $message,
        ));
    }
    
    public function messageidAction($id, $product)
    {
        $idc = $this->get('security.context')->getToken()->getUser()->getId();
        $qb = $this->getDoctrine()->getRepository('BaseNrohoBundle:Message')
                   ->createQueryBuilder('a')
                   ->addSelect('b')->leftJoin('a.user', 'b')
                   ->addSelect('c')->leftJoin('a.product', 'c')
                   ->addSelect('d')->leftJoin('a.userDist', 'd')
                   ->where('((a.user = :idc AND a.userDist = :id) OR (a.user = :id AND a.userDist = :idc)) AND a.product = :product')
                   ->setParameter('idc', $idc)->setParameter('id', $id)->setParameter('product', $product)
                   ->orderBy('a.id','ASC')
                   ->setMaxResults(7)
                ;
        $message = $qb->getQuery()->getResult();
        
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($message, 'json');
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
}
