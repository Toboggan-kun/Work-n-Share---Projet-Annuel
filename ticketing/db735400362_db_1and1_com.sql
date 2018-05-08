-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db735400362.db.1and1.com
-- Généré le :  Mer 09 Mai 2018 à 01:27
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db735400362`
--

-- --------------------------------------------------------

--
-- Structure de la table `hardware`
--

CREATE TABLE IF NOT EXISTS `hardware` (
  `id_hardware` int(11) NOT NULL AUTO_INCREMENT,
  `date_purchase` datetime DEFAULT NULL,
  `type` varchar(55) COLLATE latin1_general_ci NOT NULL,
  `serial_number` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `name` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  `assignment` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_hardware`),
  UNIQUE KEY `id_hardware` (`id_hardware`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `hardware`
--

INSERT INTO `hardware` (`id_hardware`, `date_purchase`, `type`, `serial_number`, `state`, `name`, `assignment`) VALUES
(1, '1997-12-07 00:00:00', 'Remi', '01', NULL, 'Kun', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `hardware2`
--

CREATE TABLE IF NOT EXISTS `hardware2` (
  `id_hardware` int(11) NOT NULL AUTO_INCREMENT,
  `date_purchase` datetime DEFAULT NULL,
  `serial_number` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `name` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  `assignment` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_hardware`),
  UNIQUE KEY `id_hardware` (`id_hardware`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `state_ticket_description`
--

CREATE TABLE IF NOT EXISTS `state_ticket_description` (
  `id_state_desc` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `date_post` datetime NOT NULL,
  `description` tinytext COLLATE latin1_general_ci NOT NULL,
  `author` varchar(55) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_state_desc`),
  UNIQUE KEY `id_state_desc` (`id_state_desc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `state_ticket_description`
--

INSERT INTO `state_ticket_description` (`id_state_desc`, `id_ticket`, `date_post`, `description`, `author`) VALUES
(1, 2, '2018-04-24 19:14:20', 'cccccccc', 'bbbbbb'),
(2, 3, '2018-04-24 19:22:01', 'cccccccc', 'bbbbbb'),
(3, 4, '2018-04-24 19:23:38', 'cccccccc', 'bbbbbb'),
(4, 1, '2018-04-24 23:11:55', 'yolo', 'moi'),
(5, 2, '2018-04-24 23:12:09', 'ici', 'ok'),
(6, 5, '2018-04-27 15:45:57', 'alalala', 'alalal');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_close` datetime DEFAULT NULL,
  `author` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  UNIQUE KEY `id_ticket` (`id_ticket`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `title`, `state`, `date_start`, `date_close`, `author`) VALUES
(1, 'gdtsgd', 3, '2018-04-24 18:23:46', '0000-00-00 00:00:00', 'hjgrh'),
(2, 'aaaaaa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'bbbbbb'),
(3, 'aaaaaa', 2, '2018-04-24 19:22:01', '0000-00-00 00:00:00', 'bbbbbb'),
(4, 'aaaaaa', 0, '2018-04-24 19:23:38', '0000-00-00 00:00:00', 'bbbbbb'),
(5, 'test', 0, '2018-04-27 15:45:57', '0000-00-00 00:00:00', 'alalal');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
