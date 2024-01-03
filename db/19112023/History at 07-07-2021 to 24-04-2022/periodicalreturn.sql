-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 04:03 PM
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
-- Table structure for table `periodicalreturn`
--

CREATE TABLE `periodicalreturn` (
  `periodicalreturn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `application_category` varchar(100) NOT NULL,
  `name_of_applicant` varchar(200) NOT NULL,
  `application_date` datetime NOT NULL,
  `applicant_address` varchar(255) NOT NULL,
  `applicant_licence_no` varchar(255) NOT NULL,
  `applicant_licence_date` date NOT NULL,
  `description_wm` varchar(255) NOT NULL,
  `period_validity_licence` varchar(255) NOT NULL,
  `suspending_revoke` varchar(255) NOT NULL,
  `category_of_wm` varchar(255) NOT NULL,
  `proprietor_details` longtext NOT NULL,
  `other_details` longtext NOT NULL,
  `manufacturer_details` longtext NOT NULL,
  `manufacturertwo_details` longtext NOT NULL,
  `repairer_details` longtext NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `admin_registration_number` int(11) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `user_payment_type` tinyint(1) NOT NULL,
  `query_status` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `periodicalreturn`
--
ALTER TABLE `periodicalreturn`
  ADD PRIMARY KEY (`periodicalreturn_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `periodicalreturn`
--
ALTER TABLE `periodicalreturn`
  MODIFY `periodicalreturn_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
