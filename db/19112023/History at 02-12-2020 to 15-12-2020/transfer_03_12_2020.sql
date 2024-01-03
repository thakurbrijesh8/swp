-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 06:56 AM
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
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `taluka` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `village` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `plot_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `survey_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admeasuring_square_metre` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `govt_industrial_estate_area` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reason_of_transfer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `transferer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_servicing` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `other_services` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aadhar_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pan_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gst_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_letter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_letter_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_report` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_report_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `constitution_project` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `constitution_project_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_authorization` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_authorization_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sign_seal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
