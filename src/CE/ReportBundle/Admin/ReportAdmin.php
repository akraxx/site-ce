<?php

namespace CE\ReportBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class ReportAdmin extends Admin
{
    public function configure() {
        parent::configure();

        $this->datagridValues['_sort_by']    = 'date';
        $this->datagridValues['_sort_order'] = 'DESC';
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => "Titre"))
                ->add('description', null, array('label' => "Description"))
                ->add('meetingDate', null, array('label' => "Date de la réunion"))
                ->add('file', 'sonata_type_model_list', array('label' => "Fichier"), array(
                    'link_parameters' => array(
                        'context' => 'report_file',
                        'provider'=>'sonata.media.provider.file'
                )))
                ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('title', null, array('label' => "Titre"))
                ->add('description', null, array('label' => "Description"))
                ->add('meetingDate', null, array('label' => "Date de la réunion"))
                ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
            ->add('meetingDate', null, array('label' => "Date de la réunion"))
            ->add('date', null, array('label' => "Date d'enregistrement"))
            ->add('file', null, array('label' => "Pièce jointe"))
        ;
    }
    
    public function prePersist($post) {
        $post->setDate(new \DateTime('now'));
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
