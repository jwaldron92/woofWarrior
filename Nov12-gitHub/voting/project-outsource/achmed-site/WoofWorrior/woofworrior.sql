-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2015 at 04:53 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `woofworrior`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `ImageID` int(11) NOT NULL COMMENT 'incremental image id',
  `UserID` int(11) NOT NULL COMMENT 'id of uploaded user',
  `Description` varchar(100) NOT NULL COMMENT 'description of an image',
  `Location` varchar(100) NOT NULL COMMENT 'path of that image'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='stores the uploaded image along with description and path and information about the uploaded user';

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ImageID`, `UserID`, `Description`, `Location`) VALUES
(1, 2, 'Testing', 'C:/xampp/htdocs/WoofWorrior/Gallery/haziqahmed92gmailcom/woofWoff.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` bigint(20) NOT NULL COMMENT 'Incremental UserID',
  `UserName` varchar(20) NOT NULL COMMENT 'Username of the authticated facebook profile'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Store the authenticated users after successfully login into facebook';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`) VALUES
(2, 'haziqahmed92gmailcom');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `VoteID` bigint(20) NOT NULL COMMENT 'incremental id of vote',
  `UserID` bigint(20) NOT NULL COMMENT 'user id that has up voted',
  `ImageID` bigint(20) NOT NULL COMMENT 'image that is voted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='records the number of votes of an particular image along with the description of the voter';

-- --------------------------------------------------------

--
-- Table structure for table `voteimage`
--

CREATE TABLE IF NOT EXISTS `voteimage` (
  `ID` bigint(20) NOT NULL COMMENT 'incremental unique id',
  `ImageID` bigint(20) NOT NULL COMMENT 'image id of particular image',
  `Vote` bigint(20) NOT NULL COMMENT 'records total vote count of an image'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores total vote count against image';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`VoteID`);

--
-- Indexes for table `voteimage`
--
ALTER TABLE `voteimage`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'incremental image id',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Incremental UserID',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `VoteID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'incremental id of vote';
--
-- AUTO_INCREMENT for table `voteimage`
--
ALTER TABLE `voteimage`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'incremental unique id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
