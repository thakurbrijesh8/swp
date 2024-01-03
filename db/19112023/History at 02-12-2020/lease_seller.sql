-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 08:01 AM
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
-- Table structure for table `lease_seller`
--

CREATE TABLE `lease_seller` (
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `taluka` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `village` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plot_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `survey_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admeasuring_square_metre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `govt_Industrial_estate_area` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reason_of_transfer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `transferer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_servicing` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `udyog_aadhar_memo_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pan_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gst_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `trans_account_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `request_letter_reason` tinyint(1) NOT NULL,
  `request_letter_reason_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_extract` tinyint(1) NOT NULL,
  `original_extract_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nodue_from_mamlatdar` tinyint(1) NOT NULL,
  `nodue_from_mamlatdar_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nodue_from_electricity` tinyint(1) NOT NULL,
  `nodue_from_electricity_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nodue_from_bank` tinyint(1) NOT NULL,
  `nodue_from_bank_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nodues_from_grampanchayat` tinyint(1) NOT NULL,
  `nodues_from_grampanchayat_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_of_lease` tinyint(1) NOT NULL,
  `challan_of_lease_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occupancy_certy` tinyint(1) NOT NULL,
  `occupancy_certy_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nodue_from_excise` tinyint(1) NOT NULL,
  `nodue_from_excise_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sign_behalf_lessee` tinyint(1) NOT NULL,
  `sign_behalf_lessee_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
-- Indexes for table `lease_seller`
--
ALTER TABLE `lease_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lease_seller`
--
ALTER TABLE `lease_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
