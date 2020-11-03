-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 08:02 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicaldatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors table`
--

CREATE TABLE `doctors table` (
  `Doctor_ID` int(6) NOT NULL,
  `Doctor Name` varchar(100) NOT NULL,
  `LoginIDNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors table`
--

INSERT INTO `doctors table` (`Doctor_ID`, `Doctor Name`, `LoginIDNumber`) VALUES
(5, 'Dr Jane Miller', 30),
(6, 'Dr. John Miller', 31),
(7, 'Dr John Doe', 34);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Doctor` tinyint(1) NOT NULL,
  `IDnumber` varchar(10) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `LoginIDnumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`Username`, `Password`, `Doctor`, `IDnumber`, `admin`, `LoginIDnumber`) VALUES
('admin', '$2y$10$f4jnX6UO5U9k3dy5CHC3futVwbV69WzzlQr9gMWxCIegheAqcchy6', 0, '', 1, 21),
('', '', 0, 'A123456789', 0, 25),
('DrJaneMiller', '$2y$10$D1UvjOxpEv6Iop9WC2i58e8YITav74XGy.9GpOloMDTJ6SCms5K/i', 1, '', 0, 30),
('DrJohnMiller', '$2y$10$Z5zc0taK64nDkUacX/aRHuXvFVPIH8gaS7VIc3uMwB4ynHhwoX0ey', 1, '', 0, 31),
('JohnMiller', '$2y$10$mzVeytYvo7b4XS3JN3lDVeLd/f/MUXZf76V/oN.MTLV99Q34h4dFG', 0, '', 0, 32),
('user', '$2y$10$aNq24HctlR7vUJdvKl9F6OimhPIZEnqYpAE6E5Gzqdu/d6xovj9BW', 0, '', 0, 33),
('DrJohnDoe', '$2y$10$zrkiye38ixXRxDcZzlMsFecc4AA6LZpge2kpKSdNsZI29EmL/3t46', 1, '', 0, 34);

-- --------------------------------------------------------

--
-- Table structure for table `patient registration`
--

CREATE TABLE `patient registration` (
  `todaysdate` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middleinitial` varchar(100) NOT NULL,
  `streetaddress` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` int(25) NOT NULL,
  `homephone` varchar(100) NOT NULL,
  `workphone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailchoice` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `Patient_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient registration`
--

INSERT INTO `patient registration` (`todaysdate`, `firstname`, `lastname`, `middleinitial`, `streetaddress`, `city`, `state`, `zip`, `homephone`, `workphone`, `email`, `emailchoice`, `dob`, `sex`, `Patient_ID`) VALUES
('2020-11-02', 'John', 'Miller', 'J', '321 Mainstreet', 'Cityville', 'GA', 14321, '123-456-7890', '098-765-4321', 'Johnmiller12@email.com', 'yes', '2020-11-18', 'M', 4),
('2020-11-01', 'David', 'Smith', 'j', '123 Main St.', 'Townsville', 'AL', 12345, '123-456-7890', '098-765-4321', 'DavidSmith@email.com', 'yes', '2020-11-01', 'M', 5);

-- --------------------------------------------------------

--
-- Table structure for table `patients table`
--

CREATE TABLE `patients table` (
  `Patient_ID` int(6) NOT NULL,
  `Patient Name` varchar(100) NOT NULL,
  `Doctor_ID` int(6) DEFAULT NULL,
  `LoginIDnumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients table`
--

INSERT INTO `patients table` (`Patient_ID`, `Patient Name`, `Doctor_ID`, `LoginIDnumber`) VALUES
(4, 'John Miller', 5, 32),
(5, 'David Smith', 7, 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors table`
--
ALTER TABLE `doctors table`
  ADD PRIMARY KEY (`Doctor_ID`),
  ADD KEY `Doctor_ID` (`Doctor_ID`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`LoginIDnumber`);

--
-- Indexes for table `patient registration`
--
ALTER TABLE `patient registration`
  ADD PRIMARY KEY (`Patient_ID`);

--
-- Indexes for table `patients table`
--
ALTER TABLE `patients table`
  ADD PRIMARY KEY (`Patient_ID`),
  ADD KEY `Patient_ID` (`Patient_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors table`
--
ALTER TABLE `doctors table`
  MODIFY `Doctor_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `LoginIDnumber` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `patients table`
--
ALTER TABLE `patients table`
  MODIFY `Patient_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
