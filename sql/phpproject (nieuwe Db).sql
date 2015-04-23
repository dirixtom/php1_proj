-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2015 at 10:39 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
`adminID` int(11) NOT NULL,
  `adminNaam` varchar(250) NOT NULL,
  `adminVoornaam` varchar(250) NOT NULL,
  `adminEmail` varchar(250) NOT NULL,
  `adminPassword` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminID`, `adminNaam`, `adminVoornaam`, `adminEmail`, `adminPassword`) VALUES
(1, 'Baeten', 'Noe', 'noe.baeten@gmail.com', 'abs');

-- --------------------------------------------------------

--
-- Table structure for table `tblboekingen`
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
-- Dumping data for table `tblboekingen`
--

INSERT INTO `tblboekingen` (`boekingID`, `studentID`, `buddieID`, `datumID`, `boekingTijd`, `boekingNaam`, `boekingVoornaam`, `boekingDag`, `boekingMaand`, `boekingJaar`) VALUES
(1, 0, 0, 0, '00:00:00', 'Dirix', 'Tom', '1', 'Januari', '2016'),
(2, 0, 0, 0, '00:00:00', 'Baeten', 'Noe', '6', 'Maart', '2016'),
(3, 0, 0, 0, '00:00:00', 'Blabla', 'Blaaaa', '9', 'Mei', '2016');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuddies`
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
-- Dumping data for table `tblbuddies`
--

INSERT INTO `tblbuddies` (`buddieID`, `buddieNaam`, `buddieVoornaam`, `buddieTwitter`, `buddieEmail`, `buddiePassword`, `buddieJaar`, `buddieRichting`, `buddieRating`, `buddieLeeftijd`, `buddieFoto`) VALUES
(14, 'baeten', 'noe', '@Noebaeten', 'noe.baeten@gmail.com', 'abs', '1', '1', 0, 0, 'images/profpics/noe.baeten@gmail.com/a33GpBQ_700b.jpg'),
(15, 'baeten', 'noe', '@Noebaet', '', '', '1', '1', 0, 0, 'images/profpics/noe.baeten@gmail.com/image.jpg'),
(19, 'noe', 'noe', '@noe', 'noe@noe.com', 'abs', '1', '1', 0, 0, 'images/profpics/noe@noe.com/Tattoo idea.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbldatums`
--

CREATE TABLE `tbldatums` (
`datumID` int(11) NOT NULL,
  `datumDag` varchar(250) NOT NULL,
  `datumMaand` varchar(250) NOT NULL,
  `datumJaar` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldatums`
--

INSERT INTO `tbldatums` (`datumID`, `datumDag`, `datumMaand`, `datumJaar`) VALUES
(1, '3', 'Januari', '2015'),
(2, '6', 'Maart', '2015'),
(3, '7', 'Mei', '2015'),
(4, '8', 'Mei', '2015'),
(5, '10', 'Juli', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `tblreacties`
--

CREATE TABLE `tblreacties` (
`reactiesID` int(11) NOT NULL,
  `reactiesNaam` varchar(250) NOT NULL,
  `reactiesComment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreacties`
--

INSERT INTO `tblreacties` (`reactiesID`, `reactiesNaam`, `reactiesComment`) VALUES
(1, 'Tom', 'Dag verliep goed. Buddy werkte goed mee!'),
(2, 'Shane', 'Dag verliep slecht. Buddy is niet komen opdagen. '),
(4, 'Tom', 'Dag verliep goed. Buddy werkte goed mee!'),
(5, 'Shane', 'Dag verliep slecht. Buddy is niet komen opdagen. ');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudenten`
--

CREATE TABLE `tblstudenten` (
`studentID` int(11) NOT NULL,
  `studentNaam` varchar(250) NOT NULL,
  `studentVoornaam` varchar(250) NOT NULL,
  `studentEmail` varchar(250) NOT NULL,
  `studentPassword` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
 ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `tblboekingen`
--
ALTER TABLE `tblboekingen`
 ADD PRIMARY KEY (`boekingID`);

--
-- Indexes for table `tblbuddies`
--
ALTER TABLE `tblbuddies`
 ADD PRIMARY KEY (`buddieID`);

--
-- Indexes for table `tbldatums`
--
ALTER TABLE `tbldatums`
 ADD PRIMARY KEY (`datumID`);

--
-- Indexes for table `tblreacties`
--
ALTER TABLE `tblreacties`
 ADD PRIMARY KEY (`reactiesID`);

--
-- Indexes for table `tblstudenten`
--
ALTER TABLE `tblstudenten`
 ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblboekingen`
--
ALTER TABLE `tblboekingen`
MODIFY `boekingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblbuddies`
--
ALTER TABLE `tblbuddies`
MODIFY `buddieID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbldatums`
--
ALTER TABLE `tbldatums`
MODIFY `datumID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblreacties`
--
ALTER TABLE `tblreacties`
MODIFY `reactiesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblstudenten`
--
ALTER TABLE `tblstudenten`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
