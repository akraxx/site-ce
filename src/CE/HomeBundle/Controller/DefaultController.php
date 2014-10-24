<?php

namespace CE\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $config = $this->container->get('ce.config');
        $nbActivitiesToDisplay = $config->getValue("accueil_activites_a_afficher");

        $nbAnnouncesToDisplay = $config->getValue("accueil_annonces_a_afficher");

        $nbNewsToDisplay = $config->getValue("accueil_actualites_a_afficher");
        
        $lastActivities = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEActivityBundle:Activity')
                ->findBy(array('active' => true), array('date' => 'desc'), $nbActivitiesToDisplay, 0);
        
        $lastNews = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post')
                ->findBy(array('active' => true), array('date' => 'desc'), $nbNewsToDisplay, 0);
        
        $lastAnnounces = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEAnnounceBundle:Post')
                ->findBy(array('active' => true), array('date' => 'desc'), $nbAnnouncesToDisplay, 0);
        
        $topActivities = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEActivityBundle:Activity')
                ->findBy(array('onTop' => true, 'active' => true), array('date' => 'desc'), $nbActivitiesToDisplay, 0);
        
        $topNews = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post')
                ->findBy(array('onTop' => true, 'active' => true), array('date' => 'desc'), $nbNewsToDisplay, 0);
        
        $topAnnounces = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEAnnounceBundle:Post')
                ->findBy(array('onTop' => true, 'active' => true), array('date' => 'desc'), $nbAnnouncesToDisplay, 0);
        
        return $this->render('CEHomeBundle:Default:index.html.twig', array('lastActivities' => $lastActivities, 
                                                                            'lastNews' => $lastNews,
                                                                            'lastAnnounces' => $lastAnnounces,
                                                                            'topActivities' => $topActivities, 
                                                                            'topNews' => $topNews,
                                                                            'topAnnounces' => $topAnnounces));
    }
}
