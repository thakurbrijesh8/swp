-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 03:55 AM
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
-- Table structure for table `property_registration`
--

CREATE TABLE `property_registration` (
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `party_type` tinyint(1) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `application_date` date NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `party_address` varchar(255) NOT NULL,
  `digit_mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pan_card` varchar(255) NOT NULL,
  `aadhaar_card` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `set_appointment_date` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_registration`
--

INSERT INTO `property_registration` (`property_id`, `user_id`, `party_type`, `document_type`, `application_date`, `party_name`, `party_address`, `digit_mobile_number`, `email`, `pan_card`, `aadhaar_card`, `document`, `set_appointment_date`, `signature`, `status`, `status_datetime`, `submitted_datetime`, `processing_days`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `valid_upto`, `remarks`, `query_status`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 1, 2, 'Agreement', '2020-12-07', 'hgj', 'jhgj', 'gjhg', 'jhgjhg', 'property_8261434401607287553.png', 'property_3195465521607287553.png', 'property_3298951231607287553.pdf', '', 'property_4911051911607287571.png', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '0000-00-00', '', 0, 1, '2020-12-07 02:16:11', 1, '2020-12-07 02:16:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_registration`
--
ALTER TABLE `property_registration`
  ADD PRIMARY KEY (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property_registration`
--
ALTER TABLE `property_registration`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
