-- phpMyAdmin SQL Dump
-- version 4.9.1deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2020 at 01:01 AM
-- Server version: 10.3.22-MariaDB-1:10.3.22+maria~bionic-log
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p1926029`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `adminId` int(11) NOT NULL,
  `adminPseudo` varchar(255) NOT NULL,
  `adminMdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Categorie`
--

CREATE TABLE `Categorie` (
  `catId` int(11) NOT NULL,
  `nomCat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Categorie`
--

INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES
(1, 'Starburts'),
(2, 'Endroits'),
(3, 'Ordinateur'),
(4, 'Animaux'),
(5, 'Gens'),
(6, 'Dessins');

-- --------------------------------------------------------

--
-- Table structure for table `Photo`
--

CREATE TABLE `Photo` (
  `photoId` int(11) NOT NULL,
  `nomFich` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `utilId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Photo`
--

INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`, `utilId`) VALUES
(1, 'bracelet.gif', 'Un bracelet fait des emballages des bonbons Starbursts', 1, 1),
(2, 'composants.gif', 'Deux individuel emballages des bonbons Starbursts', 1, 1),
(3, 'EgliseDC.jpeg', 'l\'interieur de la basilique a DC', 2, 1),
(4, 'giraffe.png', 'Un dessin d\'une girafe', 4, 1),
(5, 'loading.gif', 'Signe de chargement d\'internet', 3, 1),
(6, 'pikachu.gif', 'Un GIF de Pikachu (de Pokemon)', 4, 1),
(7, 'snowboard.png', 'un mec sur son snowboard dans l\'air', 5, 1),
(8, 'graphe.png', 'Une graphe fait avec Matlab pour les devoir de maths de Tullia', 3, 1),
(9, 'inconnu.jpeg', 'Un photo d\'un endroit et d\'un mec qu\'on a oublie (probablement en Europe)', 2, 1),
(10, 'kisses.gif', 'Un dessin de des Hershey Kisses', 6, 1),
(11, 'linkedIn.png', 'Le photo LinkedIn de Tullia', 5, 1),
(12, 'plantcell.gif', 'Le diagram de la cellule d\'une plante', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `utilId` int(11) NOT NULL,
  `utilPseudo` varchar(255) NOT NULL,
  `utilMdp` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`utilId`, `utilPseudo`, `utilMdp`, `etat`) VALUES
(1, 'p1926029', 'ef5d0c', 'disconnected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photoId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `utilId` (`utilId`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`utilId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `photoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `utilId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Photo_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `Categorie` (`catId`),
  ADD CONSTRAINT `Photo_ibfk_2` FOREIGN KEY (`utilId`) REFERENCES `utilisateur` (`utilId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
