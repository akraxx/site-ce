<?php

namespace CE\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
 
class CommentAdmin extends Admin
{
    public function configure() {
        parent::configure();

        $this->datagridValues['_sort_by']    = 'date';
        $this->datagridValues['_sort_order'] = 'DESC';
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('content', null, array('label' => "Contenu"))
                ->add('post', null, array('label' => "Actualité concernée"))
                ->add('user', 'sonata_type_model', array('label' => "Auteur"))
                ->end()
                
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('user', null, array('label' => "Auteur"))
                ->add('post', null, array('label' => "Actualité en relation"))
                ->add('content', null, array('label' => "Contenu", 'global_search' => true))
                ->add('date', 'doctrine_orm_date_range' , array('label' => "Plage de dates"))
                ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('content', null, array('label' => "Contenu"))
            ->add('date')
            ->add('user', null, array('label' => "Auteur"))
            ->add('post', null, array('label' => "Actualité en relation"))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
    
    public function prePersist($comment) {
        $comment->setDate(new \DateTime('now'));
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
