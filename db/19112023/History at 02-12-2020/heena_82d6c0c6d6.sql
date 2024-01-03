-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 01:08 PM
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
-- Table structure for table `incentive_generalform`
--

CREATE TABLE `incentive_generalform` (
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `office_contactno` varchar(11) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `factory_contactno` varchar(11) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `cellphone` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `constitution` varchar(255) NOT NULL,
  `promoters_details` varchar(255) NOT NULL,
  `othorized_person_detail` varchar(255) NOT NULL,
  `is_women_entrepreneur` int(11) NOT NULL,
  `women_entrepreneur` varchar(255) NOT NULL,
  `is_sc_st_entrepreneur` int(11) NOT NULL,
  `sc_st_entrepreneur` varchar(255) NOT NULL,
  `is_physically_entrepreneur` int(11) NOT NULL,
  `physically_entrepreneur` varchar(255) NOT NULL,
  `is_transgender_entrepreneur` int(11) NOT NULL,
  `transgender_entrepreneur` varchar(255) NOT NULL,
  `is_other_entrepreneur` int(11) NOT NULL,
  `other_entrepreneur` varchar(255) NOT NULL,
  `proprietor_share_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `emno_part1` int(11) NOT NULL,
  `emdate_part1` date NOT NULL,
  `emno_part2` int(11) NOT NULL,
  `emdate_part2` date NOT NULL,
  `manufacturing_items` varchar(255) NOT NULL,
  `annual_capacity` int(11) NOT NULL,
  `approval_no` varchar(255) NOT NULL,
  `pccno_date` date NOT NULL,
  `pccno_validupto_date` date NOT NULL,
  `factory_registration_no` varchar(255) NOT NULL,
  `establishment_date` date NOT NULL,
  `establishment_validupto_date` date NOT NULL,
  `commencement_date` date NOT NULL,
  `turnover` int(11) NOT NULL,
  `financial_assistance` varchar(255) NOT NULL,
  `financial_assistance_upload` varchar(255) NOT NULL,
  `govt_dues` varchar(255) NOT NULL,
  `govt_dues_upload` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` int(11) NOT NULL,
  `ifsc_no` varchar(255) NOT NULL,
  `bankbranch_no` varchar(255) NOT NULL,
  `pancard_no` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` text NOT NULL,
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



-- --------------------------------------------------------

--
-- Table structure for table `incentive_generalform_textile`
--

CREATE TABLE `incentive_generalform_textile` (
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `office_contactno` varchar(11) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `factory_contactno` varchar(11) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `cellphone` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `constitution` varchar(255) NOT NULL,
  `promoters_details` varchar(255) NOT NULL,
  `othorized_person_detail` varchar(255) NOT NULL,
  `is_women_entrepreneur` int(11) NOT NULL,
  `women_entrepreneur` varchar(255) NOT NULL,
  `is_sc_st_entrepreneur` int(11) NOT NULL,
  `sc_st_entrepreneur` varchar(255) NOT NULL,
  `is_physically_entrepreneur` int(11) NOT NULL,
  `physically_entrepreneur` varchar(255) NOT NULL,
  `is_transgender_entrepreneur` int(11) NOT NULL,
  `transgender_entrepreneur` varchar(255) NOT NULL,
  `is_other_entrepreneur` int(11) NOT NULL,
  `other_entrepreneur` varchar(255) NOT NULL,
  `proprietor_share_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `emno_part1` int(11) NOT NULL,
  `emdate_part1` date NOT NULL,
  `emno_part2` int(11) NOT NULL,
  `emdate_part2` date NOT NULL,
  `manufacturing_items` varchar(255) NOT NULL,
  `annual_capacity` int(11) NOT NULL,
  `approval_no` varchar(255) NOT NULL,
  `pccno_date` date NOT NULL,
  `pccno_validupto_date` date NOT NULL,
  `factory_registration_no` varchar(255) NOT NULL,
  `establishment_date` date NOT NULL,
  `establishment_validupto_date` date NOT NULL,
  `commencement_date` date NOT NULL,
  `turnover` int(11) NOT NULL,
  `financial_assistance` varchar(255) NOT NULL,
  `financial_assistance_upload` varchar(255) NOT NULL,
  `govt_dues` varchar(255) NOT NULL,
  `govt_dues_upload` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` int(11) NOT NULL,
  `ifsc_no` varchar(255) NOT NULL,
  `bankbranch_no` varchar(255) NOT NULL,
  `pancard_no` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `query_status` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL,
  `challan_updated_date` text NOT NULL,
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


-- --------------------------------------------------------

--
-- Table structure for table `incentive_parta`
--

CREATE TABLE `incentive_parta` (
  `incentive_parta_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `enterprise_category` varchar(255) NOT NULL,
  `investment` varchar(255) NOT NULL,
  `machinery_units` int(11) NOT NULL,
  `new_investment` varchar(255) NOT NULL,
  `investment_percentage` int(11) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` varchar(255) NOT NULL,
  `unsecured_loan` varchar(255) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` varchar(255) NOT NULL,
  `term_loan_date` date NOT NULL,
  `loan_accountno` varchar(255) NOT NULL,
  `capital_subsidy` varchar(255) NOT NULL,
  `anum` varchar(255) NOT NULL,
  `cliam_amount_total` int(11) NOT NULL,
  `commencement_date` date NOT NULL,
  `disbursement_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_partb`
--

CREATE TABLE `incentive_partb` (
  `incentive_partb_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `features` varchar(255) NOT NULL,
  `iso_agency_name` varchar(255) NOT NULL,
  `iso_certificate_no` varchar(255) NOT NULL,
  `iso_certificate_date` date NOT NULL,
  `iso_product_detail` varchar(255) NOT NULL,
  `isi_agency_name` varchar(255) NOT NULL,
  `isi_certificate_no` varchar(255) NOT NULL,
  `isi_certificate_date` date NOT NULL,
  `isi_product_detail` varchar(255) NOT NULL,
  `expenditure` varchar(255) NOT NULL,
  `capital_cost` int(11) NOT NULL,
  `consutancy_fees` int(11) NOT NULL,
  `certification_charges` int(11) NOT NULL,
  `testing_equipments` varchar(255) NOT NULL,
  `cliam_amount_total` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_partc`
--

CREATE TABLE `incentive_partc` (
  `incentive_partc_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `patent_name` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `patent_expenditure` varchar(255) NOT NULL,
  `claim_amount` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `incentive_partd`
--

CREATE TABLE `incentive_partd` (
  `incentive_partd_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `consultant_name` varchar(255) NOT NULL,
  `suggestion` varchar(255) NOT NULL,
  `result_benefit` varchar(255) NOT NULL,
  `total_expenditure` int(11) NOT NULL,
  `equipment_info` longtext NOT NULL,
  `audit_fees` int(11) NOT NULL,
  `equipment_cost` int(11) NOT NULL,
  `cliam_amount_total` int(11) NOT NULL,
  `audit_report` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_parte`
--

CREATE TABLE `incentive_parte` (
  `incentive_parte_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `newly_requit_emp` int(11) NOT NULL,
  `emp_total_expenditure` int(11) NOT NULL,
  `assclaim_amount` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_partf`
--

CREATE TABLE `incentive_partf` (
  `incentive_partf_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `enterprise_category` varchar(255) NOT NULL,
  `investment` varchar(255) NOT NULL,
  `machinery_units` varchar(255) NOT NULL,
  `new_investment` varchar(255) NOT NULL,
  `investment_percentage` int(11) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` varchar(255) NOT NULL,
  `unsecured_loan` varchar(255) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_partg`
--

CREATE TABLE `incentive_partg` (
  `incentive_partg_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `enterprise_category` varchar(255) NOT NULL,
  `sector_textile` varchar(255) NOT NULL,
  `investment` varchar(255) NOT NULL,
  `machinery_units` varchar(255) NOT NULL,
  `new_investment` varchar(255) NOT NULL,
  `investment_percentage` varchar(255) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` varchar(255) NOT NULL,
  `unsecured_loan` int(11) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_parth`
--

CREATE TABLE `incentive_parth` (
  `incentive_parth_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enterprise_name` varchar(255) NOT NULL,
  `technology_purpose` varchar(255) NOT NULL,
  `sector_textile` varchar(255) NOT NULL,
  `enterprise_accqu` varchar(255) NOT NULL,
  `justification` varchar(255) NOT NULL,
  `process_detail` varchar(255) NOT NULL,
  `name_address` varchar(255) NOT NULL,
  `arrangement_uploader` varchar(255) NOT NULL,
  `mou_uploader` varchar(255) NOT NULL,
  `commencement_date` varchar(255) NOT NULL,
  `purchase` varchar(255) NOT NULL,
  `technology_fees` int(11) NOT NULL,
  `other_detail` varchar(255) NOT NULL,
  `upgradation_total` int(11) NOT NULL,
  `contribution` varchar(255) NOT NULL,
  `term_loan` int(11) NOT NULL,
  `unsecured_loan` int(11) NOT NULL,
  `accruals` varchar(255) NOT NULL,
  `finance_total` int(11) NOT NULL,
  `financial_data_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_scheme`
--

CREATE TABLE `incentive_scheme` (
  `incentive_scheme_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parta_form` int(11) NOT NULL,
  `partb_form` int(11) NOT NULL,
  `partc_form` int(11) NOT NULL,
  `partd_form` int(11) NOT NULL,
  `parte_form` int(11) NOT NULL,
  `partf_form` int(11) NOT NULL,
  `partg_form` int(11) NOT NULL,
  `parth_form` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `msme_checklist`
--

CREATE TABLE `msme_checklist` (
  `checklist_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entrepreneur_memorandum_uploader` varchar(255) NOT NULL,
  `partnership_deed_uploader` varchar(255) NOT NULL,
  `lease_agreement_uploader` varchar(255) NOT NULL,
  `loan_sanction_uploader` varchar(255) NOT NULL,
  `power_release_order_uploader` varchar(255) NOT NULL,
  `invoice_copy_uploader` varchar(255) NOT NULL,
  `ca_prescribed_uploader` varchar(255) NOT NULL,
  `certificate_commencement_uploader` varchar(255) NOT NULL,
  `engineer_certificate_uploader` varchar(255) NOT NULL,
  `expenses_certificate_uploader` varchar(255) NOT NULL,
  `stamped_receipt_uploader` varchar(255) NOT NULL,
  `sale_invoice_uploader` varchar(255) NOT NULL,
  `additional_document_uploader` varchar(255) NOT NULL,
  `factorylicence_copy_uploader` varchar(255) NOT NULL,
  `pcc_copy_uploader` varchar(255) NOT NULL,
  `expansion_date_uploader` varchar(255) NOT NULL,
  `production_turnover_uploader` varchar(255) NOT NULL,
  `fix_assets_value_uploader` varchar(255) NOT NULL,
  `production_capacity_uploader` varchar(255) NOT NULL,
  `patent_registration_uploader` varchar(255) NOT NULL,
  `energy_water_uploader` varchar(255) NOT NULL,
  `quality_certificate_uploader` varchar(255) NOT NULL,
  `resident_certificate_uploader` varchar(255) NOT NULL,
  `bank_total_interest_uploader` varchar(255) NOT NULL,
  `bank_statement_uploader` varchar(255) NOT NULL,
  `annexure3_declaration_uploader` varchar(255) NOT NULL,
  `interest_subsidy_cal_uploader` varchar(255) NOT NULL,
  `year_annual_prod_uploader` varchar(255) NOT NULL,
  `year_bank_statement_uploader` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `msme_declaration`
--

CREATE TABLE `msme_declaration` (
  `declaration_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_seal` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `textile_checklist`
--

CREATE TABLE `textile_checklist` (
  `checklist_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entrepreneur_memorandum_uploader` varchar(255) NOT NULL,
  `partnership_deed_uploader` varchar(255) NOT NULL,
  `lease_agreement_uploader` varchar(255) NOT NULL,
  `loan_sanction_uploader` varchar(255) NOT NULL,
  `power_release_order_uploader` varchar(255) NOT NULL,
  `invoice_copy_uploader` varchar(255) NOT NULL,
  `ca_prescribed_uploader` varchar(255) NOT NULL,
  `certificate_commencement_uploader` varchar(255) NOT NULL,
  `engineer_certificate_uploader` varchar(255) NOT NULL,
  `expenses_certificate_uploader` varchar(255) NOT NULL,
  `stamped_receipt_uploader` varchar(255) NOT NULL,
  `sale_invoice_uploader` varchar(255) NOT NULL,
  `additional_document_uploader` varchar(255) NOT NULL,
  `factorylicence_copy_uploader` varchar(255) NOT NULL,
  `pcc_copy_uploader` varchar(255) NOT NULL,
  `expansion_date_uploader` varchar(255) NOT NULL,
  `production_turnover_uploader` varchar(255) NOT NULL,
  `fix_assets_value_uploader` varchar(255) NOT NULL,
  `production_capacity_uploader` varchar(255) NOT NULL,
  `patent_registration_uploader` varchar(255) NOT NULL,
  `energy_water_uploader` varchar(255) NOT NULL,
  `quality_certificate_uploader` varchar(255) NOT NULL,
  `resident_certificate_uploader` varchar(255) NOT NULL,
  `bank_total_interest_uploader` varchar(255) NOT NULL,
  `bank_statement_uploader` varchar(255) NOT NULL,
  `annexure3_declaration_uploader` varchar(255) NOT NULL,
  `interest_subsidy_cal_uploader` varchar(255) NOT NULL,
  `year_annual_prod_uploader` varchar(255) NOT NULL,
  `year_bank_statement_uploader` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `textile_declaration`
--

CREATE TABLE `textile_declaration` (
  `declaration_id` int(11) NOT NULL,
  `incentive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_seal` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Indexes for table `incentive_generalform`
--
ALTER TABLE `incentive_generalform`
  ADD PRIMARY KEY (`incentive_id`);

--
-- Indexes for table `incentive_generalform_textile`
--
ALTER TABLE `incentive_generalform_textile`
  ADD PRIMARY KEY (`incentive_id`);

--
-- Indexes for table `incentive_parta`
--
ALTER TABLE `incentive_parta`
  ADD PRIMARY KEY (`incentive_parta_id`);

--
-- Indexes for table `incentive_partb`
--
ALTER TABLE `incentive_partb`
  ADD PRIMARY KEY (`incentive_partb_id`);

--
-- Indexes for table `incentive_partc`
--
ALTER TABLE `incentive_partc`
  ADD PRIMARY KEY (`incentive_partc_id`);

--
-- Indexes for table `incentive_partd`
--
ALTER TABLE `incentive_partd`
  ADD PRIMARY KEY (`incentive_partd_id`);

--
-- Indexes for table `incentive_parte`
--
ALTER TABLE `incentive_parte`
  ADD PRIMARY KEY (`incentive_parte_id`);

--
-- Indexes for table `incentive_scheme`
--
ALTER TABLE `incentive_scheme`
  ADD PRIMARY KEY (`incentive_scheme_id`);

--
-- Indexes for table `msme_checklist`
--
ALTER TABLE `msme_checklist`
  ADD PRIMARY KEY (`checklist_id`);

--
-- Indexes for table `msme_declaration`
--
ALTER TABLE `msme_declaration`
  ADD PRIMARY KEY (`declaration_id`);
--
-- Indexes for table `textile_checklist`
--
ALTER TABLE `textile_checklist`
  ADD PRIMARY KEY (`checklist_id`);

--
-- Indexes for table `textile_declaration`
--
ALTER TABLE `textile_declaration`
  ADD PRIMARY KEY (`declaration_id`);



--
-- AUTO_INCREMENT for table `incentive_generalform`
--
ALTER TABLE `incentive_generalform`
  MODIFY `incentive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incentive_generalform_textile`
--
ALTER TABLE `incentive_generalform_textile`
  MODIFY `incentive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incentive_parta`
--
ALTER TABLE `incentive_parta`
  MODIFY `incentive_parta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incentive_partb`
--
ALTER TABLE `incentive_partb`
  MODIFY `incentive_partb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incentive_partc`
--
ALTER TABLE `incentive_partc`
  MODIFY `incentive_partc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incentive_partd`
--
ALTER TABLE `incentive_partd`
  MODIFY `incentive_partd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incentive_parte`
--
ALTER TABLE `incentive_parte`
  MODIFY `incentive_parte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incentive_partf`
--
ALTER TABLE `incentive_partf`
  MODIFY `incentive_partf_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incentive_partg`
--
ALTER TABLE `incentive_partg`
  MODIFY `incentive_partg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incentive_parth`
--
ALTER TABLE `incentive_parth`
  MODIFY `incentive_parth_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incentive_scheme`
--
ALTER TABLE `incentive_scheme`
  MODIFY `incentive_scheme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


--
-- AUTO_INCREMENT for table `msme_checklist`
--
ALTER TABLE `msme_checklist`
  MODIFY `checklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `msme_declaration`
--
ALTER TABLE `msme_declaration`
  MODIFY `declaration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `textile_checklist`
--
ALTER TABLE `textile_checklist`
  MODIFY `checklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `textile_declaration`
--
ALTER TABLE `textile_declaration`
  MODIFY `declaration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
