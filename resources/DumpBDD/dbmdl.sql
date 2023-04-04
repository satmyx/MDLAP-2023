--
-- Base de données : `dbmdl`
--

-- --------------------------------------------------------


--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nom`, `adresse`, `cp`, `ville`, `tel`, `mail`) VALUES
(1, 'Ibis', 'rue de la pomme', '83200', 'Toulon', '484848498984', 'toto@gmail.com'),
(2, 'Novotel', 'rue du pommier', '83200', 'Toulon', '58948988988', 'tata@gmail.com');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `hotel_id`, `libelle`, `tarif_nuites`) VALUES
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
-- Déchargement des données de la table `vacation`
--

INSERT INTO `vacation` (`id`, `date_heure_debut`, `date_heure_fin`) VALUES
(1, '2023-09-15 09:00:00', '2023-09-15 10:30:00'),
(2, '2023-09-15 11:00:00', '2023-09-15 12:30:00'),
(3, '2023-09-14 08:30:00', '2023-09-14 09:30:00'),
(4, '2023-09-14 11:00:00', '2023-09-14 12:30:00'),
(5, '2023-09-14 14:00:00', '2023-09-14 15:30:00'),
(6, '2023-09-14 16:00:00', '2023-09-14 17:30:00');

-- --------------------------------------------------------

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
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`id`, `theme_id`, `vacation_id`, `libelle`, `nb_places`) VALUES
(1, 1, 1, 'Le club et son projet', 10),
(2, 2, 2, 'Fonctionnement du club', 6),
(3, 3, 3, 'Les outils mis à disposition et remis aux clubs', 5),
(4, 4, 4, 'Observatoire des métiers', 50),
(5, 5, 5, 'IFFE', 12),
(6, 6, 6, 'Développement durable', 8);

COMMIT;
