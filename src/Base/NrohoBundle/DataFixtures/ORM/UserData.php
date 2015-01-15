<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\UserBundle\Entity\User;

class UserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('test');

        $manager->persist($user);
        $manager->flush();
        
        $this->addReference('admin-user', $user);
    }
    
    public function getOrder()
    {
        return 1; // l'ordre dans lequel les fichiers sont chargés
    }
}
