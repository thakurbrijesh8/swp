ALTER TABLE `construction`
CHANGE `amalgamation_order` `amalgamation_order` varchar(255) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `amalgamation`;



-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 07:26 AM
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
-- Table structure for table `construction`
--

CREATE TABLE `construction` (
  `construction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_owner` varchar(255) NOT NULL,
  `address_of_owner` varchar(255) NOT NULL,
  `building_no` varchar(100) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `revenue_no` varchar(100) NOT NULL,
  `cts_no` varchar(100) NOT NULL,
  `road_street` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `license_no` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `annexure_III` varchar(255) NOT NULL,
  `annexure_IV` varchar(255) NOT NULL,
  `annexure_V` varchar(255) NOT NULL,
  `copy_of_na` varchar(255) NOT NULL,
  `original_certified_map` varchar(255) NOT NULL,
  `I_and_XIV_nakal` varchar(255) NOT NULL,
  `building_plan_dcr` varchar(255) NOT NULL,
  `cost_estimate` varchar(255) NOT NULL,
  `noc_coast_guard` varchar(255) NOT NULL,
  `provisional_noc` tinyint(1) NOT NULL,
  `provisional_noc_fire` varchar(255) NOT NULL,
  `crz_clearance` tinyint(1) NOT NULL,
  `crz_clearance_certificate` varchar(255) NOT NULL,
  `sub_division` tinyint(1) NOT NULL,
  `sub_division_order` varchar(255) NOT NULL,
  `amalgamation` tinyint(1) NOT NULL,
  `amalgamation_order` varchar(25) NOT NULL,
  `occupancy` tinyint(1) NOT NULL,
  `occupancy_certificate` varchar(255) NOT NULL,
  `certificate_land` tinyint(1) NOT NULL,
  `certificate_land_acquisition` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_datetime` datetime NOT NULL,
  `processing_days` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `registration_number` varchar(255) NOT NULL,
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
-- Dumping data for table `construction`
--

INSERT INTO `construction` (`construction_id`, `user_id`, `name_of_owner`, `address_of_owner`, `building_no`, `plot_no`, `revenue_no`, `cts_no`, `road_street`, `village`, `name`, `license_no`, `application_date`, `annexure_III`, `annexure_IV`, `annexure_V`, `copy_of_na`, `original_certified_map`, `I_and_XIV_nakal`, `building_plan_dcr`, `cost_estimate`, `noc_coast_guard`, `provisional_noc`, `provisional_noc_fire`, `crz_clearance`, `crz_clearance_certificate`, `sub_division`, `sub_division_order`, `amalgamation`, `amalgamation_order`, `occupancy`, `occupancy_certificate`, `certificate_land`, `certificate_land_acquisition`, `signature`, `submitted_datetime`, `status`, `status_datetime`, `processing_days`, `challan`, `challan_updated_date`, `fees_paid_challan`, `fees_paid_challan_updated_date`, `registration_number`, `valid_upto`, `remarks`, `query_status`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1, 1, 'abc12', 'jg', 'j', 'ghj', 'gj', 'hg', 'jhg', 'jhg', 'jhg', 'jgj', '2020-12-10', 'construction_8368558271607599808.pdf', 'construction_4929132381607599808.pdf', 'construction_8177029051607599808.pdf', 'construction_9625148331607599808.pdf', 'construction_7959481791607599808.pdf', 'construction_1430580651607599808.pdf', 'construction_3947544161607599808.pdf', 'construction_5962979451607599808.pdf', 'construction_6020762761607599808.pdf', 0, 'provisional_noc_fire_8518421341607600468.pdf', 0, 'crz_clearance_certificate_8626532391607600468.pdf', 0, 'sub_division_order_5198570031607600468.pdf', 0, 'amalgamation_order_625695', 0, 'occupancy_certificate_1085249441607600468.pdf', 0, 'certificate_land_acquisition_5615270731607600478.pdf', 'construction_2463429871607600468.png', '2020-12-10 17:22:33', 5, '2020-12-10 17:42:05', 1, 'challan_7453376361607602269.png', '2020-12-10 17:41:09', 'fees_paid_challan_8028583271607602303.png', '2020-12-10 17:41:43', '5156', '2020-12-10', 'ok', 3, 1, '2020-12-10 17:40:02', 1, '2020-12-10 17:42:05', 0),
(2, 1, 'kj1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2020-12-11', 'construction_9580851561607664121.pdf', 'construction_4219252611607664121.pdf', 'construction_8057333261607664121.pdf', 'construction_9367627091607664121.pdf', 'construction_1622187551607664121.pdf', 'construction_7261279931607664121.pdf', 'construction_3446042131607664121.pdf', 'construction_4577696701607664121.pdf', 'construction_6337300201607664121.pdf', 0, 'provisional_noc_fire_6133084671607664161.pdf', 0, 'crz_clearance_certificate_4042092241607664161.pdf', 0, 'sub_division_order_5387224401607664161.pdf', 0, '', 0, 'occupancy_certificate_4658599011607664211.pdf', 0, 'certificate_land_acquisition_3634797741607664211.pdf', 'construction_8226885601607664121.png', '2020-12-11 10:53:37', 6, '2020-12-11 10:54:33', 1, 'challan_8178959191607664253.png', '2020-12-11 10:54:13', 'fees_paid_challan_8814831951607664262.png', '2020-12-11 10:54:22', '', '0000-00-00', 'ok', 0, 1, '2020-12-11 10:53:59', 1, '2020-12-11 10:54:33', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `construction`
--
ALTER TABLE `construction`
  ADD PRIMARY KEY (`construction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `construction`
--
ALTER TABLE `construction`
  MODIFY `construction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
