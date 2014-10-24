<?php

namespace CE\ActivityBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
 
class CategoryAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => "Titre"))
                ->add('active', null, array('label' => "Activé", 'required' => false))
                ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('title', null, array('label' => "Titre"))
                ->add('active', null, array('label' => "Activé"))
                ->add('date', 'doctrine_orm_date_range' , array('label' => "Plage de dates"))
                ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
            ->add('active', null, array('label' => "Activé", 'editable' => true))
            ->add('date')
        ;
    }
    
    public function prePersist($activity) {
        $activity->setDate(new \DateTime('now'));
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
