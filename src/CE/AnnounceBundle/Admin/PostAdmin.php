<?php

namespace CE\AnnounceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
 
class PostAdmin extends Admin
{
    public function setSecurityContext($securityContext) {
        $this->securityContext = $securityContext;
    }

    public function getSecurityContext() {
        return $this->securityContext;
    }
    
    public function configure() {
        parent::configure();

        $this->datagridValues['_sort_by']    = 'date';
        $this->datagridValues['_sort_order'] = 'DESC';
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => "Titre"))
                ->add('content', null, array('label' => "Contenu", 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')))
                ->add('active', null, array('label' => "Activé", 'required' => false))
                ->add('onTop', null, array('label' => "Mettre en avant", 'required' => false))
                ->end()
                
        ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
            ->add('user', null, array('label' => "Utilisateur"))
            ->add('date', null, array('label' => "Date"))
            ->add('active', null, array('label' => "Activé", 'editable' => true))
            ->add('onTop', null, array('label' => "Mettre en avant", 'editable' => true))
        ;
    }
    
    public function prePersist($post) {
        $user = $this->getSecurityContext()->getToken()->getUser();
        $post->setUser($user);
        $post->setDate(new \DateTime('now'));
    }
}
