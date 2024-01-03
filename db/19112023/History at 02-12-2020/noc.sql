-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 12:45 PM
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

ALTER TABLE `noc`
ADD `declaration` tinyint(1) NOT NULL AFTER `signature`;

--
-- Table structure for table `noc`
--

CREATE TABLE `noc` (
  `noc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `taluka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `village` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `loan_amount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plot_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `survey_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admeasuring_square_metre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `govt_industrial_estate_area` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `purpose_of_lease` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `loan_from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `ac_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `branch_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ifsc_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reason_of_loan_from_bank` tinyint(1) NOT NULL,
  `reason_of_loan_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_letter_of_bank` tinyint(1) NOT NULL,
  `request_letter_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `behalf_of_lessee` tinyint(1) NOT NULL,
  `behalf_of_lessee_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_undertaking` tinyint(1) NOT NULL,
  `public_undertaking_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `noc`
--
ALTER TABLE `noc`
  ADD PRIMARY KEY (`noc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `noc`
--
ALTER TABLE `noc`
  MODIFY `noc_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
