-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 18 Novembre 2017 à 21:09
-- Version du serveur: 5.5.58-0ubuntu0.14.04.1-log
-- Version de PHP: 5.6.30-12~ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `rdvorl`
--

-- --------------------------------------------------------

--
-- Structure de la table `affiliate`
--

CREATE TABLE IF NOT EXISTS `affiliate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `nom_court` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse1` text COLLATE utf8_unicode_ci,
  `adresse2` text COLLATE utf8_unicode_ci,
  `code_postal` int(11) DEFAULT NULL,
  `commune` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `convention` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horaire` text COLLATE utf8_unicode_ci,
  `url_site` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `agenda_courant_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agenda_courant_id` (`agenda_courant_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliate_id` int(11) DEFAULT NULL,
  `libelle` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `duration` int(11) DEFAULT '30',
  `statut` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `monday` tinyint(4) NOT NULL DEFAULT '1',
  `tuesday` tinyint(4) NOT NULL DEFAULT '1',
  `wednesday` tinyint(4) NOT NULL DEFAULT '1',
  `thursday` tinyint(4) NOT NULL DEFAULT '1',
  `friday` tinyint(4) NOT NULL DEFAULT '1',
  `saturday` tinyint(4) NOT NULL DEFAULT '1',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  `heure_debut` time DEFAULT '08:00:00',
  `heure_fin` time DEFAULT '20:00:00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vedim_affiliate_I_1` (`affiliate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

INSERT INTO `agenda` (`id`, `affiliate_id`, `libelle`, `duration`, `statut`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `heure_debut`, `heure_fin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Standard', 30, 'OK', 1, 1, 1, 1, 1, 1, 0, '09:00:00', '19:00:00', NULL, NULL);
-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_court` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo_nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `convention` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horaire` text COLLATE utf8_unicode_ci,
  `url_site` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `agenda_courant_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agenda_courant_id` (`agenda_courant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  ;

INSERT INTO `company` (`id`, `nom_court`, `nom`, `logo_nom`, `telephone`, `convention`, `horaire`, `url_site`, `email1`, `email2`, `latitude`, `longitude`, `agenda_courant_id`, `created_at`, `updated_at`) VALUES
(1, 'Bill', 'Docteur Bill', 'logo', '04 09 09 09 09', 'Conventionné secteur 2 (honoraires libres)', 'Secrétariat ouvert du lundi au vendredi 9h - 13h', 'http://soft.immo', 'monMail@gmail.com', 'monSecretariat@gmail.com', 5, 45, 1, '2017-02-13 00:00:00', '2017-02-13 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agenda_id` int(11) DEFAULT NULL,
  `evenement_type_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debut` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evenement_type_id` (`evenement_type_id`),
  KEY `agenda_id` (`agenda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Structure de la table `evenement_type`
--

CREATE TABLE IF NOT EXISTS `evenement_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `duration` int(3) DEFAULT NULL,
  `accept_visite` tinyint(3) DEFAULT '1',
  `accessible_client` tinyint(3) DEFAULT '1',
  `accessible_new_client` tinyint(3) DEFAULT '1',
  `color_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `recommendation` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  ;


-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semaine_id` int(11) DEFAULT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `evenement_type_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_naissance` datetime DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `date_debut` datetime DEFAULT NULL,
  `date_heure_debut` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evenement_type_id` (`evenement_type_id`),
  KEY `semaine_id` (`semaine_id`),
  KEY `company_id` (`affiliate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;


--
-- Structure de la table `semaine`
--

CREATE TABLE IF NOT EXISTS `semaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `agenda_id` int(11) DEFAULT NULL,
  `numero` int(5) DEFAULT '30',
  `date_debut` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vedim_company_I_1` (`company_id`),
  KEY `agenda_id` (`agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Structure de la table `semaine_plage`
--

CREATE TABLE IF NOT EXISTS `semaine_plage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semaine_id` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `debut` time DEFAULT NULL,
  `fin` time DEFAULT NULL,
  `monday` tinyint(4) NOT NULL DEFAULT '0',
  `tuesday` tinyint(4) NOT NULL DEFAULT '0',
  `wednesday` tinyint(4) NOT NULL DEFAULT '0',
  `thursday` tinyint(4) NOT NULL DEFAULT '0',
  `friday` tinyint(4) NOT NULL DEFAULT '0',
  `saturday` tinyint(4) NOT NULL DEFAULT '0',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  `convenance` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agenda_id` (`semaine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Structure de la table `semaine_plage_type`
--

CREATE TABLE IF NOT EXISTS `semaine_plage_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agenda_id` int(11) DEFAULT NULL,
  `duration` int(3) DEFAULT NULL,
  `debut` time DEFAULT NULL,
  `fin` time DEFAULT NULL,
  `monday` tinyint(4) NOT NULL DEFAULT '0',
  `tuesday` tinyint(4) NOT NULL DEFAULT '0',
  `wednesday` tinyint(4) NOT NULL DEFAULT '0',
  `thursday` tinyint(4) NOT NULL DEFAULT '0',
  `friday` tinyint(4) NOT NULL DEFAULT '0',
  `saturday` tinyint(4) NOT NULL DEFAULT '0',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  `convenance` int(3) DEFAULT NULL,
  `accessible_client` tinyint(4) DEFAULT '1',
  `debut_validite` datetime DEFAULT NULL,
  `fin_validite` datetime DEFAULT NULL,
  `validite_infini` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vedim_affiliate_I_1` (`agenda_id`),
  KEY `agenda_id` (`agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `roles` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `company_id`, `username`, `password`, `email`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin', 'monMailUser@gmail.com', 1, NULL, NULL);

CREATE TABLE IF NOT EXISTS `company_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`agenda_courant_id`) REFERENCES `agenda` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`evenement_type_id`) REFERENCES `evenement_type` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `semaine`
--
ALTER TABLE `semaine`
  ADD CONSTRAINT `semaine_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `semaine_ibfk_2` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`);

--
-- Contraintes pour la table `semaine_plage`
--
ALTER TABLE `semaine_plage`
  ADD CONSTRAINT `semaine_plage_ibfk_1` FOREIGN KEY (`semaine_id`) REFERENCES `semaine` (`id`);

--
-- Contraintes pour la table `semaine_plage_type`
--
ALTER TABLE `semaine_plage_type`
  ADD CONSTRAINT `semaine_plage_type_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
