-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2021 at 06:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounts`
--
CREATE DATABASE IF NOT EXISTS `accounts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `accounts`;

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE `Accounts` (
  `ID` int(11) NOT NULL,
  `NAME` text NOT NULL,
  `AGE` date NOT NULL,
  `EMAIL` text NOT NULL,
  `PASSWORD` text NOT NULL,
  `ROLE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`ID`, `NAME`, `AGE`, `EMAIL`, `PASSWORD`, `ROLE`) VALUES
(8, 'Abbass jaafar ', '2021-04-26', '41930053@students.liu.edu.lb', '1111', 'ADMIN'),
(9, 'alaa Jaafar 11', '2021-04-29', 'aj6319688@gmail.com', 'aaa', 'USER'),
(15, 'ali ', '2021-05-13', 'aj655@gmail.com', 'aaaa', 'USER'),
(16, 'ali ', '2021-05-05', 'aj@gmail.com', 'aaaa', 'USER'),
(17, 'ali ', '2021-05-06', 'aj333@gmail.com', 'aaa', 'USER'),
(19, 'alaa jaaafra11', '2021-05-08', 'aj@hda.com', 'aaa', 'USER'),
(20, 'alaa jaafar', '2021-05-12', 'adsad@gami.com', 'dwad', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `ToDoList`
--

CREATE TABLE `ToDoList` (
  `id` int(11) NOT NULL,
  `text` varchar(999) NOT NULL,
  `userID` int(11) NOT NULL,
  `status` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ToDoList`
--

INSERT INTO `ToDoList` (`id`, `text`, `userID`, `status`) VALUES
(34, 'my name is alaa', 8, 'DONE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ToDoList`
--
ALTER TABLE `ToDoList`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ToDoList_ibfk_1` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accounts`
--
ALTER TABLE `Accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ToDoList`
--
ALTER TABLE `ToDoList`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ToDoList`
--
ALTER TABLE `ToDoList`
  ADD CONSTRAINT `ToDoList_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Accounts` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
