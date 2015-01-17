<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Avis;

class AvisData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $avis1 = new Avis();
        $avis1->setAvis('Tranquille, conduit bien');
        $avis1->setEmo(1);
        $avis1->setUser($this->getReference('user1'));
        $avis1->setUserAvis($this->getReference('user2'));
        $avis1->setIp('127.0.0.1');
        $manager->persist($avis1);
        
        $avis2 = new Avis();
        $avis2->setAvis('Tranquille, conduit bien');
        $avis2->setEmo(1);
        $avis2->setUser($this->getReference('user1'));
        $avis2->setUserAvis($this->getReference('user3'));
        $avis2->setIp('127.0.0.1');
        $manager->persist($avis2);
        
        $avis3 = new Avis();
        $avis3->setAvis('Tranquille, conduit bien');
        $avis3->setEmo(1);
        $avis3->setUser($this->getReference('user1'));
        $avis3->setUserAvis($this->getReference('user4'));
        $avis3->setIp('127.0.0.1');
        $manager->persist($avis3);
        
        $avis4 = new Avis();
        $avis4->setAvis('Tranquille, conduit bien');
        $avis4->setEmo(1);
        $avis4->setUser($this->getReference('user2'));
        $avis4->setUserAvis($this->getReference('user2'));
        $avis4->setIp('127.0.0.1');
        $manager->persist($avis4);
        
        $avis5 = new Avis();
        $avis5->setAvis('Tranquille, conduit bien');
        $avis5->setEmo(1);
        $avis5->setUser($this->getReference('user2'));
        $avis5->setUserAvis($this->getReference('user3'));
        $avis5->setIp('127.0.0.1');
        $manager->persist($avis5);
        
        $avis6 = new Avis();
        $avis6->setAvis('Tranquille, conduit bien');
        $avis6->setEmo(1);
        $avis6->setUser($this->getReference('user3'));
        $avis6->setUserAvis($this->getReference('user1'));
        $avis6->setIp('127.0.0.1');
        $manager->persist($avis6);
        
        $manager->flush();
        
        $this->addReference('avis1', $avis1);
        $this->addReference('avis2', $avis2);
        $this->addReference('avis3', $avis3);
        $this->addReference('avis4', $avis4);
        $this->addReference('avis5', $avis5);
        $this->addReference('avis6', $avis6);
    }
    
    public function getOrder()
    {
        return 7; // l'ordre dans lequel les fichiers sont chargés
    }
}
