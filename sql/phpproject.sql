-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2015 at 04:42 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
  `datumID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbldatums`
--

CREATE TABLE `tbldatums` (
`datumID` int(11) NOT NULL,
  `datumDag` varchar(250) NOT NULL,
  `datumMaand` varchar(250) NOT NULL,
  `datumJaar` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldatums`
--

INSERT INTO `tbldatums` (`datumID`, `datumDag`, `datumMaand`, `datumJaar`) VALUES
(7, '1', 'Januari', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `tblmessages`
--

CREATE TABLE `tblmessages` (
`messageID` int(11) NOT NULL,
  `messageText` varchar(200) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblreacties`
--

CREATE TABLE `tblreacties` (
`reactiesID` int(11) NOT NULL,
  `reactiesNaam` varchar(250) NOT NULL,
  `reactiesComment` text NOT NULL,
  `reactiesMail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreacties`
--

INSERT INTO `tblreacties` (`reactiesID`, `reactiesNaam`, `reactiesComment`, `reactiesMail`) VALUES
(6, 'Tom', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com'),
(7, 'Shane', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com'),
(8, 'Vincent', 'Dag verliep goed. Buddie werkte goed mee.', 'tom.dirix@gmail.com');

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

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
`id` int(20) NOT NULL,
  `fbid` bigint(20) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `fbid`, `fullname`, `email`) VALUES
(1, 1381149482214525, 'Vincent Van Loock', 'rentastudentthomasmore@gmail.com'),
(2, 10205395106350448, 'NoÃ« Baeten', 'baeten_link@hotmail.com');

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
 ADD PRIMARY KEY (`boekingID`), ADD UNIQUE KEY `datum` (`datumID`), ADD UNIQUE KEY `student` (`studentID`), ADD UNIQUE KEY `buddie` (`buddieID`);

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
-- Indexes for table `tblmessages`
--
ALTER TABLE `tblmessages`
 ADD PRIMARY KEY (`messageID`), ADD UNIQUE KEY `sec` (`buddieID`), ADD UNIQUE KEY `studentID` (`studentID`);

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
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `datumID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblmessages`
--
ALTER TABLE `tblmessages`
MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblreacties`
--
ALTER TABLE `tblreacties`
MODIFY `reactiesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblstudenten`
--
ALTER TABLE `tblstudenten`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblboekingen`
--
ALTER TABLE `tblboekingen`
ADD CONSTRAINT `tblboekingen_ibfk_3` FOREIGN KEY (`buddieID`) REFERENCES `tblbuddies` (`buddieID`),
ADD CONSTRAINT `tblboekingen_ibfk_1` FOREIGN KEY (`datumID`) REFERENCES `tbldatums` (`datumID`),
ADD CONSTRAINT `tblboekingen_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `tblstudenten` (`studentID`);

--
-- Constraints for table `tblmessages`
--
ALTER TABLE `tblmessages`
ADD CONSTRAINT `tblmessages_ibfk_2` FOREIGN KEY (`buddieID`) REFERENCES `tblstudenten` (`studentID`),
ADD CONSTRAINT `tblmessages_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `tblbuddies` (`buddieID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
