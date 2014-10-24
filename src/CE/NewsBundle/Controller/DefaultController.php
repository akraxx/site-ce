<?php

namespace CE\NewsBundle\Controller;

use CE\NewsBundle\Entity\Comment;
use CE\NewsBundle\Form\CommentType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post');


        $config = $this->container->get('ce.config');
        $postsPerPages = $config->getValue("actualites_par_page");


        $posts = $repository->findBy(array('active' => true), array('date' => 'desc'), $postsPerPages, 0);
        $nb_pages = ceil(count($repository->findAll()) / $postsPerPages);
        return $this->render('CENewsBundle:Default:index.html.twig', array('posts' => $posts, 'nb_pages' => $nb_pages, 'id' => 1));
    }

    public function pageAction($id) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post');


        $config = $this->container->get('ce.config');
        $postsPerPages = $config->getValue("actualites_par_page");

        $offset = ($id - 1) * $postsPerPages;
        $posts = $repository->findBy(array('active' => true), array('date' => 'desc'), $offset + $postsPerPages, $offset);
        $nb_pages = ceil(count($repository->findAll()) / $postsPerPages);
        return $this->render('CENewsBundle:Default:index.html.twig', array('posts' => $posts, 'nb_pages' => $nb_pages, 'id' => $id));
    }

    public function postAction($id) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post');

        $post = $repository->getPostWithComments($id);
        if (!$post) {
            throw $this->createNotFoundException('L\'actualité demandée n\'existe pas.');
        }
        
        $comment = new Comment();
        $comment->setPost($post);
        $form = $this->createForm(new CommentType(), $comment);
        
        

        return $this->render('CENewsBundle:Default:post.html.twig', array('post' => $post, 'form' => $form->createView()));
    }

    public function rightMenuAction() {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post');

        $config = $this->container->get('ce.config');
        $numberOfLatestsPosts = $config->getValue("dernieres_actualites_a_afficher");

        $posts = $repository->getLatestsPostsWithComments($numberOfLatestsPosts);

        return $this->render('CENewsBundle:Default:rightmenu.html.twig', array('posts' => $posts));
    }

    public function addCommentAction() {
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $id = $comment->getPost()->getId();
            $comment->setDate(new \DateTime());
            $comment->setUser($this->get('security.context')->getToken()->getUser());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();
                return $this->redirect($this->generateUrl('ce_news_post', array('id' => $id)) . '#commentaires');
            }
            else {
                return $this->render('CENewsBundle:Default:post.html.twig', array('post' => $comment->getPost(), 'form' => $form->createView()));
            }
        }
        
        return $this->redirect($this->generateUrl('ce_news_homepage'));
    }
    
    public function searchAction(Request $request) {
        $searchEntry = $request->query->get("recherche");

        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CENewsBundle:Post');
        
        $posts = $repository->getPostsBySearchCriteria($searchEntry);
        
        return $this->render('CENewsBundle:Default:searchresult.html.twig', array('posts' => $posts));
    }

}
