<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Sortiraalger;

class SortiraalgerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sortiraalger = new Sortiraalger();
        $sortiraalger->setUsername('admin');
        $sortiraalger->setPassword('test');

        $manager->persist($sortiraalger);
        $manager->flush();
        
        $this->addReference('admin-sortiraalger', $sortiraalger);
    }
    
    public function getOrder()
    {
        return 10; // l'ordre dans lequel les fichiers sont chargés
    }
}
