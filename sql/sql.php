-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2015 at 07:16 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminID`, `adminNaam`, `adminVoornaam`, `adminEmail`, `adminPassword`) VALUES
(36, 'Noe', 'baeten', 'noe.baeten@gmail.com', '$2y$11$YPsejjM5n3Pho2sGYN8Py./WJBSiFq.oodki1VFHIrLYVucU2NijS'),
(38, 'Joris', 'Hens', 'joris.hens@gmail.com', '$2y$11$3ktmsfa.I4wR094ZsS9FV.JLbPZ1qJkMuX9NnzQlQOdiY.E9V5Au.');

-- --------------------------------------------------------

--
-- Table structure for table `tblboekingen`
--

CREATE TABLE `tblboekingen` (
`boekingID` int(11) NOT NULL,
  `datumID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `buddieID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblboekingen`
--

INSERT INTO `tblboekingen` (`boekingID`, `datumID`, `studentID`, `buddieID`) VALUES
(71, 13, 5, 22),
(72, 16, 5, 27);

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbuddies`
--

INSERT INTO `tblbuddies` (`buddieID`, `buddieNaam`, `buddieVoornaam`, `buddieTwitter`, `buddieEmail`, `buddiePassword`, `buddieJaar`, `buddieRichting`, `buddieRating`, `buddieLeeftijd`, `buddieFoto`) VALUES
(22, 'Rymenams', 'Shane', '@ShaneRymenams', 'shane.rymenams@gmail.com', '$2y$11$THTPR7ABFTMF1n7py31x7ObiPKF5XHfKsqrm8/np3FBMfY8HMcOzy', '3', '1', 0, 0, 'images/profpics/shane.rymenams@gmail.com/student1.jpg'),
(26, 'Van Loock', 'Vincent', '@VincentVanLoock', 'vincent.vanloock@gmail.com', '$2y$11$LekBWEsq6AnuvTYYK3ofAOixF/JjzHW.n3hZ3yvorH27UcS3PW62a', '3', '1', 0, 0, 'images/profpics/vincent.vanloock@gmail.com/student3.jpg'),
(27, 'Berghmans', 'Rutger', '@RutgerBerghmans', 'rutger@gmail.com', '$2y$11$S2w9GjZ88lCCnR.mA7oSWuqm/9bbE8IbBt97ScG7Ohbau/.HChary', '2', '1', 0, 0, 'images/profpics/rutger@gmail.com/student2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbldatums`
--

CREATE TABLE `tbldatums` (
`datumID` int(11) NOT NULL,
  `datumDag` varchar(250) NOT NULL,
  `datumMaand` varchar(250) NOT NULL,
  `datumJaar` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldatums`
--

INSERT INTO `tbldatums` (`datumID`, `datumDag`, `datumMaand`, `datumJaar`) VALUES
(13, '20', 'Mei', '2015'),
(14, '25', 'Mei', '2015'),
(16, '26', 'Juni', '2015');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreacties`
--

INSERT INTO `tblreacties` (`reactiesID`, `reactiesNaam`, `reactiesComment`, `reactiesMail`) VALUES
(10, 'Tom Dirix', 'Dag verliep goed. Buddy werkte goed mee en was vriendelijk', 'tom.dirix@gmail.com'),
(11, 'Shane Rymenams', 'Dag verliep slecht. Buddy werkte niet mee', 'shane.rymenams@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudenten`
--

CREATE TABLE `tblstudenten` (
`studentID` int(11) NOT NULL,
  `fbid` bigint(20) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudenten`
--

INSERT INTO `tblstudenten` (`studentID`, `fbid`, `fullname`, `email`) VALUES
(3, 10205395106350448, 'NoÃ« Baeten', 'baeten_link@hotmail.com'),
(5, 1381149482214525, 'Vincent Van Loock', 'rentastudentthomasmore@gmail.com');

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
 ADD PRIMARY KEY (`boekingID`), ADD KEY `datum` (`datumID`), ADD KEY `student` (`studentID`), ADD KEY `buddie` (`buddieID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `tblboekingen`
--
ALTER TABLE `tblboekingen`
MODIFY `boekingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `tblbuddies`
--
ALTER TABLE `tblbuddies`
MODIFY `buddieID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbldatums`
--
ALTER TABLE `tbldatums`
MODIFY `datumID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tblmessages`
--
ALTER TABLE `tblmessages`
MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblreacties`
--
ALTER TABLE `tblreacties`
MODIFY `reactiesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tblstudenten`
--
ALTER TABLE `tblstudenten`
MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblboekingen`
--
ALTER TABLE `tblboekingen`
ADD CONSTRAINT `tblboekingen_ibfk_1` FOREIGN KEY (`datumID`) REFERENCES `tbldatums` (`datumID`) ON UPDATE CASCADE,
ADD CONSTRAINT `tblboekingen_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `tblstudenten` (`studentID`) ON UPDATE CASCADE,
ADD CONSTRAINT `tblboekingen_ibfk_3` FOREIGN KEY (`buddieID`) REFERENCES `tblbuddies` (`buddieID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmessages`
--
ALTER TABLE `tblmessages`
ADD CONSTRAINT `tblmessages_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `tblbuddies` (`buddieID`),
ADD CONSTRAINT `tblmessages_ibfk_2` FOREIGN KEY (`buddieID`) REFERENCES `tblstudenten` (`studentID`);
