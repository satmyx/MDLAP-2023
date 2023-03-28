-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 mars 2023 à 19:38
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
  `thematique_id` int(11) DEFAULT NULL,
  `vacation_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbplaces` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1BB1823476556AF` (`thematique_id`),
  KEY `IDX_E1BB182354DD8D72` (`vacation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`id`, `thematique_id`, `vacation_id`, `libelle`, `nbplaces`) VALUES
(1, 1, 1, 'Le club et son projet', 10),
(2, 2, 2, 'Fonctionnement du club', 6),
(3, 3, 3, 'Les outils mis à disposition et remis aux clubs', 5),
(4, 4, 4, 'Observatoire des métiers', 50),
(5, 5, 5, 'IFFE', 12),
(6, 6, 6, 'Développement durable', 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `apartenir_id`, `libelle`, `tarifs_nuites`) VALUES
(1, 1, 'Single du 13 au 14/09', '61.20'),
(2, 1, 'Twin du 13 au 14/09', '62.20'),
(3, 2, 'Single du 13 au 14/09', '112.00'),
(4, 2, 'Double du 13 au 14/09', '122.00'),
(5, 1, 'Single du 14 au 15/09', '61.20'),
(6, 1, 'Twin du 14 au 15/09', '62.20'),
(7, 2, 'Single du 14 au 15/09', '112.00'),
(8, 2, 'Double du 14 au 15/09', '122.00');

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
('DoctrineMigrations\\Version20230321151048', '2023-03-25 12:43:01', 546);

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
(1, 'Ibis', 'rue de la pomme', '83200', 'Toulon', '484848498984', 'toto@gmail.com'),
(2, 'Novotel', 'rue du pommier', '83200', 'Toulon', '58948988988', 'tata@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licencie_id` int(11) DEFAULT NULL,
  `loger_id` int(11) DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5E90F6D6B56DCD74` (`licencie_id`),
  KEY `IDX_5E90F6D6838DE57B` (`loger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `libelle`) VALUES
(1, 'Le club et son projet'),
(2, 'Fonctionnement du club'),
(3, 'Les outils à disposition et remis aux clubs'),
(4, 'Observatoire des métiers'),
(5, 'IFFE'),
(6, 'Développement durable');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD CONSTRAINT `FK_E1BB1823476556AF` FOREIGN KEY (`thematique_id`) REFERENCES `theme` (`id`),
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
  ADD CONSTRAINT `FK_5E90F6D6B56DCD74` FOREIGN KEY (`licencie_id`) REFERENCES `user` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
