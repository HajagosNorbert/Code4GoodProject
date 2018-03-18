-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2018 at 06:20 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code4good`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajanlatok`
--

DROP TABLE IF EXISTS `ajanlatok`;
CREATE TABLE IF NOT EXISTS `ajanlatok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `munkaado_id` int(11) NOT NULL,
  `felajanlott_oraszam` int(11) NOT NULL,
  `cim` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `leiras` text COLLATE utf8mb4_bin NOT NULL,
  `helyszin` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `feltoltve` datetime DEFAULT NULL,
  `munka_idopont` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `munkaado_id` (`munkaado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ajanlatok`
--

INSERT INTO `ajanlatok` (`id`, `munkaado_id`, `felajanlott_oraszam`, `cim`, `leiras`, `helyszin`, `feltoltve`, `munka_idopont`) VALUES
(14, 8, 2, 'PC Szerelés', 'Segítesz összepattintani a masinát!', 'SZEGED', '2018-03-08 13:46:00', '2019-03-09 17:30:00'),
(15, 8, 1, 'Lakás takarítás', 'Segítesz kiporolni a barlangom!', 'Szeged', '2018-03-08 13:48:00', '2018-03-12 14:15:00'),
(16, 5, 5, 'Kapáni kő!', 'Ammm... Csak kapálj!', 'Szeged', '2018-03-08 13:52:00', '2018-03-15 17:45:00'),
(17, 8, 1, 'Teafőzés', 'szomjas vagylok', 'Itt', '2018-03-08 16:09:00', '2018-03-01 22:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `ajanlatokra_jelentkezesek`
--

DROP TABLE IF EXISTS `ajanlatokra_jelentkezesek`;
CREATE TABLE IF NOT EXISTS `ajanlatokra_jelentkezesek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jelentkezo_id` int(11) NOT NULL,
  `ajanlat_id` int(11) NOT NULL,
  `elfogadva` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ajanlat_id` (`ajanlat_id`),
  KEY `jelentkezo_id` (`jelentkezo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ajanlatokra_jelentkezesek`
--

INSERT INTO `ajanlatokra_jelentkezesek` (`id`, `jelentkezo_id`, `ajanlat_id`, `elfogadva`) VALUES
(18, 9, 14, 0),
(20, 2, 14, 0),
(21, 2, 15, 1),
(23, 9, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ertekelesek`
--

DROP TABLE IF EXISTS `ertekelesek`;
CREATE TABLE IF NOT EXISTS `ertekelesek` (
  `ertekelt_id` int(11) NOT NULL,
  `ertekelo_id` int(11) NOT NULL,
  `ertekeles` smallint(6) NOT NULL,
  `megjegyzes` text COLLATE utf8mb4_bin NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ertekelo_id` (`ertekelo_id`),
  KEY `ertekelt_id` (`ertekelt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ertekelesek`
--

INSERT INTO `ertekelesek` (`ertekelt_id`, `ertekelo_id`, `ertekeles`, `megjegyzes`, `id`) VALUES
(2, 3, 2, 'Nagyol alulteljesítettél báttyó....', 1),
(3, 4, 5, 'Nagyon ügyi voltál <3', 2),
(9, 8, 4, 'Nagyon szép munkát végzett, habár folyton pimaszkodott.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ertesitesek`
--

DROP TABLE IF EXISTS `ertesitesek`;
CREATE TABLE IF NOT EXISTS `ertesitesek` (
  `ertesitett_id` int(11) NOT NULL,
  `cim` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `tartalom` text COLLATE utf8mb4_bin NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `ertesitett_id` (`ertesitett_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ertesitesek`
--

INSERT INTO `ertesitesek` (`ertesitett_id`, `cim`, `tartalom`, `id`) VALUES
(3, 'Bajban vagy', 'Nem vitted le a szemetet....!', 1),
(3, 'Mégnagyobb baj', 'Ma sem vitted le', 2);

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalok`
--

DROP TABLE IF EXISTS `felhasznalok`;
CREATE TABLE IF NOT EXISTS `felhasznalok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keresztnev` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `vezeteknev` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `jelszo` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email_megerosito` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `felhasznalo_tipus` tinyint(4) NOT NULL,
  `telefonszam` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `bemutatkozas` text COLLATE utf8mb4_bin,
  `iskola_id` int(11) DEFAULT NULL,
  `diakigazolvany_szam` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `oraszam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iskola_id` (`iskola_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `keresztnev`, `vezeteknev`, `email`, `jelszo`, `email_megerosito`, `felhasznalo_tipus`, `telefonszam`, `facebook_id`, `bemutatkozas`, `iskola_id`, `diakigazolvany_szam`, `oraszam`) VALUES
(2, 'Daniel', 'Don', 'asd@gmail.com', 'asd123', 'ffffffffa', 0, NULL, NULL, NULL, 1, '11234567891', NULL),
(3, 'Jacob', 'Hoodie', 'sssdffee@gmail.com', 'asd123', 'fggggggfa', 0, NULL, NULL, NULL, 2, '11234555591', NULL),
(4, 'Anna', 'Fedora', 'uuuiio@gmail.com', 'asd123', 'jjjjjfffa', 0, NULL, NULL, NULL, 1, '44444567891', NULL),
(5, 'Józsi', 'Magos', 'nincs@freemail.com', 'ammmmm', 'adfdaf', 1, NULL, NULL, 'Nálam fogtok dolgozni kölkök.', NULL, NULL, 10),
(8, 'Boss', 'Big', 'munka', 'asd', 'később megoldani', 1, '+36301234567', 'NULL', 'NULL', NULL, NULL, 5),
(9, 'Katalin', 'Fehér', 'diak', 'asd', 'később megoldani', 0, 'NULL', 'NULL', 'Egy szorgos lány vagyok, aki szereti a gyerekeket és mindig alapos munkát végzek.', 1, '7365862159', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iskolak`
--

DROP TABLE IF EXISTS `iskolak`;
CREATE TABLE IF NOT EXISTS `iskolak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `iskolak`
--

INSERT INTO `iskolak` (`id`, `nev`) VALUES
(1, 'Gábor Dénes'),
(2, 'Móra'),
(3, 'Hansági');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ajanlatok`
--
ALTER TABLE `ajanlatok`
  ADD CONSTRAINT `ajanlatok_ibfk_1` FOREIGN KEY (`munkaado_id`) REFERENCES `felhasznalok` (`id`);

--
-- Constraints for table `ajanlatokra_jelentkezesek`
--
ALTER TABLE `ajanlatokra_jelentkezesek`
  ADD CONSTRAINT `ajanlatokra_jelentkezesek_ibfk_2` FOREIGN KEY (`jelentkezo_id`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `ajanlatokra_jelentkezesek_ibfk_3` FOREIGN KEY (`ajanlat_id`) REFERENCES `ajanlatok` (`id`);

--
-- Constraints for table `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD CONSTRAINT `ertekelesek_ibfk_1` FOREIGN KEY (`ertekelt_id`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `ertekelesek_ibfk_2` FOREIGN KEY (`ertekelo_id`) REFERENCES `felhasznalok` (`id`);

--
-- Constraints for table `ertesitesek`
--
ALTER TABLE `ertesitesek`
  ADD CONSTRAINT `ertesitesek_ibfk_1` FOREIGN KEY (`ertesitett_id`) REFERENCES `felhasznalok` (`id`);

--
-- Constraints for table `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD CONSTRAINT `felhasznalok_ibfk_1` FOREIGN KEY (`iskola_id`) REFERENCES `iskolak` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
