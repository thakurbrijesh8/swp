-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 11:39 AM
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
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `inspection_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `application_date` date NOT NULL,
  `plinth_column` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `zone` varchar(100) NOT NULL,
  `road` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `industrial_area` varchar(255) NOT NULL,
  `communication_number` varchar(100) NOT NULL,
  `dated` date NOT NULL,
  `declaration` int(11) NOT NULL,
  `name_licensed` varchar(255) NOT NULL,
  `registration_no` varchar(100) NOT NULL,
  `valid_upto_date` date NOT NULL,
  `signature_architecture` varchar(255) NOT NULL,
  `sign_seal` varchar(255) NOT NULL,
  `approved_license` varchar(255) NOT NULL,
  `annexure_9` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`inspection_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `inspection_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
