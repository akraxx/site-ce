<?php

namespace CE\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CEMediaBundle:Default:index.html.twig', array('name' => $name));
    }
}
