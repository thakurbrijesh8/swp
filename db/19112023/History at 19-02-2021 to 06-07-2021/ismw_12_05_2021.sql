DROP TABLE IF EXISTS `ismw`;
CREATE TABLE `ismw` (
  `ismw_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `district` tinyint(1) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `aadhaar_no` varchar(12) NOT NULL,
  `p_state` varchar(100) NOT NULL,
  `p_dist` varchar(100) NOT NULL,
  `p_block_no` varchar(100) NOT NULL,
  `p_village` varchar(100) NOT NULL,
  `p_house_no` varchar(100) NOT NULL,
  `p_pincode` varchar(100) NOT NULL,
  `ee_state` varchar(100) NOT NULL,
  `ee_dist` varchar(100) NOT NULL,
  `ee_occuption` varchar(100) NOT NULL,
  `ee_nature` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `submitted_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ismw_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;