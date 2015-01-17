<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Demande;

class DemandeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $demande1 = new Demande();
        $demande1->setEtat('3');
        $demande1->setNombre('2');
        $demande1->setProduct($this->getReference('product1'));
        $demande1->setUser($this->getReference('user2'));
        $demande1->setIp('127.0.0.1');
        $manager->persist($demande1);
        
        $demande2 = new Demande();
        $demande2->setEtat('2');
        $demande2->setNombre(1);
        $demande2->setProduct($this->getReference('product2'));
        $demande2->setUser($this->getReference('user1'));
        $demande2->setIp('127.0.0.1');
        $manager->persist($demande2);
        
        $demande3 = new Demande();
        $demande3->setEtat('1');
        $demande3->setNombre(2);
        $demande3->setProduct($this->getReference('product1'));
        $demande3->setUser($this->getReference('user3'));
        $demande3->setIp('127.0.0.1');
        $manager->persist($demande3);
        
        $demande4 = new Demande();
        $demande4->setEtat('1');
        $demande4->setNombre(1);
        $demande4->setProduct($this->getReference('product2'));
        $demande4->setUser($this->getReference('user4'));
        $demande4->setIp('127.0.0.1');
        $manager->persist($demande4);
        
        $demande5 = new Demande();
        $demande5->setEtat('0');
        $demande5->setNombre(2);
        $demande5->setProduct($this->getReference('product2'));
        $demande5->setUser($this->getReference('user5'));
        $demande5->setIp('127.0.0.1');
        $manager->persist($demande5);
        
        $demande6 = new Demande();
        $demande6->setEtat('1');
        $demande6->setNombre(1);
        $demande6->setProduct($this->getReference('product3'));
        $demande6->setUser($this->getReference('user1'));
        $demande6->setIp('127.0.0.1');
        $manager->persist($demande6);
        
        $manager->flush();
        
        $this->addReference('demande1', $demande1);
        $this->addReference('demande2', $demande2);
        $this->addReference('demande3', $demande3);
        $this->addReference('demande4', $demande4);
        $this->addReference('demande5', $demande5);
        $this->addReference('demande6', $demande6);
    }
    
    public function getOrder()
    {
        return 5; // l'ordre dans lequel les fichiers sont chargés
    }
}
