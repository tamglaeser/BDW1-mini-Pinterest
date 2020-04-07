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
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS administrateur;
DROP TABLE IF EXISTS Photo;
DROP TABLE IF EXISTS Categorie;
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
  photoId int NOT NULL AUTO_INCREMENT,
  nomFich varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  catId int NOT NULL,
  PRIMARY KEY (photoId),
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
--
-- Inserer les categories dans la table Categorie
--

INSERT INTO Categorie(catId, nomCat)
VALUES (1, 'Animaux'),
       (2, 'Sport'),
       (3, 'Internet'),
       (4, 'Gens');

-- --------------------------------------------------------
--
-- Inserer les images dans la table Photo
--

INSERT INTO Photo(photoId, nomFich, description, catId)
VALUES (1, 'giraffe.png', 'Un dessin d''une girafe', 1),
       (2, 'klose.jpg', 'Joueur allemand de foot Klose faisant un flip', 2),
       (3, 'loading.gif', 'Signe de chargement d''internet', 3),
       (4, 'petiteMaman.jpg', 'La maman de Tullia quand elle etait tres petite', 4),
       (5, 'pikachu.gif', 'Un GIF de Pikachu (de Pokemon)', 1),
       (6, 'shireMordor.jpg', 'L''affichage de Google Maps du Shire a Mordor (dans le Seigneur des Anneux)', 3),
       (7, 'snowboard.png', 'un mec sur son snowboard dans l''air', 2),
       (8, 'troisAmis.jpg', 'Une photo vieille des trois amis', 4);

-- --------------------------------------------------------
--
-- Exporter les tables
--



-- --------------------------------------------------------
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
