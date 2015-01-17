<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\ImageVoiture;

class ImageVoitureData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
    }
    
    public function getOrder()
    {
        return 9; // l'ordre dans lequel les fichiers sont chargés
    }
}
