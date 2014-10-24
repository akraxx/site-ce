<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CE\ConfigBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CE\ConfigBundle\Entity\Entries;

class LoadEntriesData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist(new Entries('rapports_par_page', '5', 'Défini le nombre de rapports à afficher par page'));
        $manager->persist(new Entries('actualites_par_page', '5', 'Défini le nombre d\'actualités à afficher par page'));
        $manager->persist(new Entries('dernieres_actualites_a_afficher', '5', 'Défini le nombre de dernières actualités à afficher sur la page principale.'));
        $manager->persist(new Entries('contact_mail', 'contact@ceicl-lille.fr', 'Mail à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_facebook', '#', 'Lien facebook à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_twitter', '#', 'Lien twitter à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_googleplus', '#', 'Lien google plus à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_horaires_ouverture', 'Du lundi au vendredi de 9h à 18h', 'Horaires d\'ouvertures à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_adresse', '41 rue du port', 'Adresse à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_ville_code_postal', '59000, Lille', 'Ville à afficher dans la partie contact.'));
        $manager->persist(new Entries('contact_telephone', '03 20 20 20 20', 'Téléphone à afficher dans la partie contact.'));
        $manager->persist(new Entries('accueil_activites_a_afficher', '3', 'Défini le nombre d\'activités à afficher sur la page d\accueil'));
        $manager->persist(new Entries('accueil_annonces_a_afficher', '3', 'Défini le nombre d\'annonces à afficher sur la page d\'accueil'));
        $manager->persist(new Entries('accueil_actualites_a_afficher', '3', 'Défini le nombre d\'actualités à afficher sur la page d\'accueil'));

        $manager->flush();
    }
}
