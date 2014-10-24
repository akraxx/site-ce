<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
/**
 * Controller managing the registration
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends BaseController
{
    public function registerAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();
            
            /*****************************************************
             * Add new functionality (e.g. log the registration) *
             *****************************************************/
            $this->container->get('logger')->info(
                sprintf('Email to send to activate: %s', $user)
            );
            
            $emailAdmin = $this->container->get('ce.config')->getValue("contact_mail");
            $message = \Swift_Message::newInstance()
                ->setSubject('[SITE CE] Nouvel utilisateur')
                ->setFrom($this->container->getParameter('mailer_user'))
                ->setTo($emailAdmin)
                ->setBody($this->container->get('templating')->render('ApplicationSonataUserBundle:Email:email.html.twig', array('id' => $user->getId())), 'text/html')
            ;
            $this->container->get('mailer')->send($message);
            
//            $message = \Swift_Message::newInstance()
//                ->setSubject('[SITE CE] Nouvel utilisateur')
//                ->setFrom($this->container->getParameter('mailer_user'))
//                ->setTo($emailAdmin)
//                ->setBody(
//                        '<!DOCTYPE html>
//<html lang="fr">
//    <head>
//
//    </head>
//    <body>
//        <p>Bonjour,</p>
//
//        <p>Un nouvel utilisateur s\'est enregistré : ' . $user .'</p>
//
//        <i>Cordialement,</i>
//    </body>
//</html>', 'text/html')
//            ;
            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
        
    }
    
}
