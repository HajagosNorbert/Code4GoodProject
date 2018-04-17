-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2018 at 06:18 PM
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
  `lejart` tinyint(1) NOT NULL DEFAULT '0',
  `elvegzett` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `munkaado_id` (`munkaado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ajanlatok`
--

INSERT INTO `ajanlatok` (`id`, `munkaado_id`, `felajanlott_oraszam`, `cim`, `leiras`, `helyszin`, `feltoltve`, `munka_idopont`, `lejart`, `elvegzett`) VALUES
(16, 5, 5, 'Kapáni kő!', 'Ammm... Csak kapálj!', 'Szeged', '2018-03-08 13:52:00', '2018-03-15 17:45:00', 0, 0),
(18, 11, 2, 'Favágás', 'nehéz', 'Szeged', '2018-03-22 16:05:00', '2018-03-23 12:23:00', 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ajanlatokra_jelentkezesek`
--

INSERT INTO `ajanlatokra_jelentkezesek` (`id`, `jelentkezo_id`, `ajanlat_id`, `elfogadva`) VALUES
(26, 12, 18, 1),
(34, 9, 16, 0);

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
  KEY `ertekelt_id` (`ertekelt_id`),
  KEY `ertekelo_id` (`ertekelo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ertekelesek`
--

INSERT INTO `ertekelesek` (`ertekelt_id`, `ertekelo_id`, `ertekeles`, `megjegyzes`, `id`) VALUES
(2, 3, 2, 'Nagyol alulteljesítettél báttyó....', 1),
(3, 4, 5, 'Nagyon ügyi voltál <3', 2),
(2, 8, 5, 'Tök jó voltál', 5),
(9, 8, 5, 'Ez egy rövid vélemény', 8),
(9, 8, 4, 'Ez egy hosszabb vélemény!Ez egy hosszabb vélemény!Ez egy hosszabb vélemény!Ez egy hosszabb vélemény!Ez egy hosszabb vélemény!Ez egy hosszabb vélemény!Ez egy hosszabb vélemény!', 9),
(9, 8, 1, 'Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! Ez jóóó hosszú vélemény! ', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ertesitesek`
--

DROP TABLE IF EXISTS `ertesitesek`;
CREATE TABLE IF NOT EXISTS `ertesitesek` (
  `ertesitett_id` int(11) NOT NULL,
  `cim` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `tartalom` text COLLATE utf8mb4_bin NOT NULL,
  `feltoltve` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `ertesitett_id` (`ertesitett_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ertesitesek`
--

INSERT INTO `ertesitesek` (`ertesitett_id`, `cim`, `tartalom`, `feltoltve`, `id`) VALUES
(12, 'Meg lettél bízva!', 'Te lettél megbízva a(z) Favágás munkára +3620312 adf által. ', '2018-03-27 19:07:30', 11),
(2, 'Meg lettél bízva!', 'Te lettél megbízva a(z) Lakás takarítás munkára Big Boss által. ', '2018-03-27 20:28:31', 25),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-03-27 20:28:35', 26),
(2, 'Meg lettél bízva!', 'Te lettél megbízva a(z) Lakás takarítás munkára', '2018-04-05 07:18:52', 28),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-05 07:34:59', 29),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-05 16:26:48', 32),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-05 18:24:21', 33),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-05 18:59:29', 34),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-05 18:59:36', 35),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-13 23:51:35', 36),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-13 23:54:01', 37),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-13 23:54:05', 38),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-13 23:54:07', 39),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-13 23:56:12', 40),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-13 23:56:18', 41),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-13 23:56:22', 42),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-13 23:56:25', 43),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-13 23:56:40', 44),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-13 23:56:44', 45),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-13 23:59:03', 46),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-13 23:59:14', 47),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-16 16:16:49', 48),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-16 16:17:04', 49),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-16 16:17:07', 50),
(2, 'Megbízás megszűntetve', 'A(z) Lakás takarítás munkára visszavonták a megbízásod.', '2018-04-16 16:47:12', 51),
(2, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z) Lakás takarítás munkára', '2018-04-16 21:02:46', 52),
(9, 'Megbízást kaptál!', 'Te kaptad a megbízást a(z)  munkára', '2018-04-16 23:44:41', 53),
(2, 'Munka megszűnve', 'A(z) Lakás takarítás munkát ,amire jelentkeztél megszűntentték.', '2018-04-17 00:59:37', 54),
(9, 'Munka megszűnve', 'A(z) Lakás takarítás munkát ,amire jelentkeztél megszűntentték.', '2018-04-17 00:59:37', 55),
(2, 'Munka megszűnve', 'A(z) Lakás takarítás munkát ,amire jelentkeztél megszűntentték.', '2018-04-17 00:59:37', 56);

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
  `profil_kep_allapot` int(11) NOT NULL DEFAULT '0',
  `felhasznalo_tipus` tinyint(4) NOT NULL,
  `telefonszam` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `bemutatkozas` text COLLATE utf8mb4_bin,
  `iskola_id` int(11) DEFAULT NULL,
  `diakigazolvany_szam` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `oraszam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iskola_id` (`iskola_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `keresztnev`, `vezeteknev`, `email`, `jelszo`, `email_megerosito`, `profil_kep_allapot`, `felhasznalo_tipus`, `telefonszam`, `facebook_id`, `bemutatkozas`, `iskola_id`, `diakigazolvany_szam`, `oraszam`) VALUES
(2, 'Daniel', 'Don', 'asd@gmail.com', 'asd123', 'ffffffffa', 0, 0, NULL, NULL, NULL, 1, '11234567891', NULL),
(3, 'Jacob', 'Hoodie', 'sssdffee@gmail.com', 'asd123', 'fggggggfa', 0, 0, NULL, NULL, NULL, 2, '11234555591', NULL),
(4, 'Anna', 'Fedora', 'uuuiio@gmail.com', 'asd123', 'jjjjjfffa', 0, 0, NULL, NULL, NULL, 1, '44444567891', NULL),
(5, 'Józsi', 'Magos', 'nincs@freemail.com', 'ammmmm', 'adfdaf', 0, 1, NULL, NULL, 'Nálam fogtok dolgozni kölkök.', NULL, NULL, 10),
(8, 'Boss', 'Big', 'munka', 'asd', 'később megoldani', 1, 1, '+36301234567', 'NULL', 'NULL', NULL, NULL, 5),
(9, 'Katalin', 'Fehér', 'diak@gmail.com', 'asd', 'később megoldani', 1, 0, '+36201234567', 'NULL', 'Egyszerű bemutatkozás', 1, '7365862159', NULL),
(11, 'adf', '+3620312', 'm@gmail.com', 'asd', 'Később megoldani', 0, 1, NULL, 'Később megoldani', 'NULL', NULL, NULL, 5),
(12, 'sdg', '+3620235', 'd@gmail.com', 'asd', 'Később megoldani', 0, 0, NULL, 'Később megoldani', 'NULL', 3, '123', NULL);

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
