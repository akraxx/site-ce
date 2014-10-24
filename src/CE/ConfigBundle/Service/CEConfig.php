<?php

namespace CE\ConfigBundle\Service;
use \Doctrine\ORM\EntityManager;

class CEConfig {
    /**
     * @var \Doctrine\ORM\EntityRepository $repository
     */
    protected $repository;
    
    public function __construct(EntityManager $em) {
        $this->repository = $em->getRepository('CEConfigBundle:Entries');
    }
    
    public function getValue($title) {
        return $this->repository->findOneByTitle($title)->getValue();
    }
    
    public function getContactValues() {
        $contactValues = array();
        $contactValues["telephone"] = $this->repository->findOneByTitle('contact_telephone')->getValue();
        $contactValues["mail"] = $this->repository->findOneByTitle('contact_mail')->getValue();
        $contactValues["facebook"] = $this->repository->findOneByTitle('contact_facebook')->getValue();
        $contactValues["twitter"] = $this->repository->findOneByTitle('contact_twitter')->getValue();
        $contactValues["googleplus"] = $this->repository->findOneByTitle('contact_googleplus')->getValue();
        $contactValues["horaires_ouverture"] = $this->repository->findOneByTitle('contact_horaires_ouverture')->getValue();
        $contactValues["adresse"] = $this->repository->findOneByTitle('contact_adresse')->getValue();
        $contactValues["ville_code_postal"] = $this->repository->findOneByTitle('contact_ville_code_postal')->getValue();
        return $contactValues;
    }
}
