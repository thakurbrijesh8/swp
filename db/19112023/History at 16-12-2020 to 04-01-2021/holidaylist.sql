-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 07:18 AM
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
-- Table structure for table `holidaylist`
--

CREATE TABLE `holidaylist` (
  `holiday_id` int(11) NOT NULL,
  `holiday_date` date NOT NULL,
  `holiday_desc` varchar(255) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidaylist`
--

INSERT INTO `holidaylist` (`holiday_id`, `holiday_date`, `holiday_desc`, `is_delete`) VALUES
(1, '2020-12-25', 'Christmas', 0),
(2, '2020-12-27', 'Sunday', 0),
(3, '2021-01-03', 'Sunday', 0),
(4, '2021-01-09', 'SecondSaturday', 0),
(5, '2021-01-10', 'Sunday', 0),
(6, '2021-01-17', 'Sunday', 0),
(7, '2021-01-24', 'Sunday', 0),
(8, '2021-01-26', 'Republic Day', 0),
(9, '2021-01-31', 'Sunday', 0),
(10, '2021-02-07', 'Sunday', 0),
(11, '2021-02-13', 'SecondSaturday', 0),
(12, '2021-02-14', 'Sunday', 0),
(13, '2021-02-21', 'Sunday', 0),
(14, '2021-02-28', 'Sunday', 0),
(15, '2021-03-07', 'Sunday', 0),
(16, '2021-03-11', 'Maha Shivratri', 0),
(17, '2021-03-13', 'Saturday', 0),
(18, '2021-03-14', 'Sunday', 0),
(19, '2021-03-21', 'Sunday', 0),
(20, '2021-03-28', 'Sunday', 0),
(21, '2021-03-29', 'Holi', 0),
(22, '2021-04-02', 'Good Friday', 0),
(23, '2021-04-04', 'Sunday', 0),
(24, '2021-04-10', 'Saturday', 0),
(25, '2021-04-11', 'Sunday', 0),
(26, '2021-04-13', 'Gudi Padava', 0),
(27, '2021-04-18', 'Sunday', 0),
(28, '2021-04-21', 'Ram Navami', 0),
(29, '2021-04-25', 'Sunday', 0),
(30, '2021-05-02', 'Sunday', 0),
(31, '2021-05-08', 'Saturday', 0),
(32, '2021-05-09', 'Sunday', 0),
(33, '2021-05-14', 'Id', 0),
(34, '2021-05-16', 'Sunday', 0),
(35, '2021-05-23', 'Sunday', 0),
(36, '2021-05-30', 'Sunday', 0),
(37, '2021-06-06', 'Sunday', 0),
(38, '2021-06-12', 'Saturday', 0),
(39, '2021-06-13', 'Sunday', 0),
(40, '2021-06-20', 'Sunday', 0),
(41, '2021-06-27', 'Sunday', 0),
(42, '2020-07-04', 'Sunday', 0),
(43, '2021-07-10', 'Saturday', 0),
(44, '2021-07-11', 'Sunday', 0),
(45, '2021-07-18', 'Sunday', 0),
(46, '2021-07-25', 'Sunday', 0),
(47, '2021-08-01', 'Sunday', 0),
(48, '2021-08-08', 'Sunday', 0),
(49, '2021-08-14', 'Saturday', 0),
(50, '2021-08-15', 'Independence Day', 0),
(51, '2021-08-16', 'Parasi New Year Day', 0),
(52, '2021-08-22', 'Sunday', 0),
(53, '2021-08-29', 'Sunday', 0),
(54, '2021-08-30', 'Monday', 0),
(55, '2021-09-05', 'Sunday', 0),
(56, '2021-06-10', ' Ganesh Chaturthi', 0),
(57, '2021-09-11', 'Saturday', 0),
(58, '2021-09-12', 'Sunday', 0),
(59, '2021-09-19', 'Sunday', 0),
(60, '2021-09-26', 'Sunday', 0),
(61, '2021-10-02', ' Gandhi Jayanti', 0),
(62, '2021-10-03', 'Sunday', 0),
(63, '2021-10-09', 'Saturday', 0),
(64, '2021-10-10', 'Sunday', 0),
(65, '2021-10-17', 'Sunday', 0),
(66, '2021-10-19', 'Milad-un-Nabi-orId', 0),
(67, '2021-10-24', 'Sunday', 0),
(68, '2021-10-31', 'Sunday', 0),
(69, '2021-11-04', ' Diwali', 0),
(70, '2021-11-05', 'Govardhan Puja', 0),
(71, '2021-11-07', 'Sunday', 0),
(72, '2021-11-10', ' Chhat Puja', 0),
(73, '2021-11-13', 'Saturday', 0),
(74, '2021-11-14', 'Sunday', 0),
(75, '2021-11-21', 'Sunday', 0),
(76, '2021-11-28', 'Sunday', 0),
(77, '2021-12-05', 'Sunday', 0),
(78, '2021-12-11', 'SecondSaturday', 0),
(79, '2021-12-12', 'Sunday', 0),
(80, '2021-12-19', 'Sunday', 0),
(81, '2021-12-25', 'Christmas', 0),
(82, '2021-12-26', 'Sunday', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holidaylist`
--
ALTER TABLE `holidaylist`
  ADD PRIMARY KEY (`holiday_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holidaylist`
--
ALTER TABLE `holidaylist`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
