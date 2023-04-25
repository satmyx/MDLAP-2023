INSERT INTO `vacation` (`id`, `date_heure_debut`, `date_heure_fin`) VALUES
(1, '2023-09-15 09:00:00', '2023-09-15 10:30:00'),
(2, '2023-09-15 11:00:00', '2023-09-15 12:30:00'),
(3, '2023-09-14 08:30:00', '2023-09-14 09:30:00'),
(4, '2023-09-14 11:00:00', '2023-09-14 12:30:00'),
(5, '2023-09-14 14:00:00', '2023-09-14 15:30:00'),
(6, '2023-09-14 16:00:00', '2023-09-14 17:30:00');

INSERT INTO `atelier` (`id`, `vacation_id`, `libelle`, `nb_places`) VALUES
(1, 1, 'Le club et son projet', 10),
(2, 2, 'Fonctionnement du club', 6),
(3, 3, 'Les outils mis à disposition et remis aux clubs', 5),
(4, 4, 'Observatoire des métiers', 50),
(5, 5, 'IFFE', 12),
(6, 6, 'Développement durable', 8);

INSERT INTO `theme` (`id`, `libelle`,`atelier_id`) VALUES
(1, 'Diagnostic et identification des criteres du club', 1),
(2, 'Analyse systemique de l environnement et méthodologie de mise en oeuvre du projet', 1),
(3, 'Actions solidaires et innovantes',1),
(4, 'Financements',1),
(5, 'Outils et documentation',1),
(6, 'Valoriser et communiquer sur le projet',1),

(7, 'Creation - Obligations legales', 2),
(8, 'Gestion du personnel, de la structure et des conflits', 2),
(9, 'Relations internes, externes et avec le Comite Départemental, la Ligue et la Federation',2),
(10, 'Conventions',2),
(11, 'Partenariats',2),
(12, 'Valoriser et communiquer sur le projet',2),

(13, 'Logiciel FFE de gestion des compétitions', 3),
(14, 'Présentation du document l arbitrage en images', 3),
(15, 'Plaquette guide projet du club',3),
(16, 'Labeliisation du club',3),
(17, 'Aménagements des équipements',3),
(18, 'Assurances',3),

(19, 'Obervations et analyses sur l encadrement actuel', 4),
(20, 'Propositions de nouveaux schémas d organisation', 4),
(21, 'Profils types et pratiques innovantes',4),
(22, 'Critères et seuils nécessaires à la pérennité de l emploi',4),
(23, 'Exercice du métier d enseignant (avantages et inconvenients)',4),

(24, 'Présentation', 5),
(25, 'Fonctionnement', 5),
(26, 'Objectifs',5),
(27, 'Nouveaux diplomes',5),
(28, 'Financements',5),

(29, 'Les enjeux climatiques, énergétiques et économiques', 6),
(30, 'Sport et developpement durable', 6),
(31, 'Demarche federale',6),
(32, 'Echange',6);

INSERT INTO `hotel` (`id`, `nom`, `adresse`, `cp`, `ville`, `tel`, `mail`) VALUES
(1, 'Ibis', 'rue de la pomme', '83200', 'Toulon', '484848498984', 'toto@gmail.com'),
(2, 'Novotel', 'rue du pommier', '83200', 'Toulon', '58948988988', 'tata@gmail.com');

INSERT INTO `chambre` (`id`, `apartenir_id`, `libelle`, `tarifs_nuites`) VALUES
(1, 1, 'Single du 13 au 14/09', '61.20'),
(2, 1, 'Twin du 13 au 14/09', '62.20'),
(3, 2, 'Single du 13 au 14/09', '112.00'),
(4, 2, 'Double du 13 au 14/09', '122.00'),
(5, 1, 'Single du 14 au 15/09', '61.20'),
(6, 1, 'Twin du 14 au 15/09', '62.20'),
(7, 2, 'Single du 14 au 15/09', '112.00'),
(8, 2, 'Double du 14 au 15/09', '122.00');

INSERT INTO `restauration` (`id`, `date_restauration`, `libelle`) VALUES
(1, '2023-04-01 14:54:19', 'Samedi : Dîner'),
(2, '2023-04-09 14:54:19', 'Samedi : Déjeuner'),
(3, '2023-04-09 14:54:19', 'Dimanche : Déjeuner');

INSERT INTO `etat` (`id`, `libelle`) VALUES (1, 'En attente'), (2, 'Valider');

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `numlicence`, `isVerified`) VALUES
(1, 'dylanesculier@gmail.com', '[]', '$2y$13$jwXr6eIXREcdL7KMsW31ru/jCbmQn4KbmFI6sYdZNCraQyQAI7tcC', '16360514319', 1);