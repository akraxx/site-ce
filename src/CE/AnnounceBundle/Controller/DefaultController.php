<?php

namespace CE\AnnounceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CE\AnnounceBundle\Entity\Post;
use CE\AnnounceBundle\Form\PostType;

class DefaultController extends Controller {

    public function indexAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEAnnounceBundle:Post');
        
        $announces = $repository->findBy(array('active' =>  true), array('date' => 'desc'));
        
        $post = new Post();
        
        $form = $this->createForm(new PostType(), $post);
        
        return $this->render('CEAnnounceBundle:Default:index.html.twig', array('announces' => $announces, 'form' => $form->createView()));
    }
    
    public function postAction()
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        $request = $this->get('request');
        
        $emailAdmin = $this->container->get('ce.config')->getValue("contact_mail");
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $post->setDate(new \DateTime());
            $post->setUser($this->get('security.context')->getToken()->getUser());
            $post->setActive(false);
            $post->setOnTop(false);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Annonce postée. Elle est maintenant en attente de validation par un administrateur.'
                );
                
                $message = \Swift_Message::newInstance()
                    ->setSubject('[SITE CE] Nouvelle annonce postée')
                    ->setFrom($this->container->getParameter('mailer_user'))
                    ->setTo($emailAdmin)
                    ->setBody($this->renderView('CEAnnounceBundle:Default:email.html.twig', array('id' => $post->getId())), 'text/html')
                ;
                $this->get('mailer')->send($message);
                
                return $this->redirect($this->generateUrl('ce_announce_homepage'));
            }
            else {
                $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CEAnnounceBundle:Post');
        
                $announces = $repository->findBy(array(), array('date' => 'desc'));
                return $this->render('CEAnnounceBundle:Default:index.html.twig', array('announces' => $announces, 'form' => $form->createView()));
            }
        }
        
        
    }
    
}
