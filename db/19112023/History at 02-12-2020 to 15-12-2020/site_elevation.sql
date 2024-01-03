-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 07:26 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `site_elevation`
--

CREATE TABLE `site_elevation` (
  `site_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `application_date` date NOT NULL,
  `pts_no` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `site_plan` varchar(255) NOT NULL,
  `I_XIV_nakal` varchar(255) NOT NULL,
  `plot_area` varchar(255) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(22) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `query_status` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_elevation`
--

INSERT INTO `site_elevation` (`site_id`, `user_id`, `name_of_applicant`, `address`, `mobile_no`, `application_date`, `pts_no`, `village`, `site_plan`, `I_XIV_nakal`, `plot_area`, `fees`, `signature`, `status`, `status_datetime`, `submitted_datetime`, `processing_days`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `query_status`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 1, 'Vijeta', 'Daman', '7567509577', '2020-12-11', '879', 'Daman', 'site_2125358481607661495.pdf', 'site_8449617111607661495.pdf', '500sqm', 'Rs. 500', 'site_9224414061607661495.png', 5, '2020-12-11 10:25:05', '2020-12-11 10:09:24', 1, 'challan_4130005531607661928.png', '2020-12-11 10:15:28', 'fees_paid_challan_1944553271607662277.png', '2020-12-11 10:21:17', '5425', '2020-12-11', 'ok', '3', 1, '2020-12-11 10:10:30', 1, '2020-12-11 10:25:05', 0),
(2, 1, 'Demo1', 'Daman', '7567509586', '2020-12-11', '456', 'Daman', 'site_7154306021607661591.pdf', 'site_3259251451607661591.pdf', '501to1000sqm', 'Rs. 1000', 'site_9813688331607661591.png', 6, '2020-12-11 10:26:48', '2020-12-11 10:09:51', 1, 'challan_6511690081607662541.png', '2020-12-11 10:25:41', 'fees_paid_challan_2106788571607662550.png', '2020-12-11 10:25:50', '', '0000-00-00', 'ok', '', 1, '2020-12-11 10:09:51', 1, '2020-12-11 10:26:48', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `site_elevation`
--
ALTER TABLE `site_elevation`
  ADD PRIMARY KEY (`site_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `site_elevation`
--
ALTER TABLE `site_elevation`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
