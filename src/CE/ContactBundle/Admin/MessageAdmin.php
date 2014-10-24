<?php

namespace CE\ContactBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
 
class MessageAdmin extends Admin
{
    public function configure() {
        parent::configure();

        $this->datagridValues['_sort_by']    = 'date';
        $this->datagridValues['_sort_order'] = 'DESC';
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('name', null, array('label' => "Nom"))
                ->add('email', null, array('label' => "E-mail"))
                ->add('phone', null, array('label' => "Téléphone"))
                ->add('message', null, array('label' => "Message", 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')))
                ->add('category', null, array('label' => "Catégorie"))
                ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('name', null, array('label' => "Nom"))
                ->add('email', null, array('label' => "E-mail"))
                ->add('phone', null, array('label' => "Téléphone"))
                ->add('message', null, array('label' => "Message"))
                ->add('category', null, array('label' => "Catégorie"))
                ;
    }
    
    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('create');
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('name', null, array('label' => "Nom"))
            ->add('email', null, array('label' => "E-mail", 
                                        'template' => 'CEContactBundle:Admin:listEmail.html.twig'))
            ->add('phone', null, array('label' => "Téléphone"))
            ->add('message', null, array('label' => "Message",
                                        'template' => 'CEContactBundle:Admin:listMessage.html.twig'))
            ->add('category', null, array('label' => "Catégorie"))
        ;
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
