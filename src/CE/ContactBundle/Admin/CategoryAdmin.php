<?php

namespace CE\ContactBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
 
class CategoryAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => "Titre"))
                ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('title', null, array('label' => "Titre"))
                ;
    }
    
    protected function configureRoutes(RouteCollection $collection) {

    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
        ;
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
