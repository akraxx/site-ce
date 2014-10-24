<?php

namespace CE\ConfigBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
 
class EntriesAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => "Paramètre"))
                ->add('description', null, array('label' => "Description"))
                ->add('value', null, array('label' => "Valeur"))
                ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('title', null, array('label' => "Paramètre"))
                ->add('description', null, array('label' => "Description"))
                ->add('value', null, array('label' => "Valeur"))
                ;
    }
    
    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('create');
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
            ->add('value', null, array('label' => "Valeur"))
            ->add('description', null, array('label' => "Description"))
        ;
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
