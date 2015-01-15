<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\ImageProfil;

class ImageProfilData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $imageprofil = new ImageProfil();
        $imageprofil->setUsername('admin');
        $imageprofil->setPassword('test');

        $manager->persist($imageprofil);
        $manager->flush();
        
        $this->addReference('admin-imageprofil', $imageprofil);
    }
    
    public function getOrder()
    {
        return 8; // l'ordre dans lequel les fichiers sont chargés
    }
}
