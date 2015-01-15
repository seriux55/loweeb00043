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
        $demande = new Demande();
        $demande->setUsername('admin');
        $demande->setPassword('test');

        $manager->persist($demande);
        $manager->flush();
        
        $this->addReference('admin-demande', $demande);
    }
    
    public function getOrder()
    {
        return 5; // l'ordre dans lequel les fichiers sont chargés
    }
}
