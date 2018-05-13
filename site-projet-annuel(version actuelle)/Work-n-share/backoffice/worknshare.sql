-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 08 Mai 2018 à 14:10
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
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `idAddress` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(5) NOT NULL,
  `city` varchar(50) NOT NULL,
  `idEvent` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idOpenSpace` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `idBooking` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idRoom` int(11) NOT NULL,
  `dateBookingStart` timestamp NOT NULL,
  `dateRealBookingStart` timestamp NULL DEFAULT NULL,
  `dateBookingEnd` timestamp NOT NULL,
  `dateRealBookingEnd` timestamp NULL DEFAULT NULL,
  `stateBooking` int(11) DEFAULT NULL,
  `qtyEquipment1` int(11) DEFAULT NULL,
  `qtyEquipment2` int(11) DEFAULT NULL,
  `qtyMenu` int(11) DEFAULT NULL,
  `bookingCode` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `booking`
--

INSERT INTO `booking` (`idBooking`, `idUser`, `idRoom`, `dateBookingStart`, `dateRealBookingStart`, `dateBookingEnd`, `dateRealBookingEnd`, `stateBooking`, `qtyEquipment1`, `qtyEquipment2`, `qtyMenu`, `bookingCode`) VALUES
(1, 0, 0, '2018-02-19 17:00:00', '2018-02-19 17:00:00', '2018-02-19 17:00:00', '2018-02-19 17:00:00', 1, NULL, NULL, NULL, ''),
(2, 0, 0, '2018-02-20 14:00:00', '2018-02-20 14:00:00', '2018-02-20 14:00:00', '2018-02-20 14:00:00', 0, NULL, NULL, NULL, ''),
(3, 0, 0, '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', '2018-02-19 18:00:00', 1, NULL, NULL, NULL, ''),
(4, 0, 0, '2018-02-19 17:00:00', '2018-02-19 17:00:00', '2018-02-19 17:00:00', '2018-02-19 17:00:00', 0, NULL, NULL, NULL, ''),
(6, 0, 0, '2018-02-19 17:00:00', '2018-02-19 17:00:00', '2018-02-19 17:00:00', '2018-02-19 17:00:00', 0, NULL, NULL, NULL, ''),
(7, 1, 1, '2018-07-31 22:00:00', NULL, '2018-08-01 22:00:00', NULL, NULL, NULL, NULL, NULL, ''),
(8, 1, 1, '2018-08-01 07:00:00', NULL, '2018-08-01 16:00:00', NULL, NULL, NULL, NULL, NULL, ''),
(9, 1, 1, '2018-02-02 08:00:00', NULL, '2018-02-02 17:00:00', NULL, NULL, 0, 0, 0, ''),
(10, 1, 1, '2018-02-02 08:00:00', NULL, '2018-02-02 17:00:00', NULL, NULL, 11, 10, 10, ''),
(11, 1, 3, '2018-05-15 09:00:00', NULL, '2018-05-15 14:00:00', NULL, NULL, 0, 0, 0, ''),
(37, 1, 14, '2018-05-08 09:00:00', NULL, '2018-05-08 17:00:00', NULL, NULL, NULL, NULL, NULL, '1234567899');

-- --------------------------------------------------------

--
-- Structure de la table `equipments`
--

CREATE TABLE `equipments` (
  `idEquipment` int(11) NOT NULL,
  `nameEquipment` varchar(50) NOT NULL,
  `stateEquipment` int(11) NOT NULL DEFAULT '1',
  `typeEquipment` varchar(50) NOT NULL,
  `idOpenSpace` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipments`
--

INSERT INTO `equipments` (`idEquipment`, `nameEquipment`, `stateEquipment`, `typeEquipment`, `idOpenSpace`) VALUES
(5, 'MAC11', 1, 'Ordinateur', 1),
(6, 'HP1', 1, 'Imprimante', 2),
(13, 'EXPRESSO', 1, 'Machine Ã  cafÃ©', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `idEvent` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `dateCreationEvent` varchar(10) NOT NULL,
  `dateEvent` varchar(10) NOT NULL,
  `hourEvent` time NOT NULL,
  `descriptionEvent` varchar(255) NOT NULL,
  `addressEvent` varchar(100) DEFAULT NULL,
  `postalCodeEvent` int(5) DEFAULT NULL,
  `cityEvent` varchar(20) DEFAULT NULL,
  `idOpenSpace` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idEvent`, `title`, `dateCreationEvent`, `dateEvent`, `hourEvent`, `descriptionEvent`, `addressEvent`, `postalCodeEvent`, `cityEvent`, `idOpenSpace`) VALUES
