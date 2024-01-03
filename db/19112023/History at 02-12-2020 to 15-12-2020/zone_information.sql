ALTER TABLE `site_elevation`
ADD `survey_no` varchar(50) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `pts_no`;

ALTER TABLE `zone_information`
ADD `survey_no` varchar(50) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `pts_no`;


ALTER TABLE `construction`
ADD `valid_upto_date` date NOT NULL AFTER `application_date`,
ADD `annexureV` tinyint(1) NOT NULL AFTER `annexure_IV`;



-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 07:27 AM
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
-- Table structure for table `zone_information`
--

CREATE TABLE `zone_information` (
  `zone_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `application_date` date NOT NULL,
  `pts_no` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `site_plan` varchar(255) NOT NULL,
  `I_XIV_nakal` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
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
  `query_status` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone_information`
--

INSERT INTO `zone_information` (`zone_id`, `user_id`, `name_of_applicant`, `address`, `mobile_no`, `application_date`, `pts_no`, `village`, `site_plan`, `I_XIV_nakal`, `signature`, `status`, `status_datetime`, `submitted_datetime`, `processing_days`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `admin_registration_number`, `valid_upto`, `remarks`, `query_status`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 1, 'Vijeta', 'Daman', '7567509586', '2020-12-11', '456', 'Daman', 'zone_2055840511607663161.pdf', 'zone_4061061371607663161.pdf', 'zone_3127651561607663161.png', 5, '2020-12-11 10:39:38', '2020-12-11 10:36:28', 1, 'challan_1924728861607663288.png', '2020-12-11 10:38:08', 'fees_paid_challan_5873341451607663307.png', '2020-12-11 10:38:27', '554', '2020-12-11', 'ok', '3', 1, '2020-12-11 10:36:49', 1, '2020-12-11 10:39:38', 0),
(2, 1, 'Demo1', 'Daman', '7567509756', '2020-12-11', '456', 'Daman', 'zone_2813950991607663183.pdf', 'zone_6692642131607663183.pdf', 'zone_1402617831607663183.png', 6, '2020-12-11 10:41:05', '2020-12-11 10:36:23', 1, 'challan_4499149241607663391.png', '2020-12-11 10:39:51', 'fees_paid_challan_1059790381607663403.png', '2020-12-11 10:40:03', '', '0000-00-00', 'ok', '', 1, '2020-12-11 10:36:23', 1, '2020-12-11 10:41:05', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zone_information`
--
ALTER TABLE `zone_information`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zone_information`
--
ALTER TABLE `zone_information`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
