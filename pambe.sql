-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Décembre 2016 à 06:57
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `libelle`, `description`) VALUES
(1, 'Informatique', 'Génie Informatique');

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
(25, 'clie.com'),
(28, 'donneuremail.com'),
(31, 'www.siteweb.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`id`, `libel`, `freelancer_id`, `nb_annee_exp`) VALUES
(18, 'ihyuiuiyiyiut', 30, 78);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `domain`
--

INSERT INTO `domain` (`id`, `image_id`, `libel`, `description`, `category_id`) VALUES
(1, 17, 'Développement', 'Développement d''application (Frontend et Backend)', 1),
(2, 18, 'Télécommunication', 'Télécommnunication', 1),
(3, 19, 'Réseau', 'Réseau d''entreprise', 1),
(4, 20, 'Analyse des SI', 'Analyse des SI', 1),
(5, 43, 'Administration de BD', 'Administration des BD', 1),
(6, 44, 'Cryptographie', 'Cryptographie', 1),
(7, 45, 'Maintenance', 'Maintenance', 1),
(8, 46, 'Infographie', 'Infographie', 1),
(9, 47, 'Sécrétariat Bureautique', 'Sécrétariat Bureautique', 1);

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
(24, 0, 'Homme', '2016-10-17 11:55:26', NULL, NULL),
(26, 0, 'Homme', '2016-11-25 09:12:36', NULL, NULL),
(27, 0, 'Homme', '2016-11-25 09:27:03', NULL, NULL),
(29, 0, 'Homme', '2016-11-25 09:33:04', NULL, NULL),
(30, 0, 'Homme', '2016-11-26 04:36:35', NULL, NULL);

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

--
-- Contenu de la table `freelancer_domain`
--

INSERT INTO `freelancer_domain` (`freelancer_id`, `domain_id`) VALUES
(30, 1),
(30, 4);

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

--
-- Contenu de la table `freelancer_langue`
--

INSERT INTO `freelancer_langue` (`freelancer_id`, `langue_id`) VALUES
(30, 1),
(30, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`id`, `libelle`) VALUES
(1, 'Français'),
(2, 'Anglais');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `name`, `path`, `updateAt`) VALUES
(2, ' ', '541909172b6d68ef75546330c3655b5b3e8eefce.jpeg', '2016-10-27 06:47:25'),
(5, 'userProfile', '05ab10a34d5e2a45c75d82bc3e8f2637991edd20.png', '2016-10-27 03:28:35'),
(6, 'userProfile', '0b4781348f7b49cb419cafc912913bf61c37fdb2.png', '2016-10-27 03:29:21'),
(7, 'userProfile', 'fileName', '2016-10-14 07:02:53'),
(10, 'userProfile', '3e56dbbb2d7c2f2296887a97ce31e984ca6e0803.jpeg', '2016-10-27 03:42:07'),
(13, 'userProfile', '75daee72181e46750fcaf3904fc6bd7118809a65.jpeg', '2016-10-27 03:54:54'),
(14, 'userProfile', '784c604aa5ed95f5a0a8a481609ef9dec61a8c06.jpeg', '2016-10-17 11:58:04'),
(16, 'userProfile', '2bf3b314e8db035e4ae4e08391100ccf97bb6643.jpeg', '2016-10-27 03:46:15'),
(17, 'media', '2d18e28eed761f1795f2994e498e70b9899c8ec5.jpeg', '2016-12-08 04:25:25'),
(18, 'media', 'b92c3343fe5607fd9cb26d649d8d11ce0cc48e8f.jpeg', '2016-11-26 15:14:04'),
(19, 'media', '4ffeae427a953a32d04980ee0206d8379cc7ecff.jpeg', '2016-11-26 15:15:03'),
(20, 'media', 'a4651f4452d5636672df117a7cb53b3226414825.png', '2016-12-08 04:21:08'),
(23, 'media', '197e013a199d50ad93613d86a9a41857d3a74b4b.jpeg', '2016-12-02 05:29:30'),
(24, 'media', '6639c26170f5462696b5a5f7f31d2ec342550f59.jpeg', '2016-12-03 05:46:32'),
(25, 'media', 'da0e3906ffa32a6d4653beb7499b21fcdbf7e18e.jpeg', '2016-12-03 05:46:58'),
(26, 'media', '005d26fbd326780e9e5efab7ee73e8956d536211.jpeg', '2016-12-03 05:50:47'),
(27, 'media', 'cbca7d2c68d8a4136bb18cd608bb142bf12db27f.jpeg', '2016-12-03 06:33:35'),
(28, 'media', '8608d7796a35abb252fd7c06691ef3a0e519d531.jpeg', '2016-12-03 12:38:01'),
(30, 'media', '36d3f81be4a98e9959bd588c52952924a5dbf4ff.jpeg', '2016-12-03 08:29:29'),
(31, 'media', '35dd642a03c6284f0788938fac42df46720b28b2.jpeg', '2016-12-03 12:56:42'),
(32, 'media', '32277aebd9644eef13d18045991e778b66eed57a.pdf', '2016-12-05 08:54:57'),
(35, 'media', '76e1eaa87d75528b0de3ce498960a6d7c678e3f4.pdf', '2016-12-07 03:05:36'),
(43, 'media', '53af8783d609b3d26e94c30d5443be7a7a1f5168.jpeg', '2016-12-08 04:21:32'),
(44, 'media', '47b73d6bf1f9ce5e512042405710bae987768614.jpeg', '2016-12-08 03:53:27'),
(45, 'media', 'e5061c4ceafc820cb48b99c76198ce29c4ab6cf1.jpeg', '2016-12-08 03:54:11'),
(46, 'media', 'ac72f8dc6543fc90aefe7dbc26a520db2efdb9c8.jpeg', '2016-12-08 03:54:56'),
(47, 'media', '9903656ae0c734f08fd30c9842e9ba1d898bb919.jpeg', '2016-12-08 03:55:44');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

