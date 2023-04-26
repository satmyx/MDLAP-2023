-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 26 avr. 2023 à 14:42
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbmdl`
--

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

DROP TABLE IF EXISTS `atelier`;
CREATE TABLE IF NOT EXISTS `atelier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vacation_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1BB182354DD8D72` (`vacation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`id`, `vacation_id`, `libelle`, `nb_places`) VALUES
(1, 1, 'Le club et son projet', 10),
(2, 2, 'Fonctionnement du club', 6),
(3, 3, 'Les outils mis à disposition et remis aux clubs', 5),
(4, 4, 'Observatoire des métiers', 50),
(5, 5, 'IFFE', 12),
(6, 6, 'Développement durable', 8);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apartenir_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarifs_nuites` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C509E4FFD90EC3ED` (`apartenir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `apartenir_id`, `libelle`, `tarifs_nuites`) VALUES
(1, 1, 'Single du 08/09', '90.00'),
(2, 1, 'Single du 09/09', '90.00'),
(3, 2, 'Single du 08/09', '65.00'),
(4, 2, 'Single du 09/09', '65.00'),
(5, 1, 'Single du 08 au 09/09', '180.00'),
(6, 1, 'Double du 08 au 09/09', '200.00'),
(7, 2, 'Single du 08 au 09/09', '130.00'),
(8, 2, 'Double du 08 au 09/09', '150.00'),
(9, 1, 'Double du 08/09', '100.00'),
(10, 1, 'Double du 09/09', '100.00'),
(11, 2, 'Double du 08/09', '75.00'),
(12, 2, 'Double du 09/09', '75.00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230425133447', '2023-04-25 15:34:50', 813),
('DoctrineMigrations\\Version20230426105838', '2023-04-26 12:58:50', 63),
('DoctrineMigrations\\Version20230426120820', '2023-04-26 14:08:29', 17);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(1, 'En attente'),
(2, 'Valider');

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nom`, `adresse`, `cp`, `ville`, `tel`, `mail`) VALUES
(1, 'Ibis Styles', 'Centre Gare Beffroi', '59000\n', 'Lille', '484848498984', 'IbisStyles@gmail.com'),
(2, 'Ibis Budget', 'Centre', '59000\n', 'Lille', '58948988988', 'IbisBudget@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licencie_id` int(11) DEFAULT NULL,
  `loger_id` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5E90F6D6B56DCD74` (`licencie_id`),
  KEY `IDX_5E90F6D6838DE57B` (`loger_id`),
  KEY `IDX_5E90F6D6D5E86FF` (`etat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `licencie_id`, `loger_id`, `etat_id`, `date_inscription`) VALUES
(9, 5, 8, 1, '2023-04-26 14:02:00');

-- --------------------------------------------------------

--
-- Structure de la table `inscription_atelier`
--

