-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 08:13 AM
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
-- Table structure for table `appli_licence_renewal`
--

CREATE TABLE `appli_licence_renewal` (
  `aplicence_renewal_id` int(11) NOT NULL,
  `aplicence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_certificate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_certificate` date NOT NULL,
  `expiry_date_of_prev_licence` date NOT NULL,
  `licence_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `treasury_receipt_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_treasury_receipt` date NOT NULL,
  `formvii_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_copy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `register_certification_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
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
-- Dumping data for table `appli_licence_renewal`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `appli_licence_renewal`
--
ALTER TABLE `appli_licence_renewal`
  ADD PRIMARY KEY (`aplicence_renewal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appli_licence_renewal`
--
ALTER TABLE `appli_licence_renewal`
  MODIFY `aplicence_renewal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
