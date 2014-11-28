<?php

namespace Base\NrohoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /*
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
    */
    
    //On Déclare un tableau avec le nom de toutes les méthodes à tester
    private $actions = array("inscription", "index", "profil", "message", "demande", "edit", "product", "annonce", "messageId", "recherche", "aide", "yes_demande", "no_demande", "top");
    //Ainsi que le namespace du contrôleur à tester
    //private $controllerName = 'AppVentusBaseJobBoardBundleControllerBackAdController';
    private $controllerName = 'Base\NrohoBundle\Controller';

    public function testAllAction(){
        //On instancie le contrôleur
        $this->controller = $this->createController($this->controllerName);
        //On loggue un User admin (vous pouvez l’adapter à vos besoins)
        $this->container->get('security.context')->setToken(
            new SymfonyComponentSecurityCoreAuthenticationTokenUsernamePasswordToken(
                'seriux55@hotmail.com', 'aaaaaa', 'main', array('ROLE_ADMIN')
            )
        );

        print 'Testing '.$this->controllerName." n-------------------n";
        foreach($this->actions as $action_name){
            print 'Testing '.ucfirst($action_name)."Action n-------------------n";
            //Si la méthode de test à été déclarée dans notre classe de test, on l’exécute
            if(method_exists($this, "_test".ucfirst($action_name)."Action")){
                $this->{"_test".ucfirst($action_name)."Action"}();
                //Sinon, on exécute un test standard de cette méthode.
            }else{
                $response = $this->controller->{ucfirst($action_name)."Action"}();
                //On teste si la réponse est bien un objet Response, un tableau, ou une redirection.
                $this->assertTrue(is_array($response) || $response instanceof Response || $response instanceof RedirectResponse);
            }
        }
    }
}