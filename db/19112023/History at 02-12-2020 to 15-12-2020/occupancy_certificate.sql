-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 10:20 AM
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
-- Table structure for table `occupancy_certificate`
--

CREATE TABLE `occupancy_certificate` (
  `occupancy_certificate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plot_no` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `situated_at` varchar(255) NOT NULL,
  `completion_date` date NOT NULL,
  `licensed_engineer_name` varchar(255) NOT NULL,
  `licensed_engineer_signature` varchar(255) NOT NULL,
  `owner_signature` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `occupancy_registration_no` varchar(255) NOT NULL,
  `occupancy_valid_upto` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `copy_of_construction_permission` varchar(255) NOT NULL,
  `copy_of_building_plan` varchar(255) NOT NULL,
  `stability_certificate` varchar(255) NOT NULL,
  `building_height_noc` varchar(255) NOT NULL,
  `fire_noc` varchar(255) NOT NULL,
  `copy_of_water_harvesting` varchar(255) NOT NULL,
  `existing_building_plan` varchar(255) NOT NULL,
  `form_of_indemnity` varchar(255) NOT NULL,
  `annexure_sixteen` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupancy_certificate`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `occupancy_certificate`
--
ALTER TABLE `occupancy_certificate`
  ADD PRIMARY KEY (`occupancy_certificate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `occupancy_certificate`
--
ALTER TABLE `occupancy_certificate`
  MODIFY `occupancy_certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `occupancy_certificate` ADD `completed_on` DATE NOT NULL AFTER `completion_date`;
ALTER TABLE `occupancy_certificate` ADD `survey_no` varchar(255) NOT NULL, AFTER `user_id`;

ALTER TABLE `occupancy_certificate` ADD `is_fire_noc` INT NOT NULL AFTER `annexure_sixteen`, ADD `is_existing_building_plan` INT NOT NULL AFTER `is_fire_noc`, ADD `is_form_of_indemnity` INT NOT NULL AFTER `is_existing_building_plan`;