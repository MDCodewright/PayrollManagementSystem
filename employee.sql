-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2018 at 11:12 AM
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
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `first_name` varchar(20) NOT NULL,
  `second_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `id_no` int(15) NOT NULL,
  `employee_no` varchar(20) NOT NULL,
  `employee_rank` varchar(20) NOT NULL,
  `acount_no` int(20) NOT NULL,
  `bank_name` varchar(25) NOT NULL,
  `phone_no` int(20) NOT NULL,
  `email_adress` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `place_of_residence` varchar(220) NOT NULL,
  `religion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`first_name`, `second_name`, `last_name`, `id_no`, `employee_no`, `employee_rank`, `acount_no`, `bank_name`, `phone_no`, `email_adress`, `gender`, `date_of_birth`, `place_of_residence`, `religion`) VALUES
('GEORGE', 'GACHIRI', 'NJOROGE', 33751181, 'CEO98-9008/78', 'CEO', 2147483647, 'EQUITY', 707440470, 'ggachirin@gmail.com', 'MALE', '12/06/1997', 'KIAMBU', 'CHRISTIAN'),
('KAREN', 'CHEROTICH', 'LANGAT', 35301861, 'HR102-8976/78', 'HR', 567432516, 'BARCLAYS', 714258893, 'karenchero98@gmail.com', 'FEMALE', '17/09/1998', 'BOMET', 'CHRISTIAN'),
('WENCES ', 'KIPSANG', 'CHERUIYOT', 33394163, '', '', 873563452, 'KCB', 729964654, 'newlesskipsang@gmail.com', '', '', '', ''),
('VIOLA', 'CHEROTICH', 'MELI', 33277382, '', '', 2147483647, 'COOP', 710394648, 'violameli7@gmail.com', 'FEMALE', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
