-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 12 déc. 2022 à 23:40
-- Version du serveur : 8.0.27
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myshop`
--
CREATE DATABASE IF NOT EXISTS `myshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `myshop`;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `naissance` date NOT NULL,
  `inscription` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `connecte`
--

DROP TABLE IF EXISTS `connecte`;
CREATE TABLE IF NOT EXISTS `connecte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `depuis` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_exp` int NOT NULL,
  `id_dest` int NOT NULL,
  `contenu` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fichier` varchar(90) DEFAULT NULL,
  `label_fichier` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lu` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_exp`, `id_dest`, `contenu`, `date_envoi`, `fichier`, `label_fichier`, `lu`) VALUES
(1, 1, 3, 'yo la big', '2022-12-10 00:52:54', '', '', 0),
(2, 3, 1, 'yep djanga xa dit kw?', '2022-12-10 00:54:45', '', '', 0),
(3, 1, 3, 'regarde par exemple', '2022-12-10 01:33:54', '', '', 0),
(4, 1, 3, 'et ici encore', '2022-12-10 01:34:07', '', '', 0),
(5, 3, 1, '&ccedil;a t\'a dos&eacute; hein mon petit', '2022-12-10 02:19:55', '', '', 0),
(6, 1, 3, 'yo', '2022-12-10 02:24:24', '', '', 0),
(7, 1, 2, 'yo man', '2022-12-12 18:27:38', '126397729a9b1d3.jpg', 'Maubeuge-ville-du-pere-noel-2019.jpg', 0),
(8, 1, 3, 'maffffff', '2022-12-12 23:00:42', '136397b29ad6860.png', 'png-clipart-christmas-tree-christmas-tree.pn', 0),
(9, 1, 2, 'yep bro xdk\r\ny\'a pas chilling ce week-end?', '2022-12-12 23:13:01', '126397b57da198c.jpg', 'a1.jp', 0),
(10, 2, 1, 'gars c\'est noel man', '2022-12-12 23:23:53', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `telephone` int NOT NULL,
  `email` varchar(45) NOT NULL,
  `pass` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `sm` varchar(20) NOT NULL,
  `photo` varchar(80) DEFAULT NULL,
  `inscription` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `nom`, `telephone`, `email`, `pass`, `adresse`, `genre`, `sm`, `photo`, `inscription`, `status`) VALUES
(1, 'Vadiny', 655394765, 'vadinyfotsing@gmail.com', 'fe4769e2d9945ae9dc96c397c194abf6cb464278', 'Snec EMIA', 'Homme', 'Celibataire', NULL, '2022-09-07 07:20:37.130000', 1),
(2, 'Franck', 324456334, 'franckfeuyan@yahoo.com', '6a5810b27035f980ef8adc0e8007b098fdd1d9d8', 'Namur, Belgique ', 'Homme', 'Celibataire', NULL, '2022-01-09 12:20:23.800010', 1),
(3, 'Raissa', 699327317, 'raissa@gmail.com', '4ca3a3e991a876b584451e387313f6330300506b', 'japon', 'Femme', 'Marié(e)', NULL, '2022-12-09 18:08:46.000000', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
