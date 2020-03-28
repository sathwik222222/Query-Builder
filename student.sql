-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 12:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `FIRST_NAME` varchar(20) NOT NULL,
  `LAST_NAME` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `student_no` varchar(10) DEFAULT NULL,
  `module_code` varchar(8) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`student_no`, `module_code`, `mark`) VALUES
('20060101', 'CM0001', 80),
('20060101', 'CM0002', 65),
('20060101', 'CM0003', 50),
('20060102', 'CM0001', 75),
('20060102', 'CM0003', 45),
('20060102', 'CM0004', 70),
('20060103', 'CM0001', 60),
('20060103', 'CM0002', 75),
('20060103', 'CM0004', 60),
('20060104', 'CM0001', 55),
('20060104', 'CM0002', 40),
('20060104', 'CM0003', 45),
('20060105', 'CM0001', 55),
('20060105', 'CM0002', 50),
('20060105', 'CM0004', 65);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_code` varchar(8) DEFAULT NULL,
  `module_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_code`, `module_name`) VALUES
('CM0001', 'Databases'),
('CM0002', 'Programming Language'),
('CM0003', 'Operating Systems'),
('CM0004', 'Graphics');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_no` varchar(10) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `forename` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_no`, `surname`, `forename`) VALUES
('20060101', 'Dickens', 'Charles'),
('20060102', 'ApGwilym', 'Dafydd'),
('20060103', 'Zola', 'Emile'),
('20060104', 'Mann', 'Thomas'),
('20060105', 'Stevenson', 'Robert'),
('16K41A0531', 'Kunduru', 'Sathwik'),
('16K41A0532', 'Kunduru', 'Lahari'),
('16K41A0533', 'Mallela', 'Mounika'),
('16K41A0502', NULL, 'Sindhu'),
('16K41A0502', NULL, 'Navya'),
('16K41A0503', NULL, 'Praveen'),
('16K41A0504', 'Arruru', 'Usha'),
('16K41A0506', 'Beditha', 'Nithin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
