ALTER TABLE `psf_registration`
ADD `aadharcard_all_parties` tinyint(1) NOT NULL AFTER `partnership_deed`,
ADD `pancard_all_parties` tinyint(1) NOT NULL AFTER `aadharcard`;

ALTER TABLE `psf_registration`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;

CREATE TABLE `psf_registration` (
  `psfregistration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firm_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `principal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firm_duration` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apploication_of_firm_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formII_document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `partnership_deed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aadharcard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pancard` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `import_from_outside_ret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retirement_form` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challan_updated_date` datetime NOT NULL,
  `fees_paid_challan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fees_paid_challan_updated_date` datetime NOT NULL,
  `admin_registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_upto` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_datetime` datetime NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;