<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\UserBundle\Entity\User;

class UserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setBorn(1990);
        $user1->setEmail('seriux55@hotmail.com');
        $user1->setFirstname('ALLAM');
        $user1->setGender(1);
        $user1->setPhone('0601020304');
        $user1->setSecondename('Nadir');
        $user1->setIp('127.0.0.1');
        $user1->setEnabled('1');
        $user1->setPassword($this->container->get('security.encoder_factory')->getEncoder($user1)->encodePassword('Tictic2', $user1->getSalt()));
        $manager->persist($user1);
        
        $user2 = new User();
        $user2->setBorn(1990);
        $user2->setEmail('karim.man@live.fr');
        $user2->setFirstname('Mansoura');
        $user2->setGender(1);
        $user2->setPhone('0601020304');
        $user2->setSecondename('Karim');
        $user2->setIp('127.0.0.1');
        $user2->setEnabled('1');
        $user2->setPassword($this->container->get('security.encoder_factory')->getEncoder($user2)->encodePassword('021250031', $user2->getSalt()));
        $manager->persist($user2);
        
        $user3 = new User();
        $user3->setBorn(1990);
        $user3->setEmail('c@gmail.com');
        $user3->setFirstname('Fenniche');
        $user3->setGender(1);
        $user3->setPhone('0601020304');
        $user3->setSecondename('Khaled');
        $user3->setIp('127.0.0.1');
        $user3->setEnabled('1');
        $user3->setPassword($this->container->get('security.encoder_factory')->getEncoder($user3)->encodePassword('aaaaaa', $user3->getSalt()));
        $manager->persist($user3);
        
        $user4 = new User();
        $user4->setBorn(1990);
        $user4->setEmail('d@gmail.com');
        $user4->setFirstname('Fenniche');
        $user4->setGender(1);
        $user4->setPhone('0601020304');
        $user4->setSecondename('Khaled');
        $user4->setIp('127.0.0.1');
        $user4->setEnabled('1');
        $user4->setPassword($this->container->get('security.encoder_factory')->getEncoder($user4)->encodePassword('aaaaaa', $user4->getSalt()));
        $manager->persist($user4);
        
        $user5 = new User();
        $user5->setBorn(1990);
        $user5->setEmail('e@gmail.com');
        $user5->setFirstname('Fenniche');
        $user5->setGender(1);
        $user5->setPhone('0601020304');
        $user5->setSecondename('Khaled');
        $user5->setIp('127.0.0.1');
        $user5->setEnabled('1');
        $user5->setPassword($this->container->get('security.encoder_factory')->getEncoder($user5)->encodePassword('aaaaaa', $user5->getSalt()));
        $manager->persist($user5);
        
        $user6 = new User();
        $user6->setBorn(1990);
        $user6->setEmail('f@gmail.com');
        $user6->setFirstname('Fenniche');
        $user6->setGender(1);
        $user6->setPhone('0601020304');
        $user6->setSecondename('Khaled');
        $user6->setIp('127.0.0.1');
        $user6->setEnabled('1');
        $user6->setPassword($this->container->get('security.encoder_factory')->getEncoder($user6)->encodePassword('aaaaaa', $user6->getSalt()));
        $manager->persist($user6);
        
        $user7 = new User();
        $user7->setBorn(1990);
        $user7->setEmail('g@gmail.com');
        $user7->setFirstname('Fenniche');
        $user7->setGender(1);
        $user7->setPhone('0601020304');
        $user7->setSecondename('Khaled');
        $user7->setIp('127.0.0.1');
        $user7->setEnabled('1');
        $user7->setPassword($this->container->get('security.encoder_factory')->getEncoder($user7)->encodePassword('aaaaaa', $user7->getSalt()));
        $manager->persist($user7);
        
        $user8 = new User();
        $user8->setBorn(1990);
        $user8->setEmail('h@gmail.com');
        $user8->setFirstname('Fenniche');
        $user8->setGender(1);
        $user8->setPhone('0601020304');
        $user8->setSecondename('Khaled');
        $user8->setIp('127.0.0.1');
        $user8->setEnabled('1');
        $user8->setPassword($this->container->get('security.encoder_factory')->getEncoder($user8)->encodePassword('aaaaaa', $user8->getSalt()));
        $manager->persist($user8);
        
        $user9 = new User();
        $user9->setBorn(1990);
        $user9->setEmail('i@gmail.com');
        $user9->setFirstname('Fenniche');
        $user9->setGender(1);
        $user9->setPhone('0601020304');
        $user9->setSecondename('Khaled');
        $user9->setIp('127.0.0.1');
        $user9->setEnabled('1');
        $user9->setPassword($this->container->get('security.encoder_factory')->getEncoder($user9)->encodePassword('aaaaaa', $user9->getSalt()));
        $manager->persist($user9);
        
        $user10 = new User();
        $user10->setBorn(1990);
        $user10->setEmail('j@gmail.com');
        $user10->setFirstname('Fenniche');
        $user10->setGender(1);
        $user10->setPhone('0601020304');
        $user10->setSecondename('Khaled');
        $user10->setIp('127.0.0.1');
        $user10->setEnabled('1');
        $user10->setPassword($this->container->get('security.encoder_factory')->getEncoder($user10)->encodePassword('aaaaaa', $user10->getSalt()));
        $manager->persist($user10);
        
        $user11 = new User();
        $user11->setBorn(1990);
        $user11->setEmail('k@gmail.com');
        $user11->setFirstname('Fenniche');
        $user11->setGender(1);
        $user11->setPhone('0601020304');
        $user11->setSecondename('Khaled');
        $user11->setIp('127.0.0.1');
        $user11->setEnabled('1');
        $user11->setPassword($this->container->get('security.encoder_factory')->getEncoder($user11)->encodePassword('aaaaaa', $user11->getSalt()));
        $manager->persist($user11);
        
        $user12 = new User();
        $user12->setBorn(1990);
        $user12->setEmail('l@gmail.com');
        $user12->setFirstname('Fenniche');
        $user12->setGender(1);
        $user12->setPhone('0601020304');
        $user12->setSecondename('Khaled');
        $user12->setIp('127.0.0.1');
        $user12->setEnabled('1');
        $user12->setPassword($this->container->get('security.encoder_factory')->getEncoder($user12)->encodePassword('aaaaaa', $user12->getSalt()));
        $manager->persist($user12);
        
        $user13 = new User();
        $user13->setBorn(1990);
        $user13->setEmail('m@gmail.com');
        $user13->setFirstname('Fenniche');
        $user13->setGender(1);
        $user13->setPhone('0601020304');
        $user13->setSecondename('Khaled');
        $user13->setIp('127.0.0.1');
        $user13->setEnabled('1');
        $user13->setPassword($this->container->get('security.encoder_factory')->getEncoder($user13)->encodePassword('aaaaaa', $user13->getSalt()));
        $manager->persist($user13);
        
        $user14 = new User();
        $user14->setBorn(1990);
        $user14->setEmail('n@gmail.com');
        $user14->setFirstname('Fenniche');
        $user14->setGender(1);
        $user14->setPhone('0601020304');
        $user14->setSecondename('Khaled');
        $user14->setIp('127.0.0.1');
        $user14->setEnabled('1');
        $user14->setPassword($this->container->get('security.encoder_factory')->getEncoder($user14)->encodePassword('aaaaaa', $user14->getSalt()));
        $manager->persist($user14);
        
        $user15 = new User();
        $user15->setBorn(1990);
        $user15->setEmail('o@gmail.com');
        $user15->setFirstname('Fenniche');
        $user15->setGender(1);
        $user15->setPhone('0601020304');
        $user15->setSecondename('Khaled');
        $user15->setIp('127.0.0.1');
        $user15->setEnabled('1');
        $user15->setPassword($this->container->get('security.encoder_factory')->getEncoder($user15)->encodePassword('aaaaaa', $user15->getSalt()));
        $manager->persist($user15);
        
        $manager->flush();
        
        $this->addReference('user1',  $user1);
        $this->addReference('user2',  $user2);
        $this->addReference('user3',  $user3);
        $this->addReference('user4',  $user4);
        $this->addReference('user5',  $user5);
        $this->addReference('user6',  $user6);
        $this->addReference('user7',  $user7);
        $this->addReference('user8',  $user8);
        $this->addReference('user9',  $user9);
        $this->addReference('user10', $user10);
        $this->addReference('user11', $user11);
        $this->addReference('user12', $user12);
        $this->addReference('user13', $user13);
        $this->addReference('user14', $user14);
        $this->addReference('user15', $user15);
    }
    
    public function getOrder()
    {
        return 1; // l'ordre dans lequel les fichiers sont chargés
    }
}
