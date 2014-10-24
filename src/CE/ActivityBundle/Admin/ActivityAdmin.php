<?php

namespace CE\ActivityBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
 
class ActivityAdmin extends Admin
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
                ->add('place', null, array('label' => "Lieu"))
                ->add('price', null, array('label' => "Prix"))
                ->add('hiddenPrice', null, array('label' => "Prix caché", "required" => false))
                ->add('contactAdmin', null, array('label' => "Prix indisponible", "required" => false))
                ->add('availableTickets', null, array('label' => "Places disponibles", "required" => false))
                ->add('category', 'sonata_type_model_list', array('label' => "Categorie"))
                ->add('file', 'sonata_type_model_list', array('label' => "Pièce jointe", "required"=>false), array(
                    'link_parameters' => array(
                        'context' => 'activity_file',
                        'provider'=>'sonata.media.provider.file'
                )))
                ->add('protectedFile', null, array('label' => "Pièce jointe protégée", "required" => false))
                ->add('comment', null, array('label' => "Commentaire"))
                ->add('active', null, array('label' => "Activé", 'required' => false))
                ->add('onTop', null, array('label' => "Mettre en avant", 'required' => false))
                ->setHelps(array(
                    'protectedFile' => 'Si vous cochez cette case, la pièce jointe ne pourra être téléchargée que par les utilisateurs possedant un compte sur le site.',
                    'onTop' => 'Si vous cochez cette case, cette activité apparaîtra en page d\'accueil',
                    'hiddenPrice' => 'Si vous cochez cette case, le prix sera caché aux utilisateurs non connecté',
                    'contactAdmin' => 'Si vous cochez cette case, aucun prix ne sera affiché, il sera remplacé par "Contacter un administrateur"'
                ))
                ->end()
                
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $filter) {
        $filter
                ->add('title', null, array('label' => "Titre"))
                ->add('place', null, array('label' => "Lieu"))
                ->add('price', null, array('label' => "Prix"))
                ->add('availableTickets', null, array('label' => "Places disponibles"))
                ->add('category', null, array('label' => "Categorie"))
                ->add('comment', null, array('label' => "Commentaire", 'global_search' => true))
                ->add('active', null, array('label' => "Activé"))
                ->add('onTop', null, array('label' => "Mettre en avant"))
                ;
    }
    
    protected function configureListFields(ListMapper $list) {
        $list
            ->addIdentifier('title', null, array('label' => "Titre"))
                ->add('date')
                ->add('place', null, array('label' => "Lieu"))
                ->add('price', null, array('label' => "Prix"))
                ->add('availableTickets', null, array('label' => "Places disponibles"))
                ->add('category', null, array('label' => "Categorie"))
                ->add('active', null, array('label' => "Activé", 'editable' => true))
                ->add('onTop', null, array('label' => "Mettre en avant", 'editable' => true))
        ;
    }
    
    public function prePersist($activity) {
        $activity->setDate(new \DateTime('now'));
    }
    
    public function validate(\Sonata\AdminBundle\Validator\ErrorElement $errorElement, $object) {

    }
}
