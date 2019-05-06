-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2018 at 06:15 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `password`) VALUES
('HR', 'humanresource');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(11) NOT NULL,
  `employee_no` varchar(60) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `amount` int(11) NOT NULL,
  `reason` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `employee_no`, `user_name`, `amount`, `reason`, `status`) VALUES
(1, '001', 'GEORGE GACHIRI NJOROGE NJOROGE', 0, '', ''),
(2, '001', 'GEORGE GACHIRI NJOROGE', 17000, 'School fees', 'denied'),
(3, '001', 'GEORGE GACHIRI NJOROGE', 1700, 'School fees', 'approved'),
(4, '001', 'GEORGE GACHIRI NJOROGE', 2000, 'Emergency', 'approved'),
(5, '002', 'VIOLA MELI CHEROTICH CHEROTICH', 0, '', ''),
(6, '002', 'VIOLA MELI CHEROTICH', 2000, 'Emergency', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL,
  `employee_no` varchar(60) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `second_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `id_no` int(15) NOT NULL,
  `employee_rank` varchar(20) NOT NULL,
  `acount_no` varchar(60) NOT NULL,
  `bank_name` varchar(25) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `email_adress` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `place_of_residence` varchar(220) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_no`, `first_name`, `second_name`, `last_name`, `id_no`, `employee_rank`, `acount_no`, `bank_name`, `phone_no`, `email_adress`, `gender`, `date_of_birth`, `place_of_residence`, `religion`, `password`, `status`) VALUES
(1, '001', 'GEORGE', 'GACHIRI', 'NJOROGE', 33751181, '', '8765424526', 'EQUITY', 707440470, 'loxgachirigee@gmail.com', 'MALE', '1999-06-10', 'Makueni', 'CHRISTIAN', '33751181', 'verified'),
(2, '002', 'VIOLA', 'MELI', 'CHEROTICH', 33277382, '', '784645273', 'KCB', 710394648, 'vee@gmail.com', 'FEMALE', '1999-08-19', '', '', '33277382', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE IF NOT EXISTS `finance` (
  `employee_no` varchar(60) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `house_allowance` int(11) NOT NULL,
  `transport_allowance` int(11) NOT NULL,
  `overtime_rate` int(11) NOT NULL,
  `advance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`employee_no`, `basic_salary`, `house_allowance`, `transport_allowance`, `overtime_rate`, `advance`) VALUES
('001', 70000, 10000, 15000, 100, 0),
('002', 50000, 10000, 15000, 80, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL,
  `employee_no` varchar(60) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `house_allowance` int(11) NOT NULL,
  `transport_allowance` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  `gross_pay` int(11) NOT NULL,
  `paye` int(11) NOT NULL,
  `nssf` int(11) NOT NULL,
  `nhif` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `total_deductions` int(11) NOT NULL,
  `net_pay` int(11) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `employee_no`, `user_name`, `basic_salary`, `house_allowance`, `transport_allowance`, `overtime`, `gross_pay`, `paye`, `nssf`, `nhif`, `advance`, `total_deductions`, `net_pay`, `status`) VALUES
(1, '001', 'GEORGE GACHIRI NJOROGE', 70000, 10000, 15000, 1000, 96000, 21060, 1080, 1600, 3700, 27440, 68560, 'completed'),
(2, '002', 'VIOLA MELI CHEROTICH', 50000, 10000, 15000, 800, 75800, 15000, 1080, 1400, 2000, 19480, 56320, 'completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD UNIQUE KEY `employee_no` (`employee_no`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
