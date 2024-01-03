-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 12:12 PM
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
-- Table structure for table `sub_lessee`
--

CREATE TABLE `sub_lessee` (
  `sublessee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `taluka` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `plot_no` varchar(255) NOT NULL,
  `survey_no` varchar(255) NOT NULL,
  `admeasuring` varchar(255) NOT NULL,
  `estate_area` varchar(255) NOT NULL,
  `name_of_manufacturing` varchar(255) NOT NULL,
  `request_letter` tinyint(1) NOT NULL,
  `request_letter_manufacture` varchar(255) NOT NULL,
  `detail_project` tinyint(1) NOT NULL,
  `detail_project_report` varchar(255) NOT NULL,
  `partnership_deed` tinyint(1) NOT NULL,
  `memorandum_partnership_deed` varchar(255) NOT NULL,
  `sign_sublessee` tinyint(1) NOT NULL,
  `behalf_sign_sublessee` varchar(255) NOT NULL,
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
-- Indexes for table `sub_lessee`
--
ALTER TABLE `sub_lessee`
  ADD PRIMARY KEY (`sublessee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_lessee`
--
ALTER TABLE `sub_lessee`
  MODIFY `sublessee_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