DROP TABLE IF EXISTS `inscription_atelier`;
CREATE TABLE IF NOT EXISTS `inscription_atelier` (
  `inscription_id` int(11) NOT NULL,
  `atelier_id` int(11) NOT NULL,
  PRIMARY KEY (`inscription_id`,`atelier_id`),
  KEY `IDX_C86AEECF5DAC5993` (`inscription_id`),
  KEY `IDX_C86AEECF82E2CF35` (`atelier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription_atelier`
--

INSERT INTO `inscription_atelier` (`inscription_id`, `atelier_id`) VALUES
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5);

-- --------------------------------------------------------

--
-- Structure de la table `inscription_restauration`
--

DROP TABLE IF EXISTS `inscription_restauration`;
CREATE TABLE IF NOT EXISTS `inscription_restauration` (
  `inscription_id` int(11) NOT NULL,
  `restauration_id` int(11) NOT NULL,
  PRIMARY KEY (`inscription_id`,`restauration_id`),
  KEY `IDX_FAFBDB85DAC5993` (`inscription_id`),
  KEY `IDX_FAFBDB87C6CB929` (`restauration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription_restauration`
--

INSERT INTO `inscription_restauration` (`inscription_id`, `restauration_id`) VALUES
(9, 1),
(9, 2),
(9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `restauration`
--

DROP TABLE IF EXISTS `restauration`;
CREATE TABLE IF NOT EXISTS `restauration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_restauration` datetime NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restauration`
--

INSERT INTO `restauration` (`id`, `date_restauration`, `libelle`) VALUES
(1, '2023-09-08 12:00:00', 'Samedi : Midi'),
(2, '2023-09-08 18:00:00', 'Samedi : Soir'),
(3, '2023-09-09 12:00:00', 'Dimanche : Midi');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atelier_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9775E70882E2CF35` (`atelier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `atelier_id`, `libelle`) VALUES
(1, 1, 'Diagnostic et identification des criteres du club'),
(2, 1, 'Analyse systemique de l environnement et méthodologie de mise en oeuvre du projet'),
(3, 1, 'Actions solidaires et innovantes'),
(4, 1, 'Financements'),
(5, 1, 'Outils et documentation'),
(6, 1, 'Valoriser et communiquer sur le projet'),
(7, 2, 'Creation - Obligations legales'),
(8, 2, 'Gestion du personnel, de la structure et des conflits'),
(9, 2, 'Relations internes, externes et avec le Comite Départemental, la Ligue et la Federation'),
(10, 2, 'Conventions'),
(11, 2, 'Partenariats'),
(12, 2, 'Valoriser et communiquer sur le projet'),
(13, 3, 'Logiciel FFE de gestion des compétitions'),
(14, 3, 'Présentation du document l arbitrage en images'),
(15, 3, 'Plaquette guide projet du club'),
(16, 3, 'Labeliisation du club'),
(17, 3, 'Aménagements des équipements'),
(18, 3, 'Assurances'),
(19, 4, 'Obervations et analyses sur l encadrement actuel'),
(20, 4, 'Propositions de nouveaux schémas d organisation'),
(21, 4, 'Profils types et pratiques innovantes'),
(22, 4, 'Critères et seuils nécessaires à la pérennité de l emploi'),
(23, 4, 'Exercice du métier d enseignant (avantages et inconvenients)'),
(24, 5, 'Présentation'),
(25, 5, 'Fonctionnement'),
(26, 5, 'Objectifs'),
(27, 5, 'Nouveaux diplomes'),
(28, 5, 'Financements'),
(29, 6, 'Les enjeux climatiques, énergétiques et économiques'),
(30, 6, 'Sport et developpement durable'),
(31, 6, 'Demarche federale'),
(32, 6, 'Echange');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numlicence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isVerified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D6495DB85673` (`numlicence`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `numlicence`, `isVerified`) VALUES
(5, 'dylanesculier@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$tidD3UhA5rQwP1Ipr6p0rOOvNJ2mr6KnB546QtJ5l0DgCBMOaAx2y', '16360514319', 1),
(6, 'dylanesculier@gmail.com', '[\"ROLE_USER\"]', '$2y$13$zaydXClxMZcILsXAYOo6H.vMMyJngusMI6NVIn5fWsQBxn08VSu0W', '16511221359', 1),
(7, 'dylanesculier@gmail.com', '[\"ROLE_INSCRIT\"]', '$2y$13$vW4ohsxhpJGGreTGbSkgne46Xuj88FLRkBNGQEB4SBgfmhdNkiBFy', '16441002882', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vacation`
--

DROP TABLE IF EXISTS `vacation`;
CREATE TABLE IF NOT EXISTS `vacation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_heure_debut` datetime NOT NULL,
  `date_heure_fin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vacation`
--

INSERT INTO `vacation` (`id`, `date_heure_debut`, `date_heure_fin`) VALUES
(1, '2023-09-15 09:00:00', '2023-09-15 10:30:00'),
(2, '2023-09-15 11:00:00', '2023-09-15 12:30:00'),
(3, '2023-09-14 08:30:00', '2023-09-14 09:30:00'),
(4, '2023-09-14 11:00:00', '2023-09-14 12:30:00'),
(5, '2023-09-14 14:00:00', '2023-09-14 15:30:00'),
(6, '2023-09-14 16:00:00', '2023-09-14 17:30:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD CONSTRAINT `FK_E1BB182354DD8D72` FOREIGN KEY (`vacation_id`) REFERENCES `vacation` (`id`);

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `FK_C509E4FFD90EC3ED` FOREIGN KEY (`apartenir_id`) REFERENCES `hotel` (`id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_5E90F6D6838DE57B` FOREIGN KEY (`loger_id`) REFERENCES `chambre` (`id`),
  ADD CONSTRAINT `FK_5E90F6D6B56DCD74` FOREIGN KEY (`licencie_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5E90F6D6D5E86FF` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`);

--
-- Contraintes pour la table `inscription_atelier`
--
ALTER TABLE `inscription_atelier`
  ADD CONSTRAINT `FK_C86AEECF5DAC5993` FOREIGN KEY (`inscription_id`) REFERENCES `inscription` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C86AEECF82E2CF35` FOREIGN KEY (`atelier_id`) REFERENCES `atelier` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscription_restauration`
--
ALTER TABLE `inscription_restauration`
  ADD CONSTRAINT `FK_FAFBDB85DAC5993` FOREIGN KEY (`inscription_id`) REFERENCES `inscription` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FAFBDB87C6CB929` FOREIGN KEY (`restauration_id`) REFERENCES `restauration` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_9775E70882E2CF35` FOREIGN KEY (`atelier_id`) REFERENCES `atelier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
