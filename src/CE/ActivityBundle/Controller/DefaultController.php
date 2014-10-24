<?php

namespace CE\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEActivityBundle:Activity');
        
        $activities = $repository->getActiveActivities();
        
        return $this->render('CEActivityBundle:Default:index.html.twig', array('activities' => $activities));
    }
    
    public function categoriesSidebarAction($id = null) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEActivityBundle:Category');
        
        $categories = $repository->findBy(array('active' =>  true), array('id' => 'desc'));
        
        return $this->render('CEActivityBundle:Default:categoriessidebar.html.twig', array('categories' => $categories, 'id' => $id));
    }
    
    public function categoryAction($id) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEActivityBundle:Activity');
        
        $activities = $repository->findBy(array('active' =>  true, 'category' => $id), array('date' => 'desc'));
        
        return $this->render('CEActivityBundle:Default:index.html.twig', array('activities' => $activities, 'id' => $id));
    }
    
    

    public function dropDownMenuAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEActivityBundle:Category');
        
        $categories = $repository->findBy(array('active' =>  true));
        return $this->render('CEActivityBundle:Menu:dropdownmenu.html.twig', array('categories' => $categories));
    }

}
