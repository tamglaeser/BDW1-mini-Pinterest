-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Avril 2019 à 15:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bdd`
--

-- --------------------------------------------------------
--DROP TABLE utilisateur;
--DROP TABLE administrateur;
--DROP TABLE Photo;
--DROP TABLE Categorie;
--
-- Structure de la table `Categorie`
--

CREATE TABLE IF NOT EXISTS Categorie (
  catId int NOT NULL,
  nomCat varchar(255) NOT NULL,
  PRIMARY KEY (catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE IF NOT EXISTS Photo (
  photoId int NOT NULL,
  nomFich varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  catId int NOT NULL,
  FOREIGN KEY (catId) REFERENCES Categorie(catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------
--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS utilisateur (
  `utilId` varchar(255) NOT NULL,
  `utilMdp` varchar(255) NOT NULL,
  PRIMARY KEY (`utilId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS administrateur (
  `adminId` varchar(255) NOT NULL,
  `adminMdp` varchar(255) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
