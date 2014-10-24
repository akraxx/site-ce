<?php

namespace CE\TwigExtensionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CETwigExtensionBundle:Default:index.html.twig', array('name' => $name));
    }
}
