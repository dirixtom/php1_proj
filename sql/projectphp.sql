-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Machine: localhost:8889
-- Gegenereerd op: 24 apr 2015 om 14:47
-- Serverversie: 5.5.38
-- PHP-versie: 5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databank: `projectphp`
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbladmin`
--

INSERT INTO `tbladmin` (`adminID`, `adminNaam`, `adminVoornaam`, `adminEmail`, `adminPassword`) VALUES
(1, 'Baeten', 'Noe', 'noe.baeten@gmail.com', 'abs');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblboekingen`
--

CREATE TABLE `tblboekingen` (
`boekingID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL,
  `datumID` int(11) NOT NULL,
  `boekingTijd` time NOT NULL,
  `boekingNaam` varchar(250) NOT NULL,
  `boekingVoornaam` varchar(250) NOT NULL,
  `boekingDag` varchar(250) NOT NULL,
  `boekingMaand` varchar(250) NOT NULL,
  `boekingJaar` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblboekingen`
--

INSERT INTO `tblboekingen` (`boekingID`, `studentID`, `buddieID`, `datumID`, `boekingTijd`, `boekingNaam`, `boekingVoornaam`, `boekingDag`, `boekingMaand`, `boekingJaar`) VALUES
(1, 0, 0, 0, '00:00:00', 'Dirix', 'Tom', '1', 'Januari', '2016'),
(2, 0, 0, 0, '00:00:00', 'Baeten', 'Noe', '6', 'Maart', '2016'),
(3, 0, 0, 0, '00:00:00', 'Blabla', 'Blaaaa', '9', 'Mei', '2016');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblbuddies`
--

INSERT INTO `tblbuddies` (`buddieID`, `buddieNaam`, `buddieVoornaam`, `buddieTwitter`, `buddieEmail`, `buddiePassword`, `buddieJaar`, `buddieRichting`, `buddieRating`, `buddieLeeftijd`, `buddieFoto`) VALUES
(14, 'baeten', 'noe', '@Noebaeten', 'noe.baeten@gmail.com', 'abs', '1', '1', 0, 0, 'images/profpics/noe.baeten@gmail.com/a33GpBQ_700b.jpg'),
(15, 'baeten', 'noe', '@Noebaet', '', '', '1', '1', 0, 0, 'images/profpics/noe.baeten@gmail.com/image.jpg'),
(19, 'noe', 'noe', '@noe', 'noe@noe.com', 'abs', '1', '1', 0, 0, 'images/profpics/noe@noe.com/Tattoo idea.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbldatums`
--

CREATE TABLE `tbldatums` (
`datumID` int(11) NOT NULL,
  `datumDag` varchar(250) NOT NULL,
  `datumMaand` varchar(250) NOT NULL,
  `datumJaar` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbldatums`
--

INSERT INTO `tbldatums` (`datumID`, `datumDag`, `datumMaand`, `datumJaar`) VALUES
(1, '3', 'Januari', '2015'),
(2, '6', 'Maart', '2015'),
(3, '7', 'Mei', '2015'),
(4, '8', 'Mei', '2015'),
(5, '10', 'Juli', '2015');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblmessages`
--

CREATE TABLE `tblmessages` (
`messageID` int(11) NOT NULL,
  `messageText` varchar(200) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblreacties`
--

CREATE TABLE `tblreacties` (
`reactiesID` int(11) NOT NULL,
  `reactiesNaam` varchar(250) NOT NULL,
  `reactiesComment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblreacties`
--

INSERT INTO `tblreacties` (`reactiesID`, `reactiesNaam`, `reactiesComment`) VALUES
(1, 'Tom', 'Dag verliep goed. Buddy werkte goed mee!'),
(2, 'Shane', 'Dag verliep slecht. Buddy is niet komen opdagen. '),
(4, 'Tom', 'Dag verliep goed. Buddy werkte goed mee!'),
(5, 'Shane', 'Dag verliep slecht. Buddy is niet komen opdagen. ');

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
-- Indexen voor tabel `tblmessages`
--
ALTER TABLE `tblmessages`
 ADD PRIMARY KEY (`messageID`), ADD UNIQUE KEY `sec` (`buddieID`), ADD UNIQUE KEY `studentID` (`studentID`);

--
-- Indexen voor tabel `tblreacties`
--
ALTER TABLE `tblreacties`
 ADD PRIMARY KEY (`reactiesID`);

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
MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `tblboekingen`
--
ALTER TABLE `tblboekingen`
MODIFY `boekingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `tblbuddies`
--
ALTER TABLE `tblbuddies`
MODIFY `buddieID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT voor een tabel `tbldatums`
--
ALTER TABLE `tbldatums`
MODIFY `datumID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `tblmessages`
--
ALTER TABLE `tblmessages`
MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `tblreacties`
--
ALTER TABLE `tblreacties`
MODIFY `reactiesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `tblstudenten`
--
ALTER TABLE `tblstudenten`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tblmessages`
--
ALTER TABLE `tblmessages`
ADD CONSTRAINT `tblmessages_ibfk_2` FOREIGN KEY (`buddieID`) REFERENCES `tblstudenten` (`studentID`),
ADD CONSTRAINT `tblmessages_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `tblbuddies` (`buddieID`);
