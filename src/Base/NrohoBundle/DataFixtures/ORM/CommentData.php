<?php

namespace Base\NrohoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Base\NrohoBundle\Entity\Comment;

class CommentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setUsername('admin');
        $comment->setPassword('test');

        $manager->persist($comment);
        $manager->flush();
        
        $this->addReference('admin-comment', $comment);
    }
    
    public function getOrder()
    {
        return 6; // l'ordre dans lequel les fichiers sont chargés
    }
}
