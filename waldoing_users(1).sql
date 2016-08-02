-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql1.woofwarrior.com
-- Generation Time: Aug 02, 2016 at 11:25 AM
-- Server version: 5.6.25-log
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waldoing_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `forgot_id` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `expired` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_pic`
--

CREATE TABLE `profile_pic` (
  `pic_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `pic_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `scoreID` int(50) NOT NULL,
  `userID` int(50) NOT NULL,
  `scoreAmount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `signup_date`
--

CREATE TABLE `signup_date` (
  `signupID` int(50) NOT NULL,
  `userID` int(50) NOT NULL,
  `signupDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE `url` (
  `urlID` int(50) NOT NULL,
  `userID` int(50) NOT NULL,
  `urlAdress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `userFBID` varchar(50) DEFAULT NULL,
  `userFBNAME` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verify_email`
--

CREATE TABLE `verify_email` (
  `verify_id` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`forgot_id`);

--
-- Indexes for table `profile_pic`
--
ALTER TABLE `profile_pic`
  ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`scoreID`);

--
-- Indexes for table `signup_date`
--
ALTER TABLE `signup_date`
  ADD PRIMARY KEY (`signupID`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`urlID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `verify_email`
--
ALTER TABLE `verify_email`
  ADD PRIMARY KEY (`verify_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `forgot_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profile_pic`
--
ALTER TABLE `profile_pic`
  MODIFY `pic_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `scoreID` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `signup_date`
--
ALTER TABLE `signup_date`
  MODIFY `signupID` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `url`
--
ALTER TABLE `url`
  MODIFY `urlID` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `verify_id` int(50) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
