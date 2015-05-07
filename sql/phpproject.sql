-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 07 mei 2015 om 09:59
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbladmin`
--

INSERT INTO `tbladmin` (`adminID`, `adminNaam`, `adminVoornaam`, `adminEmail`, `adminPassword`) VALUES
(1, 'Baeten', 'Noe', 'noe.baeten@gmail.com', 'abs');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblboekingen`
--

CREATE TABLE IF NOT EXISTS `tblboekingen` (
  `boekingID` int(11) NOT NULL AUTO_INCREMENT,
  `datumID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`boekingID`),
  UNIQUE KEY `datum` (`datumID`),
  UNIQUE KEY `student` (`studentID`),
  UNIQUE KEY `buddie` (`buddieID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblbuddies`
--

CREATE TABLE IF NOT EXISTS `tblbuddies` (
  `buddieID` int(11) NOT NULL AUTO_INCREMENT,
  `buddieNaam` varchar(250) NOT NULL,
  `buddieVoornaam` varchar(250) NOT NULL,
  `buddieTwitter` varchar(255) NOT NULL,
  `buddieEmail` varchar(250) NOT NULL,
  `buddiePassword` varchar(250) NOT NULL,
  `buddieJaar` varchar(255) NOT NULL,
  `buddieRichting` varchar(250) NOT NULL,
  `buddieRating` int(11) NOT NULL,
  `buddieLeeftijd` int(11) NOT NULL,
  `buddieFoto` varchar(255) NOT NULL,
  PRIMARY KEY (`buddieID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblbuddies`
--

INSERT INTO `tblbuddies` (`buddieID`, `buddieNaam`, `buddieVoornaam`, `buddieTwitter`, `buddieEmail`, `buddiePassword`, `buddieJaar`, `buddieRichting`, `buddieRating`, `buddieLeeftijd`, `buddieFoto`) VALUES
(20, 'Rymenams', 'Shane', '@ShaneRymenams', 'shanerymenams@gmail.com', 'Testing123', '3', '1', 0, 0, 'images/profpics/shanerymenams@gmail.com/Shane.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbldatums`
--

CREATE TABLE IF NOT EXISTS `tbldatums` (
  `datumID` int(11) NOT NULL AUTO_INCREMENT,
  `datumDag` varchar(250) NOT NULL,
  `datumMaand` varchar(250) NOT NULL,
  `datumJaar` varchar(250) NOT NULL,
  PRIMARY KEY (`datumID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbldatums`
--

INSERT INTO `tbldatums` (`datumID`, `datumDag`, `datumMaand`, `datumJaar`) VALUES
(7, '1', 'Januari', '2015');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblmessages`
--

CREATE TABLE IF NOT EXISTS `tblmessages` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `messageText` varchar(200) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL,
  PRIMARY KEY (`messageID`),
  UNIQUE KEY `sec` (`buddieID`),
  UNIQUE KEY `studentID` (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblreacties`
--

CREATE TABLE IF NOT EXISTS `tblreacties` (
  `reactiesID` int(11) NOT NULL AUTO_INCREMENT,
  `reactiesNaam` varchar(250) NOT NULL,
  `reactiesComment` text NOT NULL,
  `reactiesMail` varchar(255) NOT NULL,
  PRIMARY KEY (`reactiesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `tblreacties`
--

INSERT INTO `tblreacties` (`reactiesID`, `reactiesNaam`, `reactiesComment`, `reactiesMail`) VALUES
(6, 'Tom', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com'),
(7, 'Shane', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com'),
(8, 'Vincent', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com');

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `usertable`
--

CREATE TABLE IF NOT EXISTS `usertable` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fbid` bigint(20) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `usertable`
--

INSERT INTO `usertable` (`id`, `fbid`, `fullname`, `email`) VALUES
(1, 1381149482214525, 'Vincent Van Loock', 'rentastudentthomasmore@gmail.com'),
(2, 10205395106350448, 'NoÃ« Baeten', 'baeten_link@hotmail.com'),
(3, 10206617544936237, 'Shane Rymenams', '');

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `tblboekingen`
--
ALTER TABLE `tblboekingen`
  ADD CONSTRAINT `tblboekingen_ibfk_1` FOREIGN KEY (`datumID`) REFERENCES `tbldatums` (`datumID`),
  ADD CONSTRAINT `tblboekingen_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `tblstudenten` (`studentID`),
  ADD CONSTRAINT `tblboekingen_ibfk_3` FOREIGN KEY (`buddieID`) REFERENCES `tblbuddies` (`buddieID`);

--
-- Beperkingen voor tabel `tblmessages`
--
ALTER TABLE `tblmessages`
  ADD CONSTRAINT `tblmessages_ibfk_2` FOREIGN KEY (`buddieID`) REFERENCES `tblstudenten` (`studentID`),
  ADD CONSTRAINT `tblmessages_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `tblbuddies` (`buddieID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
