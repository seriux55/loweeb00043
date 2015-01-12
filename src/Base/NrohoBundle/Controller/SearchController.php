<?php

namespace Base\NrohoBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Base\NrohoBundle\Entity\Product;
use Base\NrohoBundle\Form\Type\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    public function addSelectAction(Request $request, $first, $seconde)
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
        foreach ($wilaya as $key => $value) {
            if(substr($value, 0, 2) == substr($first, 1, 3)){
                $depart = $value;  
            }
            if(substr($value, 0, 2) == substr($seconde, 1, 3)){
                $arrivee = $value;  
            }
        }
        $product = new Product();
        $product->setIp($this->getRequest()->getClientIp());
        $product->setDepart($depart);
        $product->setArrivee($arrivee);
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
    
    public function rechercheAction()
    {
        $product = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                   ->createQueryBuilder('a')
                   ->leftJoin('a.user', 'b')->addSelect('b')
                   ->where('a.valid = "1"')
                   ->setFirstResult(0) //offset
                   ->setMaxResults(5)  //limit
                   ->getQuery()->getResult();
        
        return $this->render('BaseNrohoBundle:Default:recherche.html.twig', array(
            'product' => $product,
        ));
    }
    
    public function topAction($page = 10)
    {
        $product = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                        ->createQueryBuilder('a')
                        ->addSelect('b')
                        ->leftJoin('a.user', 'b')
                        ->where('a.valid = :valid')
                        ->setParameter('valid', '1')
                        ->orderBy('a.id','DESC')
                        ->setFirstResult($page)
                        ->setMaxResults(10)
                        ->getQuery()
                        ->useResultCache(true, 600, '_search_top_'.$page)
                        ->getResult();
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($product, 'json');
        return new Response($reports);
    }    

    public function searchAction($first, $seconde)
    {
        $product = $this->getDoctrine()->getRepository('BaseNrohoBundle:Product')
                        ->createQueryBuilder('a')
                        ->leftJoin('a.user', 'b')->addSelect('b')
                        ->where("a.depart LIKE :depart AND a.arrivee LIKE :arrivee AND a.valid = '1'")
                        ->setParameter('depart', $first.'%')->setParameter('arrivee', $seconde.'%')
                        ->getQuery()
                        ->useResultCache(true, 600, '_search_'.$first.'_'.$seconde)
                        ->getResult();
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($product, 'json');
        return new Response($reports);
    }
    
    public function destinationAction($start)
    {
        $db  = $this->get('database_connection');
        $row = $db->prepare("SELECT arrivee FROM Product WHERE depart LIKE ? AND valid = '1'");
        $row->bindValue(1, $start.'%');
        $row->execute();
        $product = array();
        while ($data = $row->fetch()) {
            if(!in_array($data['arrivee'], $product) && $data['arrivee'] !== ""){
                $product[] = $data['arrivee'];
            }
        }
        sort($product);
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($product, 'json');
        return new Response($reports);
    }
}
