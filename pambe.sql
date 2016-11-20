-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 27 Octobre 2016 à 07:25
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pambe`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`) VALUES
(16),
(17),
(18);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL,
  `site_web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `site_web`) VALUES
(2, NULL),
(21, 'www.client2.com'),
(25, 'clie.com');

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `nb_annee_exp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94D4687F8545BDF5` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `domain`
--

DROP TABLE IF EXISTS `domain`;
CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `libel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A7A91E0B3DA5256D` (`image_id`),
  KEY `IDX_A7A91E0B12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `donate`
--

DROP TABLE IF EXISTS `donate`;
CREATE TABLE IF NOT EXISTS `donate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `datetime` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DDA20471A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `freelancer`
--

DROP TABLE IF EXISTS `freelancer`;
CREATE TABLE IF NOT EXISTS `freelancer` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `sexe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateDerniereMiseAJour` datetime NOT NULL,
  `dateValiditeEnchere` datetime DEFAULT NULL,
  `dateValiditePremium` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `freelancer`
--

INSERT INTO `freelancer` (`id`, `rating`, `sexe`, `dateDerniereMiseAJour`, `dateValiditeEnchere`, `dateValiditePremium`) VALUES
(13, 0, 'Homme', '0000-00-00 00:00:00', NULL, NULL),
(24, 0, 'Homme', '2016-10-17 11:55:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `freelancer_domain`
--

DROP TABLE IF EXISTS `freelancer_domain`;
CREATE TABLE IF NOT EXISTS `freelancer_domain` (
  `freelancer_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  PRIMARY KEY (`freelancer_id`,`domain_id`),
  KEY `IDX_1884A8928545BDF5` (`freelancer_id`),
  KEY `IDX_1884A892115F0EE5` (`domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `freelancer_langue`
--

DROP TABLE IF EXISTS `freelancer_langue`;
CREATE TABLE IF NOT EXISTS `freelancer_langue` (
  `freelancer_id` int(11) NOT NULL,
  `langue_id` int(11) NOT NULL,
  PRIMARY KEY (`freelancer_id`,`langue_id`),
  KEY `IDX_2C7AC3178545BDF5` (`freelancer_id`),
  KEY `IDX_2C7AC3172AADBACD` (`langue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `freelance_postule_mission`
--

DROP TABLE IF EXISTS `freelance_postule_mission`;
CREATE TABLE IF NOT EXISTS `freelance_postule_mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `dateValidation` datetime DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6020621FBE6CAE90` (`mission_id`),
  KEY `IDX_6020621F8545BDF5` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `name`, `path`, `updateAt`) VALUES
(2, ' ', '541909172b6d68ef75546330c3655b5b3e8eefce.jpeg', '2016-10-27 06:47:25'),
(5, 'userProfile', '05ab10a34d5e2a45c75d82bc3e8f2637991edd20.png', '2016-10-27 03:28:35'),
(6, 'userProfile', '0b4781348f7b49cb419cafc912913bf61c37fdb2.png', '2016-10-27 03:29:21'),
(7, 'userProfile', 'user.png', '2016-10-14 07:02:53'),
(10, 'userProfile', '3e56dbbb2d7c2f2296887a97ce31e984ca6e0803.jpeg', '2016-10-27 03:42:07'),
(13, 'userProfile', '75daee72181e46750fcaf3904fc6bd7118809a65.jpeg', '2016-10-27 03:54:54'),
(14, 'userProfile', '784c604aa5ed95f5a0a8a481609ef9dec61a8c06.jpeg', '2016-10-17 11:58:04'),
(16, 'userProfile', '2bf3b314e8db035e4ae4e08391100ccf97bb6643.jpeg', '2016-10-27 03:46:15');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

DROP TABLE IF EXISTS `mission`;
CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `budget` double DEFAULT NULL,
  `dateCreation` datetime NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `validate` tinyint(1) NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `open` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9067F23C19EB6921` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission_domain`
--

