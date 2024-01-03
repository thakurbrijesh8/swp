-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2020 at 06:59 AM
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
-- Table structure for table `appli_licence`
--

CREATE TABLE `appli_licence` (
  `aplicence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contractor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_fathername` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contractor_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `establi_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `establi_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_certificate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_certificate` date NOT NULL,
  `employer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `employer_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nature_of_process_for_establi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nature_of_process_for_labour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration_of_work` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_agent` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address_of_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_no_of_empl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `if_contractor_work_other_place` tinyint(1) NOT NULL,
  `detail_of_other_work` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estimeted_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `treasury_receipt_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_treasury_receipt` date NOT NULL,
  `formv_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formiv_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `register_certification_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
-- Indexes for dumped tables
--

--
-- Indexes for table `appli_licence`
--
ALTER TABLE `appli_licence`
  ADD PRIMARY KEY (`aplicence_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appli_licence`
--
ALTER TABLE `appli_licence`
  MODIFY `aplicence_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
