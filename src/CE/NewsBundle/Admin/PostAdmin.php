<?php

namespace CE\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
 
class PostAdmin extends Admin
{

    
    public function setSecurityContext($securityContext) {
        $this->securityContext = $securityContext;
    }

    public function getSecurityContext() {
        return $this->securityContext;
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => "Titre"))
                ->add('active', null, array('label' => "Actif", 'required' => false))
                ->add('activeComments', null, array('label' => "Activer les commentaires", 'required' => false))
                ->add('onTop', null, array('label' => "Mettre en avant", 'required' => false))
                ->add('content', null, array('label' => "Contenu", 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')))
                ->add('icone', 'sonata_type_model_list', array('label' => "Image", 'required' => false), array(
                'link_parameters' => array(
                    'context' => 'icone_news',
                    'provider'=>'sonata.media.provider.image'
                )))
                ->add('attachedFile', 'sonata_type_model_list', array('label' => "Pièce jointe", 'required' => false), array(
                'link_parameters' => array(
                    'context' => 'news_file',
                    'provider'=>'sonata.media.provider.file'
                )))
                ->end()
                
        ;
    }
    
    public function configure() {
        parent::configure();

        $this->datagridValues['_sort_by']    = 'date';
        $this->datagridValues['_sort_order'] = 'DESC';
    }

    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('title', null, array('label' => "Titre"))
                ->add('user', null, array('label' => "Auteur"))
                ->add('active', null, array('label' => "Actif"))
                ->add('onTop', null, array('label' => "Mettre en avant"))
                ->add('content', null, array('label' => "Contenu", 'global_search' => true))
                ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
            ->add('user', null, array('label' => "Auteur"))
            ->add('date', null, array('label' => "Date"))
            ->add('onTop', null, array('label' => "Mettre en avant", 'editable' => true))
            ->add('active', null, array('label' => "Actif", 'editable' => true))
            ->add('activeComments', null, array('label' => "Activer les commentaires", 'editable' => true))
        ;
    }
    
    public function prePersist($post) {
        $user = $this->getSecurityContext()->getToken()->getUser();
        $post->setUser($user);
        $post->setDate(new \DateTime('now'));
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
