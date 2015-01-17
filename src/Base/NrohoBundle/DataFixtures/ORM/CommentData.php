<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Comment;

class CommentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1->setComment('J\'aimerai bien y allé aussi');
        $comment1->setProduct($this->getReference('product1'));
        $comment1->setUser($this->getReference('user6'));
        $comment1->setIp('127.0.0.1');
        $manager->persist($comment1);
        
        $comment2 = new Comment();
        $comment2->setComment('J\'aimerai bien y allé aussi');
        $comment2->setProduct($this->getReference('product2'));
        $comment2->setUser($this->getReference('user5'));
        $comment2->setIp('127.0.0.1');
        $manager->persist($comment2);
        
        $comment3 = new Comment();
        $comment3->setComment('J\'aimerai bien y allé aussi');
        $comment3->setProduct($this->getReference('product3'));
        $comment3->setUser($this->getReference('user7'));
        $comment3->setIp('127.0.0.1');
        $manager->persist($comment3);
        
        $comment4 = new Comment();
        $comment4->setComment('J\'aimerai bien y allé aussi');
        $comment4->setProduct($this->getReference('product4'));
        $comment4->setUser($this->getReference('user8'));
        $comment4->setIp('127.0.0.1');
        $manager->persist($comment4);
        
        $comment5 = new Comment();
        $comment5->setComment('J\'aimerai bien y allé aussi');
        $comment5->setProduct($this->getReference('product1'));
        $comment5->setUser($this->getReference('user9'));
        $comment5->setIp('127.0.0.1');
        $manager->persist($comment5);
        
        $comment6 = new Comment();
        $comment6->setComment('J\'aimerai bien y allé aussi');
        $comment6->setProduct($this->getReference('product2'));
        $comment6->setUser($this->getReference('user1'));
        $comment6->setIp('127.0.0.1');
        $manager->persist($comment6);
        
        $manager->flush();
        
        $this->addReference('comment1', $comment1);
        $this->addReference('comment2', $comment2);
        $this->addReference('comment3', $comment3);
        $this->addReference('comment4', $comment4);
        $this->addReference('comment5', $comment5);
        $this->addReference('comment6', $comment6);
    }
    
    public function getOrder()
    {
        return 6; // l'ordre dans lequel les fichiers sont chargés
    }
}
