-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 avr. 2020 à 13:52
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ledauphine`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_link` varchar(250) DEFAULT NULL,
  `contenu` text NOT NULL,
  `titre` varchar(250) NOT NULL,
  `nom_prenom_utilisateur` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `annonce_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `image_link`, `contenu`, `titre`, `nom_prenom_utilisateur`) VALUES
(1, '5e8b33ccab456.png', 'Cet article à été rédigé par l\'admin du site il peut ajouter des utilisateur éditer et les supprimer et aussi il a accès au CRUD des annonces. login : admin password: admin', 'Article rédigé par l\'admin', 'admin'),
(2, '5e8b33d177ca8.png', 'Cet article a été rédigé par le journaliste il a juste les droits pour écrire modifier ou supprimé un article. login : journaliste password: journaliste', 'Le deuxième article a été rédigé par le journaliste', 'Journaliste');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utilisateur_id_uindex` (`id`),
  UNIQUE KEY `utilisateur_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `nom`, `prenom`, `password`) VALUES
(1, 'admin', 'Orhan', 'Akdag', '0d61130a6dd5eea85c2c5facfe1c15a7'),
(2, 'Journaliste', 'Jean', 'Pierre', '170b9dcf4a2946df4fdddaf2f387d990');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
