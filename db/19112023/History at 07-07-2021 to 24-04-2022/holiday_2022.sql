-- Adminer 4.8.1 MySQL 5.5.5-10.4.17-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `holidaylist`;
CREATE TABLE `holidaylist` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_date` date NOT NULL,
  `holiday_desc` varchar(255) NOT NULL,
  `fdw_ess` tinyint(1) NOT NULL,
  `fdw` tinyint(1) NOT NULL,
  `sdw` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `holidaylist` (`holiday_id`, `holiday_date`, `holiday_desc`, `fdw_ess`, `fdw`, `sdw`, `is_delete`) VALUES
(1,	'2020-12-25',	'Christmas',	1,	1,	1,	0),
(2,	'2020-12-27',	'Sunday',	1,	1,	1,	0),
(3,	'2021-01-03',	'Sunday',	1,	1,	1,	0),
(4,	'2021-01-09',	'SecondSaturday',	1,	1,	0,	0),
(5,	'2021-01-10',	'Sunday',	1,	1,	1,	0),
(6,	'2021-01-17',	'Sunday',	1,	1,	1,	0),
(7,	'2021-01-24',	'Sunday',	1,	1,	1,	0),
(8,	'2021-01-26',	'Republic Day',	1,	1,	1,	0),
(9,	'2021-01-31',	'Sunday',	1,	1,	1,	0),
(10,	'2021-02-07',	'Sunday',	1,	1,	1,	0),
(11,	'2021-02-13',	'SecondSaturday',	1,	1,	0,	0),
(12,	'2021-02-14',	'Sunday',	1,	1,	1,	0),
(13,	'2021-02-21',	'Sunday',	1,	1,	1,	0),
(14,	'2021-02-28',	'Sunday',	1,	1,	1,	0),
(15,	'2021-03-07',	'Sunday',	1,	1,	1,	0),
(16,	'2021-03-11',	'Maha Shivratri',	1,	1,	1,	0),
(17,	'2021-03-13',	'Saturday',	1,	1,	0,	0),
(18,	'2021-03-14',	'Sunday',	1,	1,	1,	0),
(19,	'2021-03-21',	'Sunday',	1,	1,	1,	0),
(20,	'2021-03-28',	'Sunday',	1,	1,	1,	0),
(21,	'2021-03-29',	'Holi',	1,	1,	1,	0),
(22,	'2021-04-02',	'Good Friday',	1,	1,	1,	0),
(23,	'2021-04-04',	'Sunday',	1,	1,	1,	0),
(24,	'2021-04-10',	'Saturday',	1,	1,	0,	0),
(25,	'2021-04-11',	'Sunday',	1,	1,	1,	0),
(26,	'2021-04-13',	'Gudi Padava',	1,	1,	1,	0),
(27,	'2021-04-18',	'Sunday',	1,	1,	1,	0),
(28,	'2021-04-21',	'Ram Navami',	1,	1,	1,	0),
(29,	'2021-04-25',	'Sunday',	1,	1,	1,	0),
(30,	'2021-05-02',	'Sunday',	1,	1,	1,	0),
(31,	'2021-05-08',	'Saturday',	1,	1,	0,	0),
(32,	'2021-05-09',	'Sunday',	1,	1,	1,	0),
(33,	'2021-05-14',	'Id',	1,	1,	1,	0),
(34,	'2021-05-16',	'Sunday',	1,	1,	1,	0),
(35,	'2021-05-23',	'Sunday',	1,	1,	1,	0),
(36,	'2021-05-30',	'Sunday',	1,	1,	1,	0),
(37,	'2021-06-06',	'Sunday',	1,	1,	1,	0),
(38,	'2021-06-12',	'Saturday',	1,	1,	0,	0),
(39,	'2021-06-13',	'Sunday',	1,	1,	1,	0),
(40,	'2021-06-20',	'Sunday',	1,	1,	1,	0),
(41,	'2021-06-27',	'Sunday',	1,	1,	1,	0),
(42,	'2020-07-04',	'Sunday',	1,	1,	1,	0),
(43,	'2021-07-10',	'Saturday',	1,	1,	0,	0),
(44,	'2021-07-11',	'Sunday',	1,	1,	1,	0),
(45,	'2021-07-18',	'Sunday',	1,	1,	1,	0),
(46,	'2021-07-25',	'Sunday',	1,	1,	1,	0),
(47,	'2021-08-01',	'Sunday',	1,	1,	1,	0),
(48,	'2021-08-08',	'Sunday',	1,	1,	1,	0),
(49,	'2021-08-14',	'Saturday',	1,	1,	0,	0),
(50,	'2021-08-15',	'Independence Day',	1,	1,	1,	0),
(51,	'2021-08-16',	'Parasi New Year Day',	1,	1,	1,	0),
(52,	'2021-08-22',	'Sunday',	1,	1,	1,	0),
(53,	'2021-08-29',	'Sunday',	1,	1,	1,	0),
(54,	'2021-08-30',	'Monday',	1,	1,	1,	0),
(55,	'2021-09-05',	'Sunday',	1,	1,	1,	0),
(56,	'2021-06-10',	' Ganesh Chaturthi',	1,	1,	1,	0),
(57,	'2021-09-11',	'Saturday',	1,	1,	0,	0),
(58,	'2021-09-12',	'Sunday',	1,	1,	1,	0),
(59,	'2021-09-19',	'Sunday',	1,	1,	1,	0),
(60,	'2021-09-26',	'Sunday',	1,	1,	1,	0),
(61,	'2021-10-02',	' Gandhi Jayanti',	1,	1,	1,	0),
(62,	'2021-10-03',	'Sunday',	1,	1,	1,	0),
(63,	'2021-10-09',	'Saturday',	1,	1,	0,	0),
(64,	'2021-10-10',	'Sunday',	1,	1,	1,	0),
(65,	'2021-10-17',	'Sunday',	1,	1,	1,	0),
(66,	'2021-10-19',	'Milad-un-Nabi-orId',	1,	1,	1,	0),
(67,	'2021-10-24',	'Sunday',	1,	1,	1,	0),
(68,	'2021-10-31',	'Sunday',	1,	1,	1,	0),
(69,	'2021-11-04',	' Diwali',	1,	1,	1,	0),
(70,	'2021-11-05',	'Govardhan Puja',	1,	1,	1,	0),
(71,	'2021-11-07',	'Sunday',	1,	1,	1,	0),
(72,	'2021-11-10',	' Chhat Puja',	1,	1,	1,	0),
(73,	'2021-11-13',	'Saturday',	1,	1,	0,	0),
(74,	'2021-11-14',	'Sunday',	1,	1,	1,	0),
(75,	'2021-11-21',	'Sunday',	1,	1,	1,	0),
(76,	'2021-11-28',	'Sunday',	1,	1,	1,	0),
(77,	'2021-12-05',	'Sunday',	1,	1,	1,	0),
(78,	'2021-12-11',	'SecondSaturday',	1,	1,	0,	0),
(79,	'2021-12-12',	'Sunday',	1,	1,	1,	0),
(80,	'2021-12-19',	'Sunday',	1,	1,	1,	0),
(81,	'2021-12-25',	'Christmas',	1,	1,	1,	0),
(82,	'2021-12-26',	'Sunday',	1,	1,	1,	0),
(84,	'2021-01-02',	'Saturday',	0,	1,	0,	0),
(85,	'2021-01-16',	'Saturday',	0,	1,	0,	0),
(86,	'2021-01-23',	'Saturday',	0,	1,	0,	0),
(87,	'2021-01-30',	'Saturday',	0,	1,	0,	0),
(88,	'2021-02-06',	'Saturday',	0,	1,	0,	0),
(89,	'2021-02-20',	'Saturday',	0,	1,	0,	0),
(90,	'2021-02-27',	'Saturday',	0,	1,	0,	0),
(91,	'2021-03-06',	'Saturday',	0,	1,	0,	0),
(92,	'2021-03-20',	'Saturday',	0,	1,	0,	0),
(93,	'2021-03-27',	'Saturday',	0,	1,	0,	0),
(94,	'2021-04-03',	'Saturday',	0,	1,	0,	0),
(95,	'2021-04-17',	'Saturday',	0,	1,	0,	0),
(96,	'2021-04-24',	'Saturday',	0,	1,	0,	0),
(97,	'2021-05-15',	'Saturday',	0,	1,	0,	0),
(98,	'2021-05-22',	'Saturday',	0,	1,	0,	0),
(99,	'2021-05-29',	'Saturday',	0,	1,	0,	0),
(100,	'2021-06-05',	'Saturday',	0,	1,	0,	0),
(101,	'2021-06-19',	'Saturday',	0,	1,	0,	0),
(102,	'2021-06-26',	'Saturday',	0,	1,	0,	0),
(103,	'2021-07-03',	'Saturday',	0,	1,	0,	0),
(104,	'2021-07-17',	'Saturday',	0,	1,	0,	0),
(105,	'2021-07-24',	'Saturday',	0,	1,	0,	0),
(106,	'2021-07-31',	'Saturday',	0,	1,	0,	0),
(107,	'2021-08-07',	'Saturday',	0,	1,	0,	0),
(108,	'2021-08-21',	'Saturday',	0,	1,	0,	0),
(109,	'2021-08-28',	'Saturday',	0,	1,	0,	0),
(110,	'2021-09-04',	'Saturday',	0,	1,	0,	0),
(111,	'2021-09-18',	'Saturday',	0,	1,	0,	0),
(112,	'2021-09-25',	'Saturday',	0,	1,	0,	0),
(113,	'2021-10-16',	'Saturday',	0,	1,	0,	0),
(114,	'2021-10-23',	'Saturday',	0,	1,	0,	0),
(115,	'2021-10-30',	'Saturday',	0,	1,	0,	0),
(116,	'2021-11-06',	'Saturday',	0,	1,	0,	0),
(117,	'2021-11-20',	'Saturday',	0,	1,	0,	0),
(118,	'2021-11-27',	'Saturday',	0,	1,	0,	0),
(119,	'2021-12-04',	'Saturday',	0,	1,	0,	0),
(120,	'2021-12-18',	'Saturday',	0,	1,	0,	0),
(121,	'2022-01-01',	'Saturday',	0,	1,	0,	0),
(122,	'2022-01-02',	'Sunday',	1,	1,	1,	0),
(123,	'2022-01-08',	'Second Saturday',	1,	1,	0,	0),
(124,	'2022-01-09',	'Sunday',	1,	1,	1,	0),
(125,	'2022-01-15',	'Saturday',	0,	1,	0,	0),
(126,	'2022-01-16',	'Sunday',	1,	1,	1,	0),
(127,	'2022-01-22',	'Saturday',	0,	1,	0,	0),
(128,	'2022-01-23',	'Sunday',	1,	1,	1,	0),
(129,	'2022-01-26',	'Republic Day',	1,	1,	1,	0),
(130,	'2022-01-29',	'Saturday',	0,	1,	0,	0),
(131,	'2022-01-30',	'Sunday',	1,	1,	1,	0),
(132,	'2022-02-05',	'Saturday',	0,	1,	0,	0),
(133,	'2022-02-06',	'Sunday',	1,	1,	1,	0),
(134,	'2022-02-12',	'Second Saturday',	1,	1,	0,	0),
(135,	'2022-02-13',	'Sunday',	1,	1,	1,	0),
(136,	'2022-02-19',	'Saturday',	0,	1,	0,	0),
(137,	'2022-02-20',	'Sunday',	1,	1,	1,	0),
(138,	'2022-02-26',	'Saturday',	0,	1,	0,	0),
(139,	'2022-02-27',	'Sunday',	1,	1,	1,	0),
(140,	'2022-03-01',	'Maha Shivratri',	1,	1,	1,	0),
(141,	'2022-03-05',	'Saturday',	0,	1,	0,	0),
(142,	'2022-03-06',	'Sunday',	1,	1,	1,	0),
(143,	'2022-03-12',	'Second Saturday',	1,	1,	0,	0),
(144,	'2022-03-13',	'Sunday',	1,	1,	1,	0),
(145,	'2022-03-18',	'Holi',	1,	1,	1,	0),
(146,	'2022-03-19',	'Saturday',	0,	1,	0,	0),
(147,	'2022-03-20',	'Sunday',	1,	1,	1,	0),
(148,	'2022-03-26',	'Saturday',	0,	1,	0,	0),
(149,	'2022-03-27',	'Sunday',	1,	1,	1,	0),
(150,	'2022-04-02',	'Saturday',	1,	1,	1,	0),
(151,	'2022-04-03',	'Sunday',	1,	1,	1,	0),
(152,	'2022-04-09',	'Second Saturday',	1,	1,	0,	0),
(153,	'2022-04-10',	'Sunday',	1,	1,	1,	0),
(154,	'2022-04-14',	'Mahavir Jayanti/Vai sakhi/Vishr:/Meshadi',	1,	1,	1,	0),
(155,	'2022-04-15',	'Good Friday',	1,	1,	1,	0),
(156,	'2022-04-16',	'Saturday',	0,	1,	0,	0),
(157,	'2022-04-17',	'Sunday',	1,	1,	1,	0),
(158,	'2022-04-23',	'Saturday',	0,	1,	0,	0),
(159,	'2022-04-24',	'Sunday',	1,	1,	1,	0),
(160,	'2022-04-30',	'Saturday',	0,	1,	0,	0),
(161,	'2022-05-01',	'Sunday',	1,	1,	1,	0),
(162,	'2022-05-03',	'Idu l Fitr',	1,	1,	1,	0),
(163,	'2022-05-07',	'Saturday',	0,	1,	0,	0),
(164,	'2022-05-08',	'Sunday',	1,	1,	1,	0),
(165,	'2022-05-14',	'Second Saturday',	1,	1,	0,	0),
(166,	'2022-05-15',	'Sunday',	1,	1,	1,	0),
(167,	'2022-05-21',	'Saturday',	0,	1,	0,	0),
(168,	'2022-05-22',	'Sunday',	1,	1,	1,	0),
(169,	'2022-05-28',	'Saturday',	0,	1,	0,	0),
(170,	'2022-05-29',	'Sunday',	1,	1,	1,	0),
(171,	'2022-06-04',	'Saturday',	0,	1,	0,	0),
(172,	'2022-06-05',	'Sunday',	1,	1,	1,	0),
(173,	'2022-06-11',	'Second Saturday',	1,	1,	0,	0),
(174,	'2022-06-12',	'Sunday',	1,	1,	1,	0),
(175,	'2022-06-18',	'Saturday',	0,	1,	0,	0),
(176,	'2022-06-19',	'Sunday',	1,	1,	1,	0),
(177,	'2022-06-25',	'Saturday',	0,	1,	0,	0),
(178,	'2022-06-26',	'Sunday',	1,	1,	1,	0),
(179,	'2022-07-02',	'Saturday',	0,	1,	0,	0),
(180,	'2022-07-03',	'Sunday',	1,	1,	1,	0),
(181,	'2022-07-09',	'Second Saturday',	1,	1,	0,	0),
(182,	'2022-07-10',	'Sunday',	1,	1,	1,	0),
(183,	'2022-07-16',	'Saturday',	0,	1,	0,	0),
(184,	'2022-07-17',	'Sunday',	1,	1,	1,	0),
(185,	'2022-07-23',	'Saturday',	0,	1,	0,	0),
(186,	'2022-07-24',	'Sunday',	1,	1,	1,	0),
(187,	'2022-07-30',	'Saturday',	0,	1,	0,	0),
(188,	'2022-07-31',	'Sunday',	1,	1,	1,	0),
(189,	'2022-08-06',	'Saturday',	0,	1,	0,	0),
(190,	'2022-08-07',	'Sunday',	1,	1,	1,	0),
(191,	'2022-08-09',	'Muharram',	1,	1,	1,	0),
(192,	'2022-08-11',	'Raksha Bandhan',	1,	1,	1,	0),
(193,	'2022-08-13',	'Second Saturday',	1,	1,	0,	0),
(194,	'2022-08-14',	'Sunday',	1,	1,	1,	0),
(195,	'2022-08-15',	'Independence Day',	1,	1,	1,	0),
(196,	'2022-08-16',	'Parsi New Years DayA.laoraz',	1,	1,	1,	0),
(197,	'2022-08-19',	'Janmashtami',	1,	1,	1,	0),
(198,	'2022-08-20',	'Saturday',	0,	1,	0,	0),
(199,	'2022-08-21',	'Sunday',	1,	1,	1,	0),
(200,	'2022-08-27',	'Saturday',	0,	1,	0,	0),
(201,	'2022-08-28',	'Sunday',	1,	1,	1,	0),
(202,	'2022-08-31',	'Vinayaka Chaturthi/Ganesh Chaturth',	1,	1,	1,	0),
(203,	'2022-09-03',	'Saturday',	0,	1,	0,	0),
(204,	'2022-09-04',	'Sunday',	1,	1,	1,	0),
(205,	'2022-09-10',	'Second Saturday',	1,	1,	0,	0),
(206,	'2022-09-11',	'Sunday',	1,	1,	1,	0),
(207,	'2022-09-17',	'Saturday',	0,	1,	0,	0),
(208,	'2022-09-18',	'Sunday',	1,	1,	1,	0),
(209,	'2022-09-24',	'Saturday',	0,	1,	0,	0),
(210,	'2022-09-25',	'Sunday',	1,	1,	1,	0),
(211,	'2022-10-01',	'Saturday',	0,	1,	0,	0),
(212,	'2022-10-02',	'Sunday',	1,	1,	1,	0),
(213,	'2022-10-05',	'Dussehra',	1,	1,	1,	0),
(214,	'2022-10-08',	'Second Saturday',	1,	1,	0,	0),
(215,	'2022-10-09',	'Sunday',	1,	1,	1,	0),
(216,	'2022-10-15',	'Saturday',	0,	1,	0,	0),
(217,	'2022-10-16',	'Sunday',	1,	1,	1,	0),
(218,	'2022-10-22',	'Saturday',	0,	1,	0,	0),
(219,	'2022-10-23',	'Sunday',	1,	1,	1,	0),
(220,	'2022-10-24',	'Diwali (Deepavali)',	1,	1,	1,	0),
(221,	'2022-10-25',	'Govardhan Puja',	1,	1,	1,	0),
(222,	'2022-10-29',	'Saturday',	0,	1,	0,	0),
(223,	'2022-10-30',	'Sunday',	1,	1,	1,	0),
(224,	'2022-11-05',	'Saturday',	0,	1,	0,	0),
(225,	'2022-11-06',	'Sunday',	1,	1,	1,	0),
(226,	'2022-11-12',	'Second Saturday',	1,	1,	0,	0),
(227,	'2022-11-13',	'Sunday',	1,	1,	1,	0),
(228,	'2022-11-19',	'Saturday',	0,	1,	0,	0),
(229,	'2022-11-20',	'Sunday',	1,	1,	1,	0),
(230,	'2022-11-26',	'Saturday',	0,	1,	0,	0),
(231,	'2022-11-27',	'Sunday',	1,	1,	1,	0),
(232,	'2022-12-03',	'Saturday',	0,	1,	0,	0),
(233,	'2022-12-04',	'Sunday',	1,	1,	1,	0),
(234,	'2022-12-10',	'Second Saturday',	1,	1,	0,	0),
(235,	'2022-12-11',	'Sunday',	1,	1,	1,	0),
(236,	'2022-12-17',	'Saturday',	0,	1,	0,	0),
(237,	'2022-12-18',	'Sunday',	1,	1,	1,	0),
(238,	'2022-12-24',	'Saturday',	0,	1,	0,	0),
(239,	'2022-12-25',	'Sunday',	1,	1,	1,	0),
(240,	'2022-12-31',	'Saturday',	0,	1,	0,	0);

-- 2022-04-07 18:51:36