-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 27 Mars 2018 à 02:51
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
(3, 3, 4, '2018-02-19 19:00:00', '2018-02-19 19:00:00', '2018-02-19 19:00:00', '2018-02-19 19:00:00', 1),
(4, 2, 3, '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', 0),
(5, 1, 3, '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', 0),
(6, 3, 3, '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', 0);

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
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `idRoom` int(11) NOT NULL,
  `idOpenSpace` int(11) NOT NULL,
  `nameRoom` varchar(50) NOT NULL,
  `typeRoom` int(11) NOT NULL,
  `stateRoom` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `room`
--

INSERT INTO `room` (`idRoom`, `idOpenSpace`, `nameRoom`, `typeRoom`, `stateRoom`) VALUES
(1, 1, 'BASTR1', 1, 0),
(2, 1, 'BASTR2', 1, 0),
(3, 1, 'BASTA1', 2, 0),
(4, 1, 'BASTA2', 2, 0),
(5, 1, 'BASTA3', 2, 0),
(6, 1, 'BASTC1', 0, 0),
(7, 2, 'REPUR1', 1, 0),
(8, 2, 'REPUR2', 1, 0),
(9, 2, 'REPUR3', 1, 0),
(10, 2, 'REPUR4', 1, 0),
(11, 2, 'REPUR5', 1, 0),
(12, 2, 'REPUR6', 1, 0),
(13, 2, 'REPUR7', 1, 0),
(14, 2, 'REPUA1', 2, 0),
(15, 2, 'REPUA2', 2, 0),
(16, 2, 'REPUA3', 2, 0),
(17, 2, 'REPUA4', 2, 0),
(18, 2, 'REPUA5', 2, 0),
(19, 2, 'REPUC1', 0, 0),
(20, 2, 'REPUC2', 0, 0),
(21, 2, 'REPUC3', 0, 0),
(22, 2, 'REPUC4', 0, 0),
(23, 3, 'ODEOR1', 1, 0),
(24, 3, 'ODEOR2', 1, 0),
(25, 3, 'ODEOR3', 1, 0),
(26, 3, 'ODEOR4', 1, 0),
(27, 3, 'ODEOA1', 2, 0),
(28, 3, 'ODEOA2', 2, 0),
(29, 3, 'ODEOC1', 0, 0),
(30, 3, 'ODEOC2', 0, 0),
(31, 4, 'PLITR1', 1, 0),
(32, 4, 'PLITR2', 1, 0),
(33, 4, 'PLITR3', 1, 0),
(34, 4, 'PLITR4', 1, 0),
(35, 4, 'PLITR5', 1, 0),
(36, 4, 'PLITA1', 2, 0),
(37, 4, 'PLITA2', 2, 0),
(38, 4, 'PLITA3', 2, 0),
(39, 4, 'PLITA4', 2, 0),
(40, 4, 'PLITC1', 0, 0),
(41, 4, 'PLITC2', 0, 0),
(42, 4, 'PLITC3', 0, 0),
(43, 5, 'TERNR1', 1, 0),
(44, 5, 'TERNR2', 1, 0),
(45, 5, 'TERNR3', 1, 0),
(46, 5, 'TERNR4', 1, 0),
(47, 5, 'TERNR5', 1, 0),
(48, 5, 'TERNR6', 1, 0),
(49, 5, 'TERNR7', 1, 0),
(50, 5, 'TERNA1', 2, 0),
(51, 5, 'TERNA2', 2, 0),
(52, 5, 'TERNA3', 2, 0),
(53, 5, 'TERNA4', 2, 0),
(54, 5, 'TERNA5', 2, 0),
(55, 5, 'TERNC1', 0, 0),
(56, 5, 'TERNC2', 0, 0),
(57, 5, 'TERNC3', 0, 0),
(58, 5, 'TERNC4', 0, 0),
(59, 6, 'BEAUR1', 1, 0),
(60, 6, 'BEAUR2', 1, 0),
(61, 6, 'BEAUA1', 2, 0),
(62, 6, 'BEAUA2', 2, 0),
(63, 6, 'BEAUA3', 2, 0),
(64, 6, 'BEAUC1', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nameUser` char(25) NOT NULL,
  `surnameUser` char(25) NOT NULL,
  `emailUser` varchar(50) NOT NULL,
  `passwordUser` varchar(100) NOT NULL,
  `subscription` int(11) DEFAULT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT '0',
  `token` char(32) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nameUser`, `surnameUser`, `emailUser`, `passwordUser`, `subscription`, `isAdmin`, `token`, `isDeleted`) VALUES
(1, 'jean', 'dupont', 'jdupont@gmail.com', '', 0, 0, NULL, 1),
(2, 'marie', 'lala', 'malal@gmail.com', '', 2, 0, NULL, 1),
(3, 'Paul', 'Lele', 'plele@live.fr', '', 2, 0, NULL, 1),
(4, 'Bonjour', 'test', 'test@gmail.fr', 'caca', 0, 0, NULL, 1);

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
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`idRoom`);

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
  MODIFY `idBooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `openspace`
--
ALTER TABLE `openspace`
  MODIFY `idOpenSpace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `idRoom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
