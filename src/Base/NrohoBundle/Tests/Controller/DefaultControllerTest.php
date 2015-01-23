<?php

namespace Base\NrohoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Base\NrohoBundle\Controller\DefaultController;

class DefaultControllerTest extends WebTestCase
{
    
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        //$this->assertTrue($crawler->filter('html:contains("nroho")')->count() > 0);
        
        $this->assertEquals('Base\NrohoBundle\Controller\DefaultController::indexAction', $client->getRequest()->attributes->get('_controller'));
        //$this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('.jobs td.position:contains("Expired")')->count() == 0);
        
        $kernel = static::createKernel();
        $kernel->boot();
        $max_jobs_on_homepage = $kernel->getContainer()->getParameter('max_jobs_on_homepage');
        $this->assertTrue($crawler->filter('.category_programming tr')->count());
    }
    
}