DROP TABLE IF EXISTS `mission_domain`;
CREATE TABLE IF NOT EXISTS `mission_domain` (
  `mission_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  PRIMARY KEY (`mission_id`,`domain_id`),
  KEY `IDX_FF51C445BE6CAE90` (`mission_id`),
  KEY `IDX_FF51C445115F0EE5` (`domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission_solicit_freelance`
--

DROP TABLE IF EXISTS `mission_solicit_freelance`;
CREATE TABLE IF NOT EXISTS `mission_solicit_freelance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `dateValidation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A54E7867BE6CAE90` (`mission_id`),
  KEY `IDX_A54E78678545BDF5` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `outil`
--

DROP TABLE IF EXISTS `outil`;
CREATE TABLE IF NOT EXISTS `outil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nivExpertise` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_22627A3E8545BDF5` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realization`
--

DROP TABLE IF EXISTS `realization`;
CREATE TABLE IF NOT EXISTS `realization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `libel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `freelancer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CDAA30C63DA5256D` (`image_id`),
  KEY `IDX_CDAA30C68545BDF5` (`freelancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E6BDCDF7A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `testimonial`
--

INSERT INTO `testimonial` (`id`, `content`, `datetime`, `user_id`) VALUES
(2, 'dfd\r\ndf\r\ndf\r\ndf\r\nd\r\nf', '2016-10-26 02:00:17', 17),
(3, 'Tks Pambé.cm', '2016-10-26 02:01:34', 18);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA1797792FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2DA17977A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_2DA17977C05FB297` (`confirmation_token`),
  UNIQUE KEY `UNIQ_2DA179773DA5256D` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nom`, `type`, `prenom`, `adresse`, `image_id`, `country`) VALUES
(2, 'client', 'client', 'client@yahoo.com', 'client@yahoo.com', 0, '946vqxdgu8kcoko0oscgk4coscccoko', '4ZfMcmHt5iMFk0kKIIf7v+gpgA8muutHNnm1v7AxO4npSFbDXEllEVKJM6M+2sOsavciQzIpCemz2YeOcxyY9Q==', '2016-10-13 03:17:25', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'client', 'client', NULL, NULL, 16, 'AR'),
(13, 'test', 'test', 'test@yahoo.com', 'test@yahoo.com', 0, 'bqxgh6ujvwo44k0cscks4o48k0o4sow', 'dfJICr3FLJpbeMURy5pCLxhobj8Ivm4nEWTRNDVF/SYr379Ws8Qd7jwjf6byAjQePE8njeq2QvbVAXw78a8Q1A==', '2016-10-14 06:40:07', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'test', 'freelancer', 'test', 'test', 2, 'BI'),
(16, 'Dariuso', 'dariuso', 'darius@yahoo.com', 'darius@yahoo.com', 0, '6gviywlhdyg4s8004kwkscksowwcccg', 'fzpqukyRwczNy2XCjmDVcgcj+C9DIvh/HcCt8tyGht+Dp00zsnXTfFOirW3KaRqdEFE1gF3kQxv7NTReR3ueww==', '2016-10-14 06:54:28', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'Darius', 'admin', 'TSAFACK', 'Pitoaré, Maroua', 5, 'CM'),
(17, 'Tegus', 'tegus', 'tegus@yahoo.com', 'tegus@yahoo.com', 1, '9qsdojopyggskcgw48ow88scgo8s8ok', 'PEcu01bod4PIZkeNnMq5OK97JtJe+Q8cvNAuru+e5pJpuWjKNzs0dezvtYVKeWbDEciv8ZRZV1gYSaVTwi9MmA==', '2016-10-27 05:29:54', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'tegus', 'admin', 'tegus', 'tegus', 6, 'CM'),
(18, 'admin', 'admin', 'admin@ws.cm', 'admin@ws.cm', 1, '6v6lpgvwmyw44wco4ck8sos0wokk8k4', '68Yb8LB05Fq/Il5x7VOMmOamLQMeHhHRPXwV07GY7ygcKeRXB0iXQ0IJt6oUnRb6e8iwqk2jKOc3GMPvXYsQiA==', '2016-10-26 02:01:11', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'admin', 'admin', 'admin', 'admin', 7, ''),
(21, 'client2', 'client2', 'client2@yahoo.com', 'client2@yahoo.com', 1, 'hkqp0aatyj48oows8s0ssk4sscc8kco', 'ZtohZGTZ5lc6y7PwBycjUtNGqgBgTawH+o1OiTDhwW7jZcsIQjIsglEIr32w9lIf34NAFOl+Op2PGG45qoQwLg==', '2016-10-15 06:39:45', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'client2', 'client', 'client2', 'client2', 10, 'DZ'),
(24, 'lancer', 'lancer', 'lancer@yahoo.com', 'lancer@yahoo.com', 1, '2uiq0m7t8ds0oc44go4k4ok004gw8k0', 't1I96mJQRNO8epqcL3caqj5MhUabXb4t4J6r8+nglpWmmmdq5UlGyAlk/xT17j0ppFXtk6ZKvF1+f/EvohZeIw==', '2016-10-17 11:55:28', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'lancer', 'freelancer', 'lancer', 'lancer', 13, 'CM'),
(25, 'clie', 'clie', 'clie@yahoo.com', 'clie@yahoo.com', 0, 'l47qtwzgt3444004cswc4g8gkss0c4s', 'Pbp4ZJUrv3ijrWfY8iIN2yAgW4FrWYcqebMGMMVesYOI2E1to6leCK2vTEoaKjsAE4egz1f5JB64MxDNXhte7Q==', '2016-10-17 11:58:04', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'clie', 'client', NULL, 'clie', 14, 'KH');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_49CF2272BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C0E80163BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `FK_94D4687F8545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`);

--
-- Contraintes pour la table `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `FK_A7A91E0B12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_A7A91E0B3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `donate`
--
ALTER TABLE `donate`
  ADD CONSTRAINT `FK_DDA20471A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `freelancer`
--
ALTER TABLE `freelancer`
  ADD CONSTRAINT `FK_373D238BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `freelancer_domain`
--
ALTER TABLE `freelancer_domain`
  ADD CONSTRAINT `FK_1884A892115F0EE5` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1884A8928545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `freelancer_langue`
--
ALTER TABLE `freelancer_langue`
  ADD CONSTRAINT `FK_2C7AC3172AADBACD` FOREIGN KEY (`langue_id`) REFERENCES `langue` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2C7AC3178545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `freelance_postule_mission`
--
ALTER TABLE `freelance_postule_mission`
  ADD CONSTRAINT `FK_6020621F8545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`),
  ADD CONSTRAINT `FK_6020621FBE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `FK_9067F23C19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `mission_domain`
--
ALTER TABLE `mission_domain`
  ADD CONSTRAINT `FK_FF51C445115F0EE5` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FF51C445BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mission_solicit_freelance`
--
ALTER TABLE `mission_solicit_freelance`
  ADD CONSTRAINT `FK_A54E78678545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`),
  ADD CONSTRAINT `FK_A54E7867BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);

--
-- Contraintes pour la table `outil`
--
ALTER TABLE `outil`
  ADD CONSTRAINT `FK_22627A3E8545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`);

--
-- Contraintes pour la table `realization`
--
ALTER TABLE `realization`
  ADD CONSTRAINT `FK_CDAA30C63DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_CDAA30C68545BDF5` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer` (`id`);

--
-- Contraintes pour la table `testimonial`
--
ALTER TABLE `testimonial`
  ADD CONSTRAINT `FK_E6BDCDF7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_2DA179773DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
