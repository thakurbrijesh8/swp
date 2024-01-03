-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 12:35 PM
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
-- Table structure for table `sub_letting`
--

CREATE TABLE `sub_letting` (
  `subletting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `taluka` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `application_date` varchar(255) NOT NULL,
  `plot_no` varchar(255) NOT NULL,
  `survey_no` varchar(255) NOT NULL,
  `admeasuring` varchar(255) NOT NULL,
  `govt_industrial_estate_area` varchar(255) NOT NULL,
  `name_of_manufacturing` varchar(255) NOT NULL,
  `request_letter` tinyint(1) NOT NULL,
  `request_letter_premises` varchar(255) NOT NULL,
  `original_extract` tinyint(1) NOT NULL,
  `original_extract_certificate` varchar(255) NOT NULL,
  `land_revenue` tinyint(1) NOT NULL,
  `land_revenue_certificate` varchar(255) NOT NULL,
  `electricity_bill` tinyint(1) NOT NULL,
  `electricity_bill_certificate` varchar(255) NOT NULL,
  `bank_loan` tinyint(1) NOT NULL,
  `bank_loan_certificate` varchar(255) NOT NULL,
  `panchayat_tax` tinyint(1) NOT NULL,
  `panchayat_tax_certificate` varchar(255) NOT NULL,
  `challan_of_lease` tinyint(1) NOT NULL,
  `challan_of_lease_rent` varchar(255) NOT NULL,
  `occupancy` tinyint(1) NOT NULL,
  `occupancy_certificate` varchar(255) NOT NULL,
  `central_excise` tinyint(1) NOT NULL,
  `central_excise_certificate` varchar(255) NOT NULL,
  `authorization_sign` tinyint(1) NOT NULL,
  `authorization_sign_lessee` varchar(255) NOT NULL,
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
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_letting`
--
ALTER TABLE `sub_letting`
  ADD PRIMARY KEY (`subletting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_letting`
--
ALTER TABLE `sub_letting`
  MODIFY `subletting_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
