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
DROP TABLE IF EXISTS Photo;
DROP TABLE IF EXISTS Categorie;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS administrateur;


--
-- Structure de la table `Categorie`
--

CREATE TABLE IF NOT EXISTS Categorie (
  catId int NOT NULL AUTO_INCREMENT,
  nomCat varchar(255) NOT NULL,
  PRIMARY KEY (catId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;
-- --------------------------------------------------------
--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS utilisateur (
    utilId int NOT NULL AUTO_INCREMENT,
    utilPseudo varchar(255) NOT NULL,
    utilMdp varchar(255) NOT NULL,
    etat varchar(255) NOT NULL,
    PRIMARY KEY (utilId)
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
  utilId int NOT NULL,
  statut varchar(255) NOT NULL,
  PRIMARY KEY (photoId),
  FOREIGN KEY (catId) REFERENCES Categorie (catId),
  FOREIGN KEY (utilId) REFERENCES utilisateur (utilId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------
--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS administrateur (
  adminId int NOT NULL AUTO_INCREMENT,
  adminPseudo varchar(255) NOT NULL,
  adminMdp varchar(255) NOT NULL,
  PRIMARY KEY (adminId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Inserer les categories dans la table Categorie
--

INSERT INTO Categorie(nomCat)
VALUES ('Starburts'),
       ('Endroits'),
       ('Ordinateur'),
       ('Animaux'),
       ('Gens'),
       ('Dessins'),
       ('Sport');

-- --------------------------------------------------------
--
-- Inserer les utilisateurs dans la table utilisateur
--

INSERT INTO utilisateur(utilPseudo, utilMdp, etat)
VALUES ('p1926029', 'ef5d0c', 'disconnected');

-- --------------------------------------------------------
--
-- Inserer les images dans la table Photo
--

INSERT INTO Photo(nomFich, description, catId, utilId, statut)
VALUES ('bracelet.gif', 'Un bracelet fait des emballages des bonbons Starbursts', 1, 1, 'montre'),
       ('composants.gif', 'Deux individuel emballages des bonbons Starbursts', 1, 1,'montre'),
       ('EgliseDC.jpeg', 'l''interieur de la basilique a DC', 2, 1, 'montre'),
       ('giraffe.png', 'Un dessin d''une girafe', 4, 1,'montre'),
       ('loading.gif', 'Signe de chargement d''internet', 3, 1, 'montre'),
       ('pikachu.gif', 'Un GIF de Pikachu (de Pokemon)', 4, 1, 'montre'),
       ('snowboard.png', 'un mec sur son snowboard dans l''air', 7, 1, 'montre'),
       ('graphe.png', 'Une graphe fait avec Matlab pour les devoir de maths de Tullia', 3, 1, 'montre'),
       ('inconnu.jpeg', 'Un photo d''un endroit et d''un mec qu''on a oublie (probablement en Europe)', 2, 1, 'montre'),
       ('kisses.gif', 'Un dessin de des Hershey Kisses', 6, 1, 'montre'),
       ('linkedIn.png', 'Le photo LinkedIn de Tullia', 5, 1, 'montre'),
       ('plantcell.gif', 'Le diagram de la cellule d''une plante', 6, 1, 'montre'),
       ('klose.jpg', 'Le jouer de foot allemand Klose qui fait un flip', 7, 1, 'montre'),
       ('petiteMaman.jpg', 'La maman de Tullia quand elle etait tres petite', 5, 1, 'montre'),
       ('shireMordor.jpg', 'Un ecran de GoogleMap pour arriver a Mordor du Shire', 3, 1, 'montre'),
       ('troisAmis.jpg', 'La maman de Tullia dans les scouts quand elle etait petite', 5, 1, 'montre');

-- --------------------------------------------------------
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
