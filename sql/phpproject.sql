-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Machine: localhost:8889
-- Gegenereerd op: 03 apr 2015 om 17:09
-- Serverversie: 5.5.38
-- PHP-versie: 5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+01:00";

--
-- Databank: `phpproject`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbladmin`
--

CREATE TABLE `tbladmin` (
`adminID` int(11) NOT NULL,
  `adminNaam` varchar(250) NOT NULL,
  `adminVoornaam` varchar(250) NOT NULL,
  `adminEmail` varchar(250) NOT NULL,
  `adminPassword` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblboekingen`
--

CREATE TABLE `tblboekingen` (
`boekingID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL,
  `datumID` int(11) NOT NULL,
  `boekingTijd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblbuddies`
--

CREATE TABLE `tblbuddies` (
`buddieID` int(11) NOT NULL,
  `buddieNaam` varchar(250) NOT NULL,
  `buddieVoornaam` varchar(250) NOT NULL,
  `buddieTwitter` varchar(255) NOT NULL,
  `buddieEmail` varchar(250) NOT NULL,
  `buddiePassword` varchar(250) NOT NULL,
  `buddieJaar` varchar(255) NOT NULL,
  `buddieRichting` varchar(250) NOT NULL,
  `buddieRating` int(11) NOT NULL,
  `buddieLeeftijd` int(11) NOT NULL,
  `buddieFoto` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbldatums`
--

CREATE TABLE `tbldatums` (
`datumID` int(11) NOT NULL,
  `datumDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblstudenten`
--

CREATE TABLE `tblstudenten` (
`studentID` int(11) NOT NULL,
  `studentNaam` varchar(250) NOT NULL,
  `studentVoornaam` varchar(250) NOT NULL,
  `studentEmail` varchar(250) NOT NULL,
  `studentPassword` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tbladmin`
--
ALTER TABLE `tbladmin`
 ADD PRIMARY KEY (`adminID`);

--
-- Indexen voor tabel `tblboekingen`
--
ALTER TABLE `tblboekingen`
 ADD PRIMARY KEY (`boekingID`);

--
-- Indexen voor tabel `tblbuddies`
--
ALTER TABLE `tblbuddies`
 ADD PRIMARY KEY (`buddieID`);

--
-- Indexen voor tabel `tbldatums`
--
ALTER TABLE `tbldatums`
 ADD PRIMARY KEY (`datumID`);

--
-- Indexen voor tabel `tblstudenten`
--
ALTER TABLE `tblstudenten`
 ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tbladmin`
--
ALTER TABLE `tbladmin`
MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `tblboekingen`
--
ALTER TABLE `tblboekingen`
MODIFY `boekingID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `tblbuddies`
--
ALTER TABLE `tblbuddies`
MODIFY `buddieID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `tbldatums`
--
ALTER TABLE `tbldatums`
MODIFY `datumID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `tblstudenten`
--
ALTER TABLE `tblstudenten`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT;