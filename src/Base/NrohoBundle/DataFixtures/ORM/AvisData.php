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
        $avis = new Avis();
        $avis->setUsername('admin');
        $avis->setPassword('test');

        $manager->persist($avis);
        $manager->flush();
        
        $this->addReference('admin-avis', $avis);
    }
    
    public function getOrder()
    {
        return 7; // l'ordre dans lequel les fichiers sont chargés
    }
}
