-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 23 Avril 2012 à 11:38
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `comparessence`
--
CREATE DATABASE IF NOT EXISTS comparessence;
use comparessence;
-- --------------------------------------------------------

--
-- Structure de la table `essence`
--

CREATE TABLE IF NOT EXISTS `essence` (
  `idStation` int(11) NOT NULL,
  `go` double DEFAULT NULL,
  `goDate` date DEFAULT NULL,
  `goID` int(11) DEFAULT NULL,
  `goP` double DEFAULT NULL,
  `goPDate` date DEFAULT NULL,
  `GoPID` int(11) DEFAULT NULL,
  `sp95` double DEFAULT NULL,
  `sp95Date` date DEFAULT NULL,
  `sp95ID` int(11) DEFAULT NULL,
  `sp98` double DEFAULT NULL,
  `sp98Date` date DEFAULT NULL,
  `sp98ID` int(11) DEFAULT NULL,
  `gpl` double DEFAULT NULL,
  `gplDate` date DEFAULT NULL,
  `gplID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idStation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `itineraire`
--

CREATE TABLE IF NOT EXISTS `itineraire` (
  `idMembre` int(11) NOT NULL,
  `adresseDepart` varchar(200) NOT NULL,
  `cpDepart` int(11) NOT NULL,
  `adresseArrivee` varchar(200) NOT NULL,
  `cpArrivee` int(11) NOT NULL,
  PRIMARY KEY (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `idMembre` int(11) NOT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `carburant` varchar(50) DEFAULT NULL,
  `rayon` int(11) DEFAULT NULL,
  `civilite` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `nombreVehicule` varchar(50) DEFAULT NULL,
  `categorieSP` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stations`
--

CREATE TABLE IF NOT EXISTS `stations` (
  `idStation` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `dpt` int(11) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `idMembre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idStation`),
  KEY `idMembre` (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `essence`
--
ALTER TABLE `essence`
  ADD CONSTRAINT `essence_ibfk_1` FOREIGN KEY (`idStation`) REFERENCES `stations` (`idStation`);

--
-- Contraintes pour la table `itineraire`
--
ALTER TABLE `itineraire`
  ADD CONSTRAINT `itineraire_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `stations`
--
ALTER TABLE `stations`
  ADD CONSTRAINT `stations_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
