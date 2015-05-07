-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Machine: localhost:8889
-- Gegenereerd op: 04 mei 2015 om 03:50
-- Serverversie: 5.5.38
-- PHP-versie: 5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `datumID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblbuddies`
--

INSERT INTO `tblbuddies` (`buddieID`, `buddieNaam`, `buddieVoornaam`, `buddieTwitter`, `buddieEmail`, `buddiePassword`, `buddieJaar`, `buddieRichting`, `buddieRating`, `buddieLeeftijd`, `buddieFoto`) VALUES
(20, 'Dirix', 'Tom', '@TomDirix', 'tom@dirix.com', 'azerty', '1', '1', 0, 0, 'images/profpics/tom@dirix.com/FLYER App.png'),
(21, 'nietdirix', 'niettom', '@niettomdirix', 'niet@tom.com', 'azerty', '1', '1', 0, 0, 'images/profpics/niet@tom.com/Juy.Viole.Grace.full.1126589.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbldatums`
--

CREATE TABLE `tbldatums` (
`datumID` int(11) NOT NULL,
  `datumDag` varchar(250) NOT NULL,
  `datumMaand` varchar(250) NOT NULL,
  `datumJaar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblmessages`
--

CREATE TABLE `tblmessages` (
`id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblmessages`
--

INSERT INTO `tblmessages` (`id`, `user`, `message`) VALUES
(1, 'test', 'tom');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblreacties`
--

CREATE TABLE `tblreacties` (
`reactiesID` int(11) NOT NULL,
  `reactiesNaam` varchar(250) NOT NULL,
  `reactiesComment` text NOT NULL,
  `reactiesMail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblreacties`
--

INSERT INTO `tblreacties` (`reactiesID`, `reactiesNaam`, `reactiesComment`, `reactiesMail`) VALUES
(6, 'Tom', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com'),
(7, 'Shane', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com'),
(8, 'Vincent', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com');

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
 ADD PRIMARY KEY (`boekingID`), ADD UNIQUE KEY `datum` (`datumID`), ADD UNIQUE KEY `student` (`studentID`), ADD UNIQUE KEY `buddie` (`buddieID`);

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
 ADD PRIMARY KEY (`id`);

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
MODIFY `buddieID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `tbldatums`
--
ALTER TABLE `tbldatums`
MODIFY `datumID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `tblmessages`
--
ALTER TABLE `tblmessages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `tblreacties`
--
ALTER TABLE `tblreacties`
MODIFY `reactiesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `tblstudenten`
--
ALTER TABLE `tblstudenten`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tblboekingen`
--
ALTER TABLE `tblboekingen`
ADD CONSTRAINT `tblboekingen_ibfk_1` FOREIGN KEY (`datumID`) REFERENCES `tbldatums` (`datumID`),
ADD CONSTRAINT `tblboekingen_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `tblstudenten` (`studentID`),
ADD CONSTRAINT `tblboekingen_ibfk_3` FOREIGN KEY (`buddieID`) REFERENCES `tblbuddies` (`buddieID`);
