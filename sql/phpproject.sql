-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 02 apr 2015 om 11:18
-- Serverversie: 5.6.11
-- PHP-versie: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `phpproject`
--
CREATE DATABASE IF NOT EXISTS `phpproject` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phpproject`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbladmin`
--

CREATE TABLE IF NOT EXISTS `tbladmin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminNaam` varchar(250) NOT NULL,
  `adminVoornaam` varchar(250) NOT NULL,
  `adminEmail` varchar(250) NOT NULL,
  `adminPassword` varchar(250) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblboekingen`
--

CREATE TABLE IF NOT EXISTS `tblboekingen` (
  `boekingID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL,
  `datumID` int(11) NOT NULL,
  `boekingTijd` time NOT NULL,
  PRIMARY KEY (`boekingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblbuddies`
--

CREATE TABLE IF NOT EXISTS `tblbuddies` (
  `buddieID` int(11) NOT NULL AUTO_INCREMENT,
  `buddieNaam` varchar(250) NOT NULL,
  `buddieVoornaam` varchar(250) NOT NULL,
  `buddieEmail` varchar(250) NOT NULL,
  `buddieTwitter` varchar(250) NOT NULL,
  `buddiePassword` varchar(250) NOT NULL,
  `buddieRichting` int(11) NOT NULL,
  `buddieJaar` int(11) NOT NULL,
  `buddieRating` int(11) NOT NULL,
  `buddieFoto` varchar(256) NOT NULL,
  PRIMARY KEY (`buddieID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbldatums`
--

CREATE TABLE IF NOT EXISTS `tbldatums` (
  `datumID` int(11) NOT NULL AUTO_INCREMENT,
  `datumDate` date NOT NULL,
  PRIMARY KEY (`datumID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblstudenten`
--

CREATE TABLE IF NOT EXISTS `tblstudenten` (
  `studentID` int(11) NOT NULL AUTO_INCREMENT,
  `studentNaam` varchar(250) NOT NULL,
  `studentVoornaam` varchar(250) NOT NULL,
  `studentEmail` varchar(250) NOT NULL,
  `studentPassword` varchar(250) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
