<?php

namespace CE\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CE\ContactBundle\Entity\Message;
use CE\ContactBundle\Form\MessageType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $config = $this->container->get('ce.config');
        
        $em = $this->getDoctrine()
                ->getManager();
        
        $repository = $em
                ->getRepository('CEContactBundle:Category');
        
        $repositoryStaff = $em
                ->getRepository('CEContactBundle:Staff');
        
        $staff = $repositoryStaff->findAll();
        
        $contactValues = $config->getContactValues();
        
        $message = new Message();
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $message->setName($this->get('security.context')->getToken()->getUser()->getFullname());
            $message->setEmail($this->get('security.context')->getToken()->getUser()->getEmail());
            $message->setPhone($this->get('security.context')->getToken()->getUser()->getPhone());
        }
        $form = $this->createForm(new MessageType(), $message);
        
        $categories = $repository->findAll();
        
        return $this->render('CEContactBundle:Default:index.html.twig', array('staff' => $staff, 'contactValues' => $contactValues, 'form' => $form->createView(), 'categories' => $categories));
    }
    
    public function messageAction()
    {
        $message = new Message();
        $form = $this->createForm(new MessageType(), $message);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $message->setDate(new \DateTime());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Message envoyé.'
                );
                
                return $this->redirect($this->generateUrl('ce_contact_homepage'));
            }
            else {
                $config = $this->container->get('ce.config');
        
                $contactValues = $config->getContactValues();
                
                $em = $this->getDoctrine()
                    ->getManager();
                
                $repository = $em
                    ->getRepository('CEContactBundle:Category');
                
                $categories = $repository->findAll();

                $repositoryStaff = $em
                    ->getRepository('CEContactBundle:Staff');
        
                $staff = $repositoryStaff->findAll();
        
                return $this->render('CEContactBundle:Default:index.html.twig', array('staff' => $staff, 'contactValues' => $contactValues, 'form' => $form->createView(), 'categories' => $categories));
            }
        }
        
        
    }
}
