-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2022 at 07:30 
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `SAE23`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administration`
--

CREATE TABLE IF NOT EXISTS `Administration` (
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?',
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Administration`
--

INSERT INTO `Administration` (`login`, `password`) VALUES
('admin', 'passroot');

-- --------------------------------------------------------

--
-- Table structure for table `Batiment`
--

CREATE TABLE IF NOT EXISTS `Batiment` (
`id` int(5) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?',
  `gest` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `Batiment`
--

INSERT INTO `Batiment` (`id`, `name`, `gest`) VALUES
(23, 'batb', 'Fabien'),
(24, 'bate', 'Pierre');

-- --------------------------------------------------------

--
-- Table structure for table `Capteur`
--

CREATE TABLE IF NOT EXISTS `Capteur` (
`id` int(5) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?',
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?',
  `bat` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Capteur`
--

INSERT INTO `Capteur` (`id`, `name`, `type`, `bat`) VALUES
(1, 'TB208', 'Temp', 'batb'),
(2, 'CB208', 'CO2', 'batb'),
(3, 'LB208', 'Luminosité', 'batb'),
(4, 'TB207', 'Temp', 'batb'),
(5, 'CB207', 'CO2', 'batb'),
(6, 'LB207', 'Luminosité', 'batb'),
(7, 'TE208', 'Temp', 'bate'),
(8, 'CE208', 'CO2', 'bate'),
(9, 'LE208', 'Luminosité', 'bate'),
(10, 'TE207', 'Temp', 'bate'),
(11, 'CE207', 'CO2', 'bate'),
(12, 'LE207', 'Luminosité', 'bate');

-- --------------------------------------------------------

--
-- Table structure for table `Gestionnaire`
--

CREATE TABLE IF NOT EXISTS `Gestionnaire` (
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?',
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Gestionnaire`
--

INSERT INTO `Gestionnaire` (`login`, `password`) VALUES
('Fabien', 'Fabien'),
('gTEST', 'gROOT'),
('Pierre', 'Pierre');

-- --------------------------------------------------------

--
-- Table structure for table `Mesure`
--

CREATE TABLE IF NOT EXISTS `Mesure` (
`id` int(5) NOT NULL,
  `date` date DEFAULT NULL,
  `hor` time DEFAULT NULL,
  `value` int(5) NOT NULL,
  `from` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '?'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administration`
--
ALTER TABLE `Administration`
 ADD PRIMARY KEY (`login`);

--
-- Indexes for table `Batiment`
--
ALTER TABLE `Batiment`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_Batiment` (`name`), ADD KEY `FK_batiment` (`gest`);

--
-- Indexes for table `Capteur`
--
ALTER TABLE `Capteur`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_Capteur` (`name`), ADD KEY `FK_Capteur` (`bat`);

--
-- Indexes for table `Gestionnaire`
--
ALTER TABLE `Gestionnaire`
 ADD PRIMARY KEY (`login`);

--
-- Indexes for table `Mesure`
--
ALTER TABLE `Mesure`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_Mesure` (`from`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Batiment`
--
ALTER TABLE `Batiment`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `Capteur`
--
ALTER TABLE `Capteur`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Mesure`
--
ALTER TABLE `Mesure`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Batiment`
--
ALTER TABLE `Batiment`
ADD CONSTRAINT `FK_batiment` FOREIGN KEY (`gest`) REFERENCES `Gestionnaire` (`login`) ON DELETE CASCADE;

--
-- Constraints for table `Capteur`
--
ALTER TABLE `Capteur`
ADD CONSTRAINT `FK_Capteur` FOREIGN KEY (`bat`) REFERENCES `Batiment` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `Mesure`
--
ALTER TABLE `Mesure`
ADD CONSTRAINT `FK_Mesure` FOREIGN KEY (`from`) REFERENCES `Capteur` (`name`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
