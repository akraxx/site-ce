<?php

namespace CE\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        $value = $this->container->get('ce.config')->getValue('test');
        return $this->render('CEConfigBundle:Default:index.html.twig', array('name' => $value));
    }
}