DROP TABLE IF EXISTS `mission`;
CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `budget` double DEFAULT NULL,
  `dateCreation` datetime NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `validate` tinyint(1) NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `open` tinyint(1) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fichier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9067F23CF915CFE` (`fichier_id`),
  KEY `IDX_9067F23CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `mission`
--

INSERT INTO `mission` (`id`, `user_id`, `object`, `description`, `budget`, `dateCreation`, `start_date`, `validate`, `place`, `duration`, `open`, `country`, `fichier_id`) VALUES
(1, 31, 'Développement Site web', 'Application de gestion accadémique', 300000, '2016-12-05 08:54:55', '2017-02-05 00:00:00', 1, 'Yaoundé', 65, 1, 'CM', 32),
(4, 31, 'sdkfk', 'dfjskjdfk', 100000, '2016-12-05 10:20:58', '2016-12-05 10:19:00', 1, 'Baham', 89, 1, 'CM', 35);

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

--
-- Contenu de la table `mission_domain`
--

INSERT INTO `mission_domain` (`mission_id`, `domain_id`) VALUES
(1, 1),
(4, 1),
(4, 2),
(4, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `outil`
--

INSERT INTO `outil` (`id`, `freelancer_id`, `libelle`, `nivExpertise`) VALUES
(2, 30, 'Microsoft Word 2013', 3),
(5, 30, 'Photoshop', 4),
(7, 30, 'a', 1),
(8, 30, 'sdfds', 2),
(9, 30, 'Microsoft Excel', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `realization`
--

INSERT INTO `realization` (`id`, `image_id`, `libel`, `description`, `url`, `freelancer_id`) VALUES
(1, 23, 'Siteweb', 'Siteweb', 'www.siteweb.com', 30),
(4, 30, 'Code Source', 'Code Source', 'www.siteweb.com', 30);

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
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`, `type`, `prenom`, `adresse`, `image_id`, `country`) VALUES
(2, 'client', 'client', 'client@yahoo.com', 'client@yahoo.com', 0, '946vqxdgu8kcoko0oscgk4coscccoko', '4ZfMcmHt5iMFk0kKIIf7v+gpgA8muutHNnm1v7AxO4npSFbDXEllEVKJM6M+2sOsavciQzIpCemz2YeOcxyY9Q==', '2016-10-13 03:17:25', NULL, NULL, 'a:0:{}', 'client', 'client', NULL, NULL, 16, 'AR'),
(13, 'test', 'test', 'test@yahoo.com', 'test@yahoo.com', 0, 'bqxgh6ujvwo44k0cscks4o48k0o4sow', 'dfJICr3FLJpbeMURy5pCLxhobj8Ivm4nEWTRNDVF/SYr379Ws8Qd7jwjf6byAjQePE8njeq2QvbVAXw78a8Q1A==', '2016-10-14 06:40:07', NULL, NULL, 'a:0:{}', 'test', 'freelancer', 'test', 'test', 2, 'BI'),
(16, 'Dariuso', 'dariuso', 'darius@yahoo.com', 'darius@yahoo.com', 0, '6gviywlhdyg4s8004kwkscksowwcccg', 'fzpqukyRwczNy2XCjmDVcgcj+C9DIvh/HcCt8tyGht+Dp00zsnXTfFOirW3KaRqdEFE1gF3kQxv7NTReR3ueww==', '2016-10-14 06:54:28', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'Darius', 'admin', 'TSAFACK', 'Pitoaré, Maroua', 5, 'CM'),
(17, 'Tegus', 'tegus', 'tegus@yahoo.com', 'tegus@yahoo.com', 1, '9qsdojopyggskcgw48ow88scgo8s8ok', 'PEcu01bod4PIZkeNnMq5OK97JtJe+Q8cvNAuru+e5pJpuWjKNzs0dezvtYVKeWbDEciv8ZRZV1gYSaVTwi9MmA==', '2016-12-08 03:33:38', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'TEGUIA', 'admin', 'Aurélien', 'tegus', 6, 'CM'),
(18, 'admin', 'admin', 'admin@ws.cm', 'admin@ws.cm', 1, '6v6lpgvwmyw44wco4ck8sos0wokk8k4', '68Yb8LB05Fq/Il5x7VOMmOamLQMeHhHRPXwV07GY7ygcKeRXB0iXQ0IJt6oUnRb6e8iwqk2jKOc3GMPvXYsQiA==', '2016-10-26 02:01:11', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'admin', 'admin', 'admin', 'admin', 7, ''),
(21, 'client2', 'client2', 'client2@yahoo.com', 'client2@yahoo.com', 1, 'hkqp0aatyj48oows8s0ssk4sscc8kco', 'ZtohZGTZ5lc6y7PwBycjUtNGqgBgTawH+o1OiTDhwW7jZcsIQjIsglEIr32w9lIf34NAFOl+Op2PGG45qoQwLg==', '2016-10-15 06:39:45', NULL, NULL, 'a:0:{}', 'client2', 'client', 'client2', 'client2', 10, 'DZ'),
(24, 'lancer', 'lancer', 'lancer@yahoo.com', 'lancer@yahoo.com', 1, '2uiq0m7t8ds0oc44go4k4ok004gw8k0', 't1I96mJQRNO8epqcL3caqj5MhUabXb4t4J6r8+nglpWmmmdq5UlGyAlk/xT17j0ppFXtk6ZKvF1+f/EvohZeIw==', '2016-10-17 11:55:28', NULL, NULL, 'a:0:{}', 'lancer', 'freelancer', 'lancer', 'lancer', 13, 'CM'),
(25, 'clie', 'clie', 'clie@yahoo.com', 'clie@yahoo.com', 0, 'l47qtwzgt3444004cswc4g8gkss0c4s', 'Pbp4ZJUrv3ijrWfY8iIN2yAgW4FrWYcqebMGMMVesYOI2E1to6leCK2vTEoaKjsAE4egz1f5JB64MxDNXhte7Q==', '2016-10-17 11:58:04', NULL, NULL, 'a:0:{}', 'clie', 'client', NULL, 'clie', 14, 'KH'),
(26, 'emailfree', 'emailfree', 'emailfree@yahoo.com', 'emailfree@yahoo.com', 1, 'i22oc1yjrg8wc0kg0s8kgs84okw04c0', 'h5JIAsQD7DIJZSICSH5/PzM0AAhnapzuFeKegqKkQ6KTbQ/paveIDatKEqRWcJNgYqncd+kI5tlb8YMm9ysFeg==', '2016-11-25 09:12:44', NULL, NULL, 'a:1:{i:0;s:14:"ROLE_FREELANCE";}', 'emailfree', 'freelancer', 'emailfree', 'emailfree', NULL, 'AL'),
(27, 'userfreelance', 'userfreelance', 'userfreelance@yahoo.com', 'userfreelance@yahoo.com', 1, 'og78ksvcy9wkow08488oskg8o00oo44', '1TR+SbFB9AqoMbqW2dX7QsCrz8QTG9j1xOln8MXyyDQS6mZ+mQYV+Pfa8413l0R1o5dB/nY1Gdm00RAPSQ5snA==', '2016-11-25 09:27:05', NULL, NULL, 'a:1:{i:0;s:14:"ROLE_FREELANCE";}', 'userfreelance', 'freelancer', 'userfreelance', 'userfreelance', NULL, 'KH'),
(28, 'donneuremail', 'donneuremail', 'donneuremail@yahoo.com', 'donneuremail@yahoo.com', 1, '53h4h69akf8k084o84wgcc4ggkscsgg', 'UU2b5FbKhzp9LBSj5L9lCuBlh27mRq7qYwvpxjaSNQ9ovlk1g2zJBgeeiQQgiNgZe7rkQbquUOUhydcewAGpHw==', '2016-11-25 09:28:18', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_CLIENT";}', 'donneuremail', 'client', 'donneuremail', 'donneuremail', NULL, 'KH'),
(29, 'Patrice', 'patrice', 'patriceebonki@yahoo.com', 'patriceebonki@yahoo.com', 1, 'o27hlvc27q8g4o4cw8gokosgs8c0cs0', 'YTpvnwJK+5Ia0RAzatkyXN0Ayfbjzy5azfy6sKKmKbd0wvl96Pm0i4hhS3N1zfd1pgrM0cDtzmR2O6js14jLNA==', '2016-11-25 09:33:05', NULL, NULL, 'a:1:{i:0;s:14:"ROLE_FREELANCE";}', 'EBONKI', 'freelancer', 'Patrice', 'Pitoaré, Maroua', NULL, 'CM'),
(30, 'Bekeur', 'bekeur', 'ricardokono@gmail.com', 'ricardokono@gmail.com', 1, '7e5fyvnw2js4s00kk8ow4k4ss8s0s4c', '9ylQxxxztYiW4JZSyjuHb3UgAK5zT/kicy4BiGPEJot72S7f+njz01bc3lGRPZKCv5mqo8BWe+8VUHLdjqVbCA==', '2016-12-03 12:37:24', NULL, NULL, 'a:1:{i:0;s:14:"ROLE_FREELANCE";}', 'KONO', 'freelancer', 'Ricardo', 'Ange Raphael, Douala', 28, 'CM'),
(31, 'mokai', 'mokai', 'mokaidoumtsop@yahoo.com', 'mokaidoumtsop@yahoo.com', 1, '10jfW6uKmbJwi5dYDBn83QDnugCXs8BJdDQ8qy.rnu8', 'dED4EwNwRwd2IGnXqXQR+c8764X5vBH6nFFlLopyYluunu4jeN4UiCUTZ/kUX24cqVkkELG5d+LCYk2tcHpdTg==', '2016-12-08 03:05:19', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_CLIENT";}', 'DOUMTSOP MELI', 'client', 'Franck Walter', 'Pitoaré, Maroua', 31, 'CM');

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
  ADD CONSTRAINT `FK_9067F23CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9067F23CF915CFE` FOREIGN KEY (`fichier_id`) REFERENCES `media` (`id`);

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
