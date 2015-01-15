<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Product;

class ProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setUsername('admin');
        $product->setPassword('test');

        $manager->persist($product);
        $manager->flush();
        
        $this->addReference('admin-product', $product);
    }
    
    public function getOrder()
    {
        return 2; // l'ordre dans lequel les fichiers sont chargés
    }
}
