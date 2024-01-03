-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2021 at 06:42 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `query_grievance`
--

CREATE TABLE `query_grievance` (
  `query_grievance_id` int(11) NOT NULL,
  `query_reference_number` varchar(255) NOT NULL,
  `district` int(11) NOT NULL,
  `issue_category` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `mobile_no` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `application_no` varchar(255) NOT NULL,
  `query` varchar(500) NOT NULL,
  `query_response` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query_grievance`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `query_grievance`
--
ALTER TABLE `query_grievance`
  ADD PRIMARY KEY (`query_grievance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `query_grievance`
--
ALTER TABLE `query_grievance`
  MODIFY `query_grievance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `query_grievance` ADD `other_department` VARCHAR(255) NOT NULL AFTER `department`;