(20, 'SoirÃ©e 1', '02-04-2018', '05-09-2018', '11:00:00', 'Tenue libre', '', 0, '', NULL),
(72, 'Arrayeventarrayevent', '28-04-2018', '2018-04-29', '10:10:00', '10arrayeventarrayevent', 'Arrayevent', 93939, 'Arrayevent', NULL),
(91, 'Reunion', '29-04-2018', '2018-07-01', '10:00:00', 'Test de description', NULL, NULL, NULL, NULL),
(98, 'Diffusion de films', '29-04-2018', '30-04-2018', '12:00:00', 'Liste des films ã  demander', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(11) NOT NULL,
  `nameMenu` varchar(25) NOT NULL,
  `starter` varchar(50) NOT NULL,
  `dish` varchar(50) NOT NULL,
  `dessert` varchar(50) NOT NULL,
  `quantityMenu` int(11) NOT NULL DEFAULT '0',
  `descriptionMenu` varchar(100) DEFAULT NULL,
  `stateMenu` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`idMenu`, `nameMenu`, `starter`, `dish`, `dessert`, `quantityMenu`, `descriptionMenu`, `stateMenu`) VALUES
(106, 'lok-lak  ', 'oeuf  ', 'lok lak sup oeuf', 'flan Ã  l\'oeuf', 99, NULL, 1),
(103, 'MenuA-2', 'Salade verte', 'Cordon bleu', 'Tarte au chocolat', 30, NULL, 0),
(102, 'MenuA-1', 'Salade de pomme de terre', 'Soupe de poireaux', 'Yahourt blanc', 100, NULL, 0),
(101, 'Menu enfant', 'Salade de choux', 'Cordon bleu', 'Dessert douteux', 50, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `openspace`
--

CREATE TABLE `openspace` (
  `idOpenSpace` int(11) NOT NULL,
  `nameOpenSpace` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `room`
--

INSERT INTO `room` (`idRoom`, `idOpenSpace`, `nameRoom`, `typeRoom`, `stateRoom`) VALUES
(4, 1, 'BASTA2', 0, 2),
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
(28, 3, 'ODEOA2', 2, 0),
(29, 3, 'ODEOC1', 0, 0),
(30, 3, 'ODEOC2', 0, 0),
(31, 4, 'PLITR1', 1, 0),
(32, 4, 'PLITR2', 1, 2),
(33, 4, 'PLITR3', 1, 2),
(34, 4, 'PLITR4', 1, 0),
(35, 4, 'PLITR5', 1, 0),
(36, 4, 'PLITA1', 2, 0),
(37, 4, 'PLITA2', 2, 0),
(38, 4, 'PLITA3', 2, 0),
(39, 4, 'PLITA4', 2, 0),
(40, 4, 'PLITC1', 0, 0),
(41, 4, 'PLITC2', 0, 2),
(42, 4, 'PLITC3', 0, 0),
(43, 5, 'TERNR1', 1, 2),
(44, 5, 'TERNR2', 1, 0),
(45, 5, 'TERNR3', 1, 2),
(46, 5, 'TERNR4', 1, 2),
(47, 5, 'TERNR5', 1, 2),
(48, 5, 'TERNR6', 1, 2),
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
(64, 6, 'BEAUC1', 0, 0),
(81, 3, 'PLITC3', 0, 0),
(82, 3, 'PLITC33', 0, 0),
(83, 3, 'PLITC3', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

CREATE TABLE `schedule` (
  `idSchedule` int(11) NOT NULL,
  `openHour` time NOT NULL,
  `closeHour` time NOT NULL,
  `day` int(11) NOT NULL,
  `idOpenSpace` int(11) DEFAULT NULL,
  `isClosed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `schedule`
--

INSERT INTO `schedule` (`idSchedule`, `openHour`, `closeHour`, `day`, `idOpenSpace`, `isClosed`) VALUES
(1, '09:00:00', '20:00:00', 1, 1, 0),
(2, '09:00:00', '20:00:00', 2, 1, 0),
(3, '09:00:00', '20:00:00', 3, 1, 0),
(4, '09:00:00', '20:00:00', 4, 1, 0),
(5, '09:00:00', '20:00:00', 5, 1, 0),
(6, '11:00:00', '20:00:00', 6, 1, 0),
(7, '11:00:00', '20:00:00', 7, 1, 0),
(8, '09:00:00', '21:00:00', 1, 2, 0),
(9, '11:00:00', '21:00:00', 2, 2, 0),
(10, '11:00:00', '21:00:00', 3, 2, 0),
(11, '11:00:00', '21:00:00', 4, 2, 0),
(12, '11:00:00', '21:00:00', 5, 2, 0),
(13, '11:00:00', '21:00:00', 6, 2, 0),
(14, '11:00:00', '21:00:00', 7, 2, 0),
(15, '09:00:00', '20:00:00', 1, 3, 0),
(16, '09:00:00', '20:00:00', 2, 3, 0),
(17, '09:00:00', '20:00:00', 3, 3, 0),
(18, '09:00:00', '20:00:00', 4, 3, 0),
(19, '09:00:00', '20:00:00', 5, 3, 0),
(20, '11:00:00', '20:00:00', 6, 3, 0),
(21, '11:00:00', '20:00:00', 7, 3, 0),
(22, '09:00:00', '20:00:00', 1, 4, 0),
(23, '09:00:00', '20:00:00', 2, 4, 0),
(24, '09:00:00', '20:00:00', 3, 4, 0),
(25, '09:00:00', '20:00:00', 4, 4, 0),
(26, '09:00:00', '20:00:00', 5, 4, 0),
(27, '11:00:00', '20:00:00', 6, 4, 0),
(28, '11:00:00', '20:00:00', 7, 4, 0),
(29, '08:00:00', '21:00:00', 1, 5, 0),
(30, '08:00:00', '21:00:00', 2, 5, 0),
(31, '08:00:00', '21:00:00', 3, 5, 0),
(32, '08:00:00', '21:00:00', 4, 5, 0),
(33, '09:00:00', '23:00:00', 5, 5, 0),
(34, '09:00:00', '20:00:00', 6, 5, 0),
(35, '09:00:00', '20:00:00', 7, 5, 0),
(36, '09:00:00', '20:00:00', 1, 6, 0),
(37, '09:00:00', '20:00:00', 2, 6, 0),
(38, '09:00:00', '20:00:00', 3, 6, 0),
(39, '09:00:00', '20:00:00', 4, 6, 0),
(40, '09:00:00', '20:00:00', 5, 6, 0),
(41, '11:00:00', '20:00:00', 6, 6, 0),
(42, '11:00:00', '20:00:00', 7, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `idStaff` int(11) NOT NULL,
  `nameStaff` varchar(50) NOT NULL,
  `surnameStaff` varchar(50) NOT NULL,
  `mailStaff` varchar(100) NOT NULL,
  `birthdayStaff` date NOT NULL,
  `phoneStaff` char(10) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `token` char(60) DEFAULT NULL,
  `idOpenSpace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `phoneUser` int(10) DEFAULT NULL,
  `addressUser` varchar(100) NOT NULL,
  `postalCodeUser` int(5) NOT NULL,
  `cityUser` varchar(50) NOT NULL,
  `subscriptionDate` varchar(10) NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT '0',
  `token` char(32) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nameUser`, `surnameUser`, `emailUser`, `passwordUser`, `subscription`, `phoneUser`, `addressUser`, `postalCodeUser`, `cityUser`, `subscriptionDate`, `isAdmin`, `token`, `isDeleted`) VALUES
(1, 'jean', 'dupont', 'jdupont@gmail.com', '', 0, NULL, '', 0, '', '', 0, NULL, 0),
(2, 'marie', 'lala', 'malal@gmail.com', '', 2, NULL, '', 0, '', '', 0, NULL, 0),
(3, 'Paul', 'Lele', 'plele@live.fr', '', 2, NULL, '', 0, '', '', 0, NULL, 0),
(4, 'Bonjour', 'test', 'test@gmail.fr', 'caca', 0, NULL, '', 0, '', '', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `hash`, `active`) VALUES
(4, 'Noha', 'Abdelmalki', 'nohabdelmalki1@gmail.com', '$2y$10$6FKqYugxCIAkVIOOqxKjHOxt6yckIuXONlmsmyWMLiodgFnGaAy5.', '55743cc0393b1cb4b8b37d09ae48d097', 0),
(5, 'Caroline', 'Tang', 'carolinetangsong@gmail.com', '$2y$10$HsauiJKMmZVWqwChEfYcbuhI/MQKo2brc0kHq8epAcyNbKL5ByUgi', '5ef698cd9fe650923ea331c15af3b160', 0),
(6, 'test', 'nom', 'test@gmail.com', '$2y$10$4OI1tytz24P71SH/wX96aeSdtf1A/.UTe2xOX6r6s4D7gy7ITCbH.', 'afda332245e2af431fb7b672a68b659d', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idBooking`);

--
-- Index pour la table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`idEquipment`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idEvent`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`);

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
-- Index pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`idSchedule`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `idBooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `idEquipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT pour la table `openspace`
--
ALTER TABLE `openspace`
  MODIFY `idOpenSpace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `idRoom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT pour la table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `idSchedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
