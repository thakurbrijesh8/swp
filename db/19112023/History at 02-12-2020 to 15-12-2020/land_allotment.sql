-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 08:05 AM
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
-- Table structure for table `land_allotment`
--

CREATE TABLE `land_allotment` (
  `landallotment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_of_applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `applicant_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telehpone_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `village` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plot_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `govt_industrial_estate_area` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `proprietor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `bio_data_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `constitution_artical` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `constitution_artical_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expansion_industry` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nature_of_industry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `possession_of_industry_plot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `industrial_license_necessary` tinyint(1) NOT NULL,
  `obtained_letter_of_intent` tinyint(1) NOT NULL,
  `obtained_letter_of_intent_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `regist_letter_msme` tinyint(1) NOT NULL,
  `regist_letter_msme_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_project_collaboration` tinyint(1) NOT NULL,
  `project_collaboration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_project_requires_import` tinyint(1) NOT NULL,
  `project_requires_import` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detailed_project_report_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proposed_finance_terms_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_persons_likely_emp` tinyint(1) NOT NULL,
  `no_of_persons_likely_emp_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_persons_likely_emp_unskilled` tinyint(1) NOT NULL,
  `no_of_persons_likely_emp_no_unskilled` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_persons_likely_emp_staff` tinyint(1) NOT NULL,
  `no_of_persons_likely_emp_no_staff` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `details_of_manufacturing_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_backward_class_bac` tinyint(1) NOT NULL,
  `if_backward_class_bac_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_backward_class_scst` tinyint(1) NOT NULL,
  `if_backward_class_scst_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_backward_class_ex_serv` tinyint(1) NOT NULL,
  `if_backward_class_ex_serv_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_backward_class_wm` tinyint(1) NOT NULL,
  `if_backward_class_wm_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_backward_class_ph` tinyint(1) NOT NULL,
  `if_backward_class_ph_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `if_bonafide` tinyint(1) NOT NULL,
  `bonafide_of_dnh_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ifnot_state_particular_place` tinyint(1) NOT NULL,
  `state_particular_place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `information_raw_materials_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail_of_space` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `infrastructure_requirement_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `treatment_indicate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `effluent_teratment_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail_of_emission_of_gases` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_allotment_plot` tinyint(1) NOT NULL,
  `copy_authority_letter_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copy_project_profile_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `demand_of_deposit_draft` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copy_proposed_land_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copy_of_partnership_deed_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relevant_experience_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `certy_by_direc_indus_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_relevant_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `declaration` tinyint(1) NOT NULL,
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
-- Indexes for table `land_allotment`
--
ALTER TABLE `land_allotment`
  ADD PRIMARY KEY (`landallotment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `land_allotment`
--
ALTER TABLE `land_allotment`
  MODIFY `landallotment_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
