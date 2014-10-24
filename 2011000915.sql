-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 30 Janvier 2014 à 23:18
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `2011000915`
--
CREATE DATABASE IF NOT EXISTS `2011000915` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `2011000915`;

-- --------------------------------------------------------

--
-- Structure de la table `acl_classes`
--

CREATE TABLE IF NOT EXISTS `acl_classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_69DD750638A36066` (`class_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `acl_entries`
--

CREATE TABLE IF NOT EXISTS `acl_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(10) unsigned NOT NULL,
  `object_identity_id` int(10) unsigned DEFAULT NULL,
  `security_identity_id` int(10) unsigned NOT NULL,
  `field_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ace_order` smallint(5) unsigned NOT NULL,
  `mask` int(11) NOT NULL,
  `granting` tinyint(1) NOT NULL,
  `granting_strategy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `audit_success` tinyint(1) NOT NULL,
  `audit_failure` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4` (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
  KEY `IDX_46C8B806EA000B103D9AB4A6DF9183C9` (`class_id`,`object_identity_id`,`security_identity_id`),
  KEY `IDX_46C8B806EA000B10` (`class_id`),
  KEY `IDX_46C8B8063D9AB4A6` (`object_identity_id`),
  KEY `IDX_46C8B806DF9183C9` (`security_identity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `acl_object_identities`
--

CREATE TABLE IF NOT EXISTS `acl_object_identities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_object_identity_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `object_identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entries_inheriting` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9407E5494B12AD6EA000B10` (`object_identifier`,`class_id`),
  KEY `IDX_9407E54977FA751A` (`parent_object_identity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `acl_object_identity_ancestors`
--

CREATE TABLE IF NOT EXISTS `acl_object_identity_ancestors` (
  `object_identity_id` int(10) unsigned NOT NULL,
  `ancestor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`object_identity_id`,`ancestor_id`),
  KEY `IDX_825DE2993D9AB4A6` (`object_identity_id`),
  KEY `IDX_825DE299C671CEA1` (`ancestor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `acl_security_identities`
--

CREATE TABLE IF NOT EXISTS `acl_security_identities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8835EE78772E836AF85E0677` (`identifier`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ce_activity_category`
--

CREATE TABLE IF NOT EXISTS `ce_activity_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ce_activity_category`
--

INSERT INTO `ce_activity_category` (`id`, `title`) VALUES
(1, 'Cinémas'),
(2, 'Golf');

-- --------------------------------------------------------

--
-- Structure de la table `ce_activity_item`
--

CREATE TABLE IF NOT EXISTS `ce_activity_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `available_tickets` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EFBF4E2D93CB796C` (`file_id`),
  KEY `IDX_EFBF4E2D12469DE2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ce_activity_item`
--

INSERT INTO `ce_activity_item` (`id`, `file_id`, `category_id`, `title`, `place`, `price`, `available_tickets`, `date`, `comment`) VALUES
(1, NULL, 1, 'Kinepolis 2e', 'Kinepolis lomme', 50.5, 9, '2014-01-30 19:54:09', 'A ne pas rater'),
(2, NULL, 2, 'Mini golf', 'Lambersart', 5, 6, '2014-01-30 20:04:13', '5e le 9 trous');

-- --------------------------------------------------------

--
-- Structure de la table `ce_announce_post`
--

CREATE TABLE IF NOT EXISTS `ce_announce_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_90E3BF24A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ce_announce_post`
--

INSERT INTO `ce_announce_post` (`id`, `user_id`, `title`, `content`, `date`) VALUES
(1, 1, 'Test Annonce 1', 'Contenu annonce 1', '2014-01-30 23:00:55'),
(2, 1, 'Test annonce 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non faucibus mauris. Integer velit eros, egestas eget tristique nec, lobortis ut massa. Nullam id purus fringilla, convallis mauris non, sodales velit. Ut euismod dolor sit amet sem viverra, sagittis lobortis lectus vulputate. Integer vitae sodales dui, a accumsan massa. Sed pretium tempus sem, sit amet pellentesque urna aliquet a. Vestibulum id risus iaculis erat consequat volutpat sit amet sit amet lectus. Mauris ut ligula sed.', '2014-01-30 23:09:48'),
(3, 1, 'Annonce posté par le front', 'test d''une Annonce posté par le front et des contraintes', '2014-01-30 23:51:32');

-- --------------------------------------------------------

--
-- Structure de la table `ce_config_entries`
--

CREATE TABLE IF NOT EXISTS `ce_config_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `ce_config_entries`
--

INSERT INTO `ce_config_entries` (`id`, `title`, `value`, `description`) VALUES
(1, 'rapports_par_page', '1', 'Défini le nombre de rapports à afficher par page'),
(2, 'actualites_par_page', '5', 'Défini le nombre d''actualités à afficher par page'),
(3, 'dernieres_actualites_a_afficher', '5', 'Défini le nombre de dernières actualités à afficher sur la page principale.'),
(4, 'contact_mail', 'contact@ceicl-lille.fr', 'Mail à afficher dans la partie contact.'),
(5, 'contact_facebook', '#', 'Lien facebook à afficher dans la partie contact.'),
(6, 'contact_twitter', '#', 'Lien twitter à afficher dans la partie contact.'),
(7, 'contact_googleplus', '#', 'Lien google plus à afficher dans la partie contact.'),
(8, 'contact_horaires_ouverture', 'Du lundi au vendredi de 9h à 18h', 'Horaires d''ouvertures à afficher dans la partie contact.'),
(9, 'contact_adresse', '41 rue du port', 'Adresse à afficher dans la partie contact.'),
(10, 'contact_ville_code_postal', '59000, Lille', 'Ville à afficher dans la partie contact.'),
(11, 'contact_telephone', '03 20 20 20 20', 'Téléphone à afficher dans la partie contact.');

-- --------------------------------------------------------

--
-- Structure de la table `ce_contact_message`
--

CREATE TABLE IF NOT EXISTS `ce_contact_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ce_contact_message`
--

INSERT INTO `ce_contact_message` (`id`, `name`, `email`, `phone`, `message`, `date`) VALUES
(1, 'Maximilien MARIE', 'root@root.fr', '0633969343', 'test', '2014-01-30 11:24:19'),
(2, 'zdzq', 'qzd@qzdzqd.fr', NULL, 'Test', '2014-01-30 13:45:17');

-- --------------------------------------------------------

--
-- Structure de la table `ce_news_comment`
--

CREATE TABLE IF NOT EXISTS `ce_news_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1A51A798A76ED395` (`user_id`),
  KEY `IDX_1A51A7984B89032C` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ce_news_comment`
--

INSERT INTO `ce_news_comment` (`id`, `user_id`, `post_id`, `date`, `content`) VALUES
(1, 1, 1, '2014-01-27 22:56:05', 'Test commentaire actualité 1'),
(2, 2, 1, '2014-01-27 22:56:16', 'Test commentaire actualité 1 bis'),
(3, 1, 1, '2014-01-28 19:57:09', 'test'),
(4, 1, 1, '2014-01-28 19:58:31', 'Zdqqd');

-- --------------------------------------------------------

--
-- Structure de la table `ce_news_post`
--

CREATE TABLE IF NOT EXISTS `ce_news_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `icone_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24DB1180A76ED395` (`user_id`),
  KEY `IDX_24DB11805A805D31` (`icone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ce_news_post`
--

INSERT INTO `ce_news_post` (`id`, `user_id`, `icone_id`, `title`, `active`, `content`, `date`) VALUES
(1, 1, NULL, 'Test actu 1', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel lorem a sapien lacinia pretium sit amet a orci. Suspendisse vel cursus nibh. Donec scelerisque ante velit, in convallis lacus aliquam sit amet. Phasellus nec mauris sed dolor consequat ultricies non id nunc. Pellentesque ullamcorper non velit a posuere. Vivamus sit amet dui tellus. Donec ac erat at dui cursus mattis vel vel lorem. Etiam quis ligula ut nibh blandit rhoncus id eleifend est. Quisque feugiat et dolor vitae facilisis. Vivamus ut elit dui. Fusce quis tincidunt mauris. Praesent non pharetra purus. Fusce dictum ligula lacinia tincidunt egestas. Vivamus vitae est at est ultricies porta non vitae tortor. Morbi vitae sodales ante. Mauris interdum lectus dolor, a pellentesque felis scelerisque nec.\r\n\r\nQuisque lacinia nulla eu nisi convallis scelerisque. Phasellus id consequat libero. Aliquam vel erat at felis porttitor rutrum. Duis facilisis, leo sed cursus vestibulum, massa lorem sagittis metus, et pretium amet.', '2014-01-27 22:48:01'),
(2, 1, NULL, 'Test actu 2', 0, 'testChaine Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel lorem a sapien lacinia pretium sit amet a orci. Suspendisse vel cursus nibh. Donec scelerisque ante velit, in convallis lacus aliquam sit amet. Phasellus nec mauris sed dolor consequat ultricies non id nunc. Pellentesque ullamcorper non velit a posuere. Vivamus sit amet dui tellus. Donec ac erat at dui cursus mattis vel vel lorem. Etiam quis ligula ut nibh blandit rhoncus id eleifend est. Quisque feugiat et dolor vitae facilisis. Vivamus ut elit dui. Fusce quis tincidunt mauris. Praesent non pharetra purus. Fusce dictum ligula lacinia tincidunt egestas. Vivamus vitae est at est ultricies porta non vitae tortor. Morbi vitae sodales ante. Mauris interdum lectus dolor, a pellentesque felis scelerisque nec.\r\n\r\nQuisque lacinia nulla eu nisi convallis scelerisque. Phasellus id consequat libero. Aliquam vel erat at felis porttitor rutrum. Duis facilisis, leo sed cursus vestibulum, massa lorem sagittis metus, et pretium amet.', '2014-01-27 22:48:12');

-- --------------------------------------------------------

--
-- Structure de la table `ce_report_item`
--

CREATE TABLE IF NOT EXISTS `ce_report_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B84060C93CB796C` (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ce_report_item`
--

INSERT INTO `ce_report_item` (`id`, `file_id`, `title`, `description`, `meeting_date`, `date`) VALUES
(1, 1, 'Rapport 1', 'Description rapport 1', '2013-01-01', '2014-01-30 15:22:54'),
(2, 2, 'Rapport 2', 'Description rapport 2', '2014-01-01', '2014-01-30 15:23:40');

-- --------------------------------------------------------

--
-- Structure de la table `ce_user`
--

CREATE TABLE IF NOT EXISTS `ce_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_699F46A092FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_699F46A0A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ce_user`
--

INSERT INTO `ce_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`) VALUES
(1, 'root', 'root', 'root@root.fr', 'root@root.fr', 1, '792f1ri7qhoggcwksksswkc40844s40', 'sBvNu4U/0sS/eOlzQOLivuFiBCy0tqxijZippAddN1tg21kQC7z4P4hcdFkQkwuepcwV/jXdQaDzi2IUawvMzA==', '2014-01-30 23:43:51', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '2014-01-26 17:19:47', '2014-01-30 23:43:51', NULL, 'Maximilien', 'MARIE', NULL, NULL, NULL, NULL, NULL, '0633969343', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
(2, 'test', 'test', 'akraxx@sfr.fr', 'akraxx@sfr.fr', 1, '8ci0sl3jskws0sggs8cswk8s0gc48ok', '+ho23F9fEH4ZQJx8ytuSutZaL3VQm8WhXIkf50upwnlGE02MSVDbI9XyxzhK8YcU+M5grdIJaNqqslpa5BuQ3Q==', '2014-01-26 17:33:35', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2014-01-26 17:26:27', '2014-01-30 15:18:26', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_583D1F3E5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_user`
--

CREATE TABLE IF NOT EXISTS `fos_user_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C560D76192FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_C560D761A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_B3C77447A76ED395` (`user_id`),
  KEY `IDX_B3C77447FE54D947` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery`
--

CREATE TABLE IF NOT EXISTS `media__gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery_media`
--

CREATE TABLE IF NOT EXISTS `media__gallery_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  KEY `IDX_80D4C541EA9FDD75` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__media`
--

CREATE TABLE IF NOT EXISTS `media__media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `media__media`
--

INSERT INTO `media__media` (`id`, `name`, `description`, `enabled`, `provider_name`, `provider_status`, `provider_reference`, `provider_metadata`, `width`, `height`, `length`, `content_type`, `content_size`, `copyright`, `author_name`, `context`, `cdn_is_flushable`, `cdn_flush_at`, `cdn_status`, `updated_at`, `created_at`) VALUES
(1, '02.EvaluationInitiale - Formation Bases de données avancées.pptx', NULL, 0, 'sonata.media.provider.file', 1, 'b5e465083a84ada6c4d32b7df565844ea61dbb56.ppt', '{"filename":"02.EvaluationInitiale - Formation Bases de donn\\u00e9es avanc\\u00e9es.pptx"}', NULL, NULL, NULL, 'application/vnd.ms-powerpoint', 341308, NULL, NULL, 'report_file', NULL, NULL, NULL, '2014-01-30 15:22:46', '2014-01-30 15:22:46'),
(2, '2013-2014 Emargements hebdomadaire M1.xlsx', NULL, 0, 'sonata.media.provider.file', 1, 'eacccb49069e0c92bac43ec086155de8079bb1ed.xls', '{"filename":"2013-2014 Emargements hebdomadaire M1.xlsx"}', NULL, NULL, NULL, 'application/vnd.ms-excel', 807470, NULL, NULL, 'report_file', NULL, NULL, NULL, '2014-01-30 15:23:36', '2014-01-30 15:23:36');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acl_entries`
--
ALTER TABLE `acl_entries`
  ADD CONSTRAINT `FK_46C8B806DF9183C9` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_46C8B8063D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_46C8B806EA000B10` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  ADD CONSTRAINT `FK_9407E54977FA751A` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`);

--
-- Contraintes pour la table `acl_object_identity_ancestors`
--
ALTER TABLE `acl_object_identity_ancestors`
  ADD CONSTRAINT `FK_825DE299C671CEA1` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_825DE2993D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ce_activity_item`
--
ALTER TABLE `ce_activity_item`
  ADD CONSTRAINT `FK_EFBF4E2D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `ce_activity_category` (`id`),
  ADD CONSTRAINT `FK_EFBF4E2D93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `ce_announce_post`
--
ALTER TABLE `ce_announce_post`
  ADD CONSTRAINT `FK_90E3BF24A76ED395` FOREIGN KEY (`user_id`) REFERENCES `ce_user` (`id`);

--
-- Contraintes pour la table `ce_news_comment`
--
ALTER TABLE `ce_news_comment`
  ADD CONSTRAINT `FK_1A51A7984B89032C` FOREIGN KEY (`post_id`) REFERENCES `ce_news_post` (`id`),
  ADD CONSTRAINT `FK_1A51A798A76ED395` FOREIGN KEY (`user_id`) REFERENCES `ce_user` (`id`);

--
-- Contraintes pour la table `ce_news_post`
--
ALTER TABLE `ce_news_post`
  ADD CONSTRAINT `FK_24DB11805A805D31` FOREIGN KEY (`icone_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_24DB1180A76ED395` FOREIGN KEY (`user_id`) REFERENCES `ce_user` (`id`);

--
-- Contraintes pour la table `ce_report_item`
--
ALTER TABLE `ce_report_item`
  ADD CONSTRAINT `FK_7B84060C93CB796C` FOREIGN KEY (`file_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_user_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `ce_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
