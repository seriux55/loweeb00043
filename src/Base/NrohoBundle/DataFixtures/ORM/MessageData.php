<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Message;

class MessageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $message1 = new Message();
        $message1->setEtat('1');
        $message1->setMessage('C\'est toujours d\'actualité?');
        $message1->setProduct($this->getReference('product1'));
        $message1->setUser($this->getReference('user1'));
        $message1->setUserDist($this->getReference('user2'));
        $message1->setIp('127.0.0.1');
        $manager->persist($message1);
        
        $message2 = new Message();
        $message2->setEtat('1');
        $message2->setMessage('Hello!');
        $message2->setProduct($this->getReference('product8'));
        $message2->setUser($this->getReference('user8'));
        $message2->setUserDist($this->getReference('user1'));
        $message2->setIp('127.0.0.1');
        $manager->persist($message2);
        
        $message3 = new Message();
        $message3->setEtat('1');
        $message3->setMessage('C\'est toujours d\'actualité?');
        $message3->setProduct($this->getReference('product7'));
        $message3->setUser($this->getReference('user1'));
        $message3->setUserDist($this->getReference('user7'));
        $message3->setIp('127.0.0.1');
        $manager->persist($message3);
        
        $message4 = new Message();
        $message4->setEtat('1');
        $message4->setMessage('Hello!');
        $message4->setProduct($this->getReference('product2'));
        $message4->setUser($this->getReference('user2'));
        $message4->setUserDist($this->getReference('user1'));
        $message4->setIp('127.0.0.1');
        $manager->persist($message4);
        
        $message5 = new Message();
        $message5->setEtat('1');
        $message5->setMessage('C\'est toujours d\'actualité?');
        $message5->setProduct($this->getReference('product3'));
        $message5->setUser($this->getReference('user1'));
        $message5->setUserDist($this->getReference('user3'));
        $message5->setIp('127.0.0.1');
        $manager->persist($message5);
        
        $message6 = new Message();
        $message6->setEtat('1');
        $message6->setMessage('Hello!');
        $message6->setProduct($this->getReference('product4'));
        $message6->setUser($this->getReference('user4'));
        $message6->setUserDist($this->getReference('user1'));
        $message6->setIp('127.0.0.1');
        $manager->persist($message6);
        
        $message7 = new Message();
        $message7->setEtat('1');
        $message7->setMessage('C\'est toujours d\'actualité?');
        $message7->setProduct($this->getReference('product9'));
        $message7->setUser($this->getReference('user1'));
        $message7->setUserDist($this->getReference('user9'));
        $message7->setIp('127.0.0.1');
        $manager->persist($message7);
        
        $message8 = new Message();
        $message8->setEtat('1');
        $message8->setMessage('Hello!');
        $message8->setProduct($this->getReference('product6'));
        $message8->setUser($this->getReference('user6'));
        $message8->setUserDist($this->getReference('user1'));
        $message8->setIp('127.0.0.1');
        $manager->persist($message8);
        
        
        $manager->flush();
        
        $this->addReference('message1', $message1);
        $this->addReference('message2', $message2);
        $this->addReference('message3', $message3);
        $this->addReference('message4', $message4);
        $this->addReference('message5', $message5);
        $this->addReference('message6', $message6);
        $this->addReference('message7', $message7);
        $this->addReference('message8', $message8);
    }
    
    public function getOrder()
    {
        return 4; // l'ordre dans lequel les fichiers sont chargés
    }
}
