-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 06 Mars 2018 à 23:13
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `worknshare`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `idBooking` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idOpenSpace` int(11) NOT NULL,
  `dateBookingStart` datetime NOT NULL,
  `dateRealBookingStart` datetime NOT NULL,
  `dateBookingEnd` datetime NOT NULL,
  `dateRealBookingEnd` datetime NOT NULL,
  `stateBooking` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `booking`
--

INSERT INTO `booking` (`idBooking`, `idUser`, `idOpenSpace`, `dateBookingStart`, `dateRealBookingStart`, `dateBookingEnd`, `dateRealBookingEnd`, `stateBooking`) VALUES
(1, 2, 3, '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', 1),
(2, 1, 2, '2018-02-20 15:00:00', '2018-02-20 15:00:00', '2018-02-20 15:00:00', '2018-02-20 15:00:00', 0),
(3, 3, 4, '2018-02-19 19:00:00', '2018-02-19 19:00:00', '2018-02-19 19:00:00', '2018-02-19 19:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `openspace`
--

CREATE TABLE `openspace` (
  `idOpenSpace` int(11) NOT NULL,
  `nameOpenSpace` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `openspace`
--

INSERT INTO `openspace` (`idOpenSpace`, `nameOpenSpace`) VALUES
(1, 'Bastille'),
(2, 'République'),
(3, 'Odéon'),
(4, 'PlaceItalie'),
(5, 'Ternes'),
(6, 'Beaubourg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nameUser` char(25) NOT NULL,
  `surnameUser` char(25) NOT NULL,
  `emailUser` varchar(50) NOT NULL,
  `subcription` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nameUser`, `surnameUser`, `emailUser`, `subcription`) VALUES
(1, 'jean', 'dupont', 'jdupont@gmail.com', 0),
(2, 'marie', 'lala', 'malal@gmail.com', 2),
(3, 'Paul', 'Lele', 'plele@live.fr', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idBooking`);

--
-- Index pour la table `openspace`
--
ALTER TABLE `openspace`
  ADD PRIMARY KEY (`idOpenSpace`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `idBooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `openspace`
--
ALTER TABLE `openspace`
  MODIFY `idOpenSpace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
