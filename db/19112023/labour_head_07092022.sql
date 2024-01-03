-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `dept_fd`;
CREATE TABLE `dept_fd` (
  `dept_fd_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_type` tinyint(4) NOT NULL,
  `description` varchar(100) NOT NULL,
  `daman_pao_code` varchar(10) NOT NULL,
  `daman_ddo_code` varchar(10) NOT NULL,
  `daman_grant_number` varchar(10) NOT NULL,
  `daman_major_head` varchar(10) NOT NULL,
  `daman_sub_major_head` varchar(10) NOT NULL,
  `daman_minor_head` varchar(10) NOT NULL,
  `daman_sub_head` varchar(10) NOT NULL,
  `daman_detailed_head` varchar(10) NOT NULL,
  `daman_object` varchar(10) NOT NULL,
  `daman_category` varchar(10) NOT NULL,
  `diu_pao_code` varchar(10) NOT NULL,
  `diu_ddo_code` varchar(10) NOT NULL,
  `diu_grant_number` varchar(10) NOT NULL,
  `diu_major_head` varchar(10) NOT NULL,
  `diu_sub_major_head` varchar(10) NOT NULL,
  `diu_minor_head` varchar(10) NOT NULL,
  `diu_sub_head` varchar(10) NOT NULL,
  `diu_detailed_head` varchar(10) NOT NULL,
  `diu_object` varchar(10) NOT NULL,
  `diu_category` varchar(10) NOT NULL,
  `dnh_pao_code` varchar(10) NOT NULL,
  `dnh_ddo_code` varchar(10) NOT NULL,
  `dnh_grant_number` varchar(10) NOT NULL,
  `dnh_major_head` varchar(10) NOT NULL,
  `dnh_sub_major_head` varchar(10) NOT NULL,
  `dnh_minor_head` varchar(10) NOT NULL,
  `dnh_sub_head` varchar(10) NOT NULL,
  `dnh_detailed_head` varchar(10) NOT NULL,
  `dnh_object` varchar(10) NOT NULL,
  `dnh_category` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`dept_fd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `dept_fd` (`dept_fd_id`, `module_type`, `description`, `daman_pao_code`, `daman_ddo_code`, `daman_grant_number`, `daman_major_head`, `daman_sub_major_head`, `daman_minor_head`, `daman_sub_head`, `daman_detailed_head`, `daman_object`, `daman_category`, `diu_pao_code`, `diu_ddo_code`, `diu_grant_number`, `diu_major_head`, `diu_sub_major_head`, `diu_minor_head`, `diu_sub_head`, `diu_detailed_head`, `diu_object`, `diu_category`, `dnh_pao_code`, `dnh_ddo_code`, `dnh_grant_number`, `dnh_major_head`, `dnh_sub_major_head`, `dnh_minor_head`, `dnh_sub_head`, `dnh_detailed_head`, `dnh_object`, `dnh_category`, `created_by`, `created_time`, `updated_by`, `updated_time`, `is_delete`) VALUES
(1,	32,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'101',	'01',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 14:57:36',	1,	'2022-09-06 14:58:35',	0),
(2,	33,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'101',	'02',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 14:59:53',	0,	'0000-00-00 00:00:00',	0),
(3,	42,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'101',	'02',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:00:09',	0,	'0000-00-00 00:00:00',	0),
(4,	42,	'Panelty',	'008998',	'209713',	'900',	'0230',	'00',	'101',	'02',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:00:09',	0,	'0000-00-00 00:00:00',	0),
(5,	43,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'106',	'00',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:02:05',	0,	'0000-00-00 00:00:00',	0),
(6,	43,	'Security Deposit',	'008998',	'209713',	'900',	'8443',	'00',	'106',	'01',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:02:05',	0,	'0000-00-00 00:00:00',	0),
(7,	34,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'106',	'00',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:02:35',	0,	'0000-00-00 00:00:00',	0),
(8,	45,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'106',	'00',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:02:41',	0,	'0000-00-00 00:00:00',	0),
(9,	46,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'106',	'00',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:05:01',	0,	'0000-00-00 00:00:00',	0),
(10,	46,	'Panelty',	'008998',	'209713',	'900',	'0230',	'00',	'106',	'00',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 15:05:01',	0,	'0000-00-00 00:00:00',	0),
(11,	31,	'Fee',	'008998',	'209713',	'900',	'0230',	'00',	'106',	'00',	'00',	'00',	'1',	'009002',	'209636',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	'009007',	'209599',	'900',	'',	'',	'',	'',	'00',	'00',	'1',	1,	'2022-09-06 21:32:34',	0,	'0000-00-00 00:00:00',	0);

-- 2022-09-07 05:28:13