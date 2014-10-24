<?php

namespace CE\ContactBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
 
class StaffAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('nom', null, array('label' => "Nom"))
                ->add('prenom', null, array('label' => "Prénom"))
                ->add('role', null, array('label' => "Role"))
                ->add('photo', 'sonata_type_model_list', array('label' => "Photo", 'required' => true), array(
                    'link_parameters' => array(
                        'context' => 'staff',
                        'provider'=>'sonata.media.provider.image'
                )))
                ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('nom', null, array('label' => "Nom"))
                ->add('prenom', null, array('label' => "Prénom"))
                ->add('role', null, array('label' => "Role"))
                ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('nom', null, array('label' => "Nom"))
            ->add('prenom', null, array('label' => "Prénom"))
            ->add('role', null, array('label' => "Role"))
        ;
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
