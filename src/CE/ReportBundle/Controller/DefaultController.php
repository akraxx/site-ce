<?php

namespace CE\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEReportBundle:Report');
        
        
        $config = $this->container->get('ce.config');
        $reportsPerPages =  $config->getValue("rapports_par_page");
        
        
        $reports = $repository->findBy(array(), array('meetingDate' => 'desc'), $reportsPerPages, 0);
        $nb_pages = ceil(count($repository->findAll()) / $reportsPerPages);
        return $this->render('CEReportBundle:Default:index.html.twig', array('reports' => $reports, 'nb_pages' => $nb_pages, 'id' => 1));
    }
    
    public function pageAction($id) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEReportBundle:Report');
        
        $config = $this->container->get('ce.config');
        $reportsPerPages =  $config->getValue("rapports_par_page");
        
        $offset = ($id - 1) * $reportsPerPages;
        
        $reports = $repository->findBy(array(), array('meetingDate' => 'desc'), $offset+$reportsPerPages, $offset);
        $nb_pages = ceil(count($repository->findAll()) / $reportsPerPages);
        return $this->render('CEReportBundle:Default:index.html.twig', array('reports' => $reports, 'nb_pages' => $nb_pages, 'id' => $id));
    }

}
