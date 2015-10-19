-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2015 at 11:51 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kartu_nama`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `card_id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `card_name` varchar(50) DEFAULT NULL,
  `card_phone` text,
  `card_mobile` text,
  `card_fax` text,
  `card_email` text,
  `card_website` varchar(50) DEFAULT NULL,
  `card_address` text,
  `card_image` varchar(100) DEFAULT NULL,
  `card_note` text
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`card_id`, `city_id`, `company_id`, `card_name`, `card_phone`, `card_mobile`, `card_fax`, `card_email`, `card_website`, `card_address`, `card_image`, `card_note`) VALUES
(6, 10, 37, 'Sri Hariani Eko Wulandari, S.Kom., M.MT. ', '', '', '', '', '', '', 'img005.jpg', 'adadsad'),
(7, 11, 38, 'Bendot', '031 898 3027 ', ' 0857 3695 5509, 0821 3260 6113 ', '', '', '', 'J l . Raya Ponokawan-Krian Sidoarjo ', 'card-Bendot-718--2015-10-13-04-35-54-.pdf', 'Juragan Motor Langganan');

-- --------------------------------------------------------

--
-- Table structure for table `cards_categories`
--

CREATE TABLE IF NOT EXISTS `cards_categories` (
  `cards_category_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_categories`
--

INSERT INTO `cards_categories` (`cards_category_id`, `category_id`, `card_id`) VALUES
(3, 1, 6),
(7, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cards_city`
--

CREATE TABLE IF NOT EXISTS `cards_city` (
  `city_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_city`
--

INSERT INTO `cards_city` (`city_id`, `country_id`, `city_name`) VALUES
(10, 1, 'surabaya'),
(11, 1, 'Sidoarjo');

-- --------------------------------------------------------

--
-- Table structure for table `cards_company`
--

CREATE TABLE IF NOT EXISTS `cards_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_company`
--

INSERT INTO `cards_company` (`company_id`, `company_name`) VALUES
(37, 'STMIK STIKOM SURABAYA '),
(38, 'TIRTA SEJAHTERA MOTOR ');

-- --------------------------------------------------------

--
-- Table structure for table `cards_country`
--

CREATE TABLE IF NOT EXISTS `cards_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `country_name_ind` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_country`
--

INSERT INTO `cards_country` (`country_id`, `country_name`, `country_name_ind`) VALUES
(1, 'Indonesia', 'Indonesia'),
(2, 'Afghanistan', 'Afganistan'),
(3, 'Albania', 'Albania'),
(4, 'Algeria', 'Aljazair'),
(5, 'American Samoa', 'Samoa Amerika'),
(6, 'Andorra', 'Andorra'),
(7, 'Angola', 'Angola'),
(8, 'Anguilla', 'Anguilla'),
(9, 'Antarctica', 'Antartika'),
(10, 'Antigua and Barbuda', 'Antigua dan Barbuda'),
(11, 'Argentina', 'Argentina'),
(12, 'Armenia', 'Armenia'),
(13, 'Aruba', 'Aruba'),
(14, 'Australia', 'Australia'),
(15, 'Austria', 'Austria'),
(16, 'Azerbaijan', 'Azerbaijan'),
(17, 'Bahamas', 'Bahama'),
(18, 'Bahrain', 'Bahrain'),
(19, 'Bangladesh', 'Bangladesh'),
(20, 'Barbados', 'Barbados'),
(21, 'Belarus', 'Belarus'),
(22, 'Belgium', 'Belgia'),
(23, 'Belize', 'Belize'),
(24, 'Benin', 'Benin'),
(25, 'Bermuda', 'Bermuda'),
(26, 'Bhutan', 'Bhutan'),
(27, 'Bolivia', 'Bolivia'),
(28, 'Bosnia and Herzegovina', 'Bosnia and Herzegovina'),
(29, 'Botswana', 'Botswana'),
(30, 'Brazil', 'Brazil'),
(31, 'British Indian Ocean Territory', 'British Indian Ocean Territory'),
(32, 'British Virgin Islands', 'Kepulauan Virgin Inggris'),
(33, 'Brunei', 'Brunei'),
(34, 'Bulgaria', 'Bulgaria'),
(35, 'Burkina Faso', 'Burkina Faso'),
(36, 'Burundi', 'Burundi'),
(37, 'Cambodia', 'Kamboja'),
(38, 'Cameroon', 'Kamerun'),
(39, 'Canada', 'Kanada'),
(40, 'Cape Verde', 'Cape Verde'),
(41, 'Cayman Islands', 'Pulau cayman'),
(42, 'Central African Republic', 'Republik Afrika Tengah'),
(43, 'Chad', 'Chad'),
(44, 'Chile', 'Chili'),
(45, 'China', 'Cina'),
(46, 'Christmas Island', 'Christmas Island'),
(47, 'Cocos Islands', 'Kepulauan Cocos'),
(48, 'Colombia', 'Kolumbia'),
(49, 'Comoros', 'Komoro'),
(50, 'Cook Islands', 'Kepulauan Cook'),
(51, 'Costa Rica', 'Kosta Rika'),
(52, 'Croatia', 'Kroasia'),
(53, 'Cuba', 'Kuba'),
(54, 'Curacao', 'Curacao'),
(55, 'Cyprus', 'Siprus'),
(56, 'Czech Republic', 'Republik Ceko'),
(57, 'Democratic Republic of the Congo', 'Republik Demokratik Kongo'),
(58, 'Denmark', 'Denmark'),
(59, 'Djibouti', 'Djibouti'),
(60, 'Dominica', 'Dominica'),
(61, 'Dominican Republic', 'Republik Dominika'),
(62, 'East Timor', 'Timor Timur'),
(63, 'Ecuador', 'Ekuador'),
(64, 'Egypt', 'Mesir'),
(65, 'El Salvador', 'El Salvador'),
(66, 'Equatorial Guinea', 'Guinea ekuator'),
(67, 'Eritrea', 'Eritrea'),
(68, 'Estonia', 'Estonia'),
(69, 'Ethiopia', 'Etiopia'),
(70, 'Falkland Islands', 'Kepulauan Falkland'),
(71, 'Faroe Islands', 'Kepulauan Faroe'),
(72, 'Fiji', 'Fiji'),
(73, 'Finland', 'Finlandia'),
(74, 'France', 'Prancis'),
(75, 'French Polynesia', 'Polinesia Perancis'),
(76, 'Gabon', 'Gabon'),
(77, 'Gambia', 'Gambia'),
(78, 'Georgia', 'Georgia'),
(79, 'Germany', 'Jerman'),
(80, 'Ghana', 'Ghana'),
(81, 'Gibraltar', 'Gibraltar'),
(82, 'Greece', 'Yunani'),
(83, 'Greenland', 'Tanah penggembalaan'),
(84, 'Grenada', 'Grenada'),
(85, 'Guam', 'Guam'),
(86, 'Guatemala', 'Guatemala'),
(87, 'Guernsey', 'Guernsey'),
(88, 'Guinea', 'Guinea'),
(89, 'Guinea-Bissau', 'Guinea-Bissau'),
(90, 'Guyana', 'Guyana'),
(91, 'Haiti', 'Haiti'),
(92, 'Honduras', 'Honduras'),
(93, 'Hong Kong', 'Hongkong'),
(94, 'Hungary', 'Hongaria'),
(95, 'Iceland', 'Islandia'),
(96, 'India', 'India'),
(97, 'Iran', 'Iran'),
(98, 'Iraq', 'Irak'),
(99, 'Ireland', 'Irlandia'),
(100, 'Isle of Man', 'Pulau manusia'),
(101, 'Israel', 'Israel'),
(102, 'Italy', 'Italia'),
(103, 'Ivory Coast', 'pantai Gading'),
(104, 'Jamaica', 'Jamaika'),
(105, 'Japan', 'Jepang'),
(106, 'Jersey', 'Baju kaos'),
(107, 'Jordan', 'Jordan'),
(108, 'Kazakhstan', 'Kazakhstan'),
(109, 'Kenya', 'Kenya'),
(110, 'Kiribati', 'Kiribati'),
(111, 'Kosovo', 'Kosovo'),
(112, 'Kuwait', 'Kuwait'),
(113, 'Kyrgyzstan', 'Kyrgyzstan'),
(114, 'Laos', 'Laos'),
(115, 'Latvia', 'Latvia'),
(116, 'Lebanon', 'Libanon'),
(117, 'Lesotho', 'Lesotho'),
(118, 'Liberia', 'Liberia'),
(119, 'Libya', 'Libya'),
(120, 'Liechtenstein', 'Liechtenstein'),
(121, 'Lithuania', 'Lithuania'),
(122, 'Luxembourg', 'Luksemburg'),
(123, 'Macao', 'Macao'),
(124, 'Macedonia', 'Makedonia'),
(125, 'Madagascar', 'Madagaskar'),
(126, 'Malawi', 'Malawi'),
(127, 'Malaysia', 'Malaysia'),
(128, 'Maldives', 'Maladewa'),
(129, 'Mali', 'Mali'),
(130, 'Malta', 'Malta'),
(131, 'Marshall Islands', 'Kepulauan Marshall'),
(132, 'Mauritania', 'Mauritania'),
(133, 'Mauritius', 'Mauritius'),
(134, 'Mayotte', 'Mayotte'),
(135, 'Mexico', 'Mexico'),
(136, 'Micronesia', 'Mikronesia'),
(137, 'Moldova', 'Moldova'),
(138, 'Monaco', 'Monako'),
(139, 'Mongolia', 'Mongolia'),
(140, 'Montenegro', 'Montenegro'),
(141, 'Montserrat', 'Montserrat'),
(142, 'Morocco', 'Kulit kambing yg halus'),
(143, 'Mozambique', 'Mozambik'),
(144, 'Myanmar', 'Myanmar'),
(145, 'Namibia', 'Namibia'),
(146, 'Nauru', 'Nauru'),
(147, 'Nepal', 'Nepal'),
(148, 'Netherlands', 'Belanda'),
(149, 'Netherlands Antilles', 'Antillen Belanda'),
(150, 'New Caledonia', 'Kaledonia Baru'),
(151, 'New Zealand', 'New Zealand'),
(152, 'Nicaragua', 'Nikaragua'),
(153, 'Niger', 'Niger'),
(154, 'Nigeria', 'Nigeria'),
(155, 'Niue', 'Niue'),
(156, 'North Korea', 'Korea Utara'),
(157, 'Northern Mariana Islands', 'Kepulauan Mariana Utara'),
(158, 'Norway', 'Norwegia'),
(159, 'Oman', 'Oman'),
(160, 'Pakistan', 'Pakistan'),
(161, 'Palau', 'Palau'),
(162, 'Palestine', 'Palestina'),
(163, 'Panama', 'Panama'),
(164, 'Papua New Guinea', 'Papua Nugini'),
(165, 'Paraguay', 'Paraguai'),
(166, 'Peru', 'Peru'),
(167, 'Philippines', 'Pilipina'),
(168, 'Pitcairn', 'Pitcairn'),
(169, 'Poland', 'Polandia'),
(170, 'Portugal', 'Portugal'),
(171, 'Puerto Rico', 'Puerto Rico'),
(172, 'Qatar', 'Qatar'),
(173, 'Republic of the Congo', 'Republik Kongo'),
(174, 'Reunion', 'Reuni'),
(175, 'Romania', 'Rumania'),
(176, 'Russia', 'Rusia'),
(177, 'Rwanda', 'Rwanda'),
(178, 'Saint Barthelemy', 'Saint Barthelemy'),
(179, 'Saint Helena', 'Saint Helena'),
(180, 'Saint Kitts and Nevis', 'Saint Kitts dan Nevis'),
(181, 'Saint Lucia', 'Saint Lucia'),
(182, 'Saint Martin', 'Saint Martin'),
(183, 'Saint Pierre and Miquelon', 'Saint Pierre dan Miquelon'),
(184, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines'),
(185, 'Samoa', 'Samoa'),
(186, 'San Marino', 'San Marino'),
(187, 'Sao Tome and Principe', 'Sao Tome dan Principe'),
(188, 'Saudi Arabia', 'Arab Saudi'),
(189, 'Senegal', 'Senegal'),
(190, 'Serbia', 'Serbia'),
(191, 'Seychelles', 'Seychelles'),
(192, 'Sierra Leone', 'Sierra Leone'),
(193, 'Singapore', 'Singapura'),
(194, 'Sint Maarten', 'Sint Maarten'),
(195, 'Slovakia', 'Slovakia'),
(196, 'Slovenia', 'Slovenia'),
(197, 'Solomon Islands', 'Kepulauan Solomon'),
(198, 'Somalia', 'Somalia'),
(199, 'South Africa', 'Afrika Selatan'),
(200, 'South Korea', 'Korea Selatan'),
(201, 'South Sudan', 'Sudan Selatan'),
(202, 'Spain', 'Spanyol'),
(203, 'Sri Lanka', 'Sri Lanka'),
(204, 'Sudan', 'Sudan'),
(205, 'Suriname', 'Suriname'),
(206, 'Svalbard and Jan Mayen', 'Svalbard dan Jan Mayen'),
(207, 'Swaziland', 'Swaziland'),
(208, 'Sweden', 'Swedia'),
(209, 'Switzerland', 'Swiss'),
(210, 'Syria', 'Suriah'),
(211, 'Taiwan', 'Taiwan'),
(212, 'Tajikistan', 'Tajikistan'),
(213, 'Tanzania', 'Tanzania'),
(214, 'Thailand', 'Thailand'),
(215, 'Togo', 'Untuk pergi'),
(216, 'Tokelau', 'Tokelau'),
(217, 'Tonga', 'Tonga'),
(218, 'Trinidad and Tobago', 'Trinidad dan Tobago'),
(219, 'Tunisia', 'Tunisia'),
(220, 'Turkey', 'Turki'),
(221, 'Turkmenistan', 'Turkmenistan'),
(222, 'Turks and Caicos Islands', 'Kepulauan Turks dan Caicos'),
(223, 'Tuvalu', 'Tuvalu'),
(224, 'U.S. Virgin Islands', 'Kepulauan Virgin AS'),
(225, 'Uganda', 'Uganda'),
(226, 'Ukraine', 'Ukraina'),
(227, 'United Arab Emirates', 'Uni Emirat Arab'),
(228, 'United Kingdom', 'Inggris'),
(229, 'United States', 'Amerika Serikat'),
(230, 'Uruguay', 'Uruguay'),
(231, 'Uzbekistan', 'Uzbekistan'),
(232, 'Vanuatu', 'Vanuatu'),
(233, 'Vatican', 'Vatikan'),
(234, 'Venezuela', 'Venezuela'),
(235, 'Vietnam', 'Vietnam'),
(236, 'Wallis and Futuna', 'Wallis dan Futuna'),
(237, 'Western Sahara', 'Sahara Barat'),
(238, 'Yemen', 'Yaman'),
(239, 'Zambia', 'Zambia'),
(240, 'Zimbabwe', 'Zimbabwe'),
(241, '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `cards_groups`
--

CREATE TABLE IF NOT EXISTS `cards_groups` (
  `cards_groups_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_groups`
--

INSERT INTO `cards_groups` (`cards_groups_id`, `group_id`, `card_id`) VALUES
(5, 1, 6),
(12, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cards_occupations`
--

CREATE TABLE IF NOT EXISTS `cards_occupations` (
  `cards_occupation_id` int(11) NOT NULL,
  `occupation_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_occupations`
--

INSERT INTO `cards_occupations` (`cards_occupation_id`, `occupation_id`, `card_id`) VALUES
(3, 1, 6),
(7, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'kolaborator'),
(2, 'Juragan');

-- --------------------------------------------------------

--
-- Table structure for table `config_register`
--

CREATE TABLE IF NOT EXISTS `config_register` (
  `email_registration` tinyint(1) DEFAULT NULL,
  `can_register` tinyint(1) DEFAULT NULL,
  `limited_email` tinyint(1) DEFAULT NULL,
  `limited_email_list` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_register`
--

INSERT INTO `config_register` (`email_registration`, `can_register`, `limited_email`, `limited_email_list`) VALUES
(1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_smtp`
--

CREATE TABLE IF NOT EXISTS `config_smtp` (
  `server` varchar(100) DEFAULT NULL,
  `server_backup` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `sender_email` varchar(50) DEFAULT NULL,
  `sender_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `group_description` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_description`) VALUES
(1, 'Utama', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE IF NOT EXISTS `occupations` (
  `occupation_id` int(11) NOT NULL,
  `occupation_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`occupation_id`, `occupation_name`) VALUES
(1, 'LECTURER'),
(2, ''),
(3, 'Counter Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `real_name` varchar(50) DEFAULT NULL,
  `image` text,
  `activated` tinyint(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `permission` enum('superuser','admin','write','read') DEFAULT NULL,
  `default_group` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `real_name`, `image`, `activated`, `last_login`, `permission`, `default_group`) VALUES
(11, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'gentho_wijaya@gmail.com', 'Saya Admin', 'no-photo.png', 1, '2015-10-13 03:20:40', 'superuser', 1),
(16, 'mastercarma', 'f04878fc9c0d6452eb8d6603371f2548', 'drak_nes@yahoo.com', 'Master Carma', 'no-photo.png', 1, '2015-10-14 15:23:09', 'read', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `users_group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`users_group_id`, `user_id`, `group_id`) VALUES
(4, 11, 1),
(5, 16, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `fk_reference_11` (`company_id`),
  ADD KEY `fk_reference_5` (`city_id`);

--
-- Indexes for table `cards_categories`
--
ALTER TABLE `cards_categories`
  ADD PRIMARY KEY (`cards_category_id`),
  ADD KEY `fk_reference_8` (`category_id`),
  ADD KEY `fk_cards_has_categorys` (`card_id`);

--
-- Indexes for table `cards_city`
--
ALTER TABLE `cards_city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `fk_country_has_city` (`country_id`);

--
-- Indexes for table `cards_company`
--
ALTER TABLE `cards_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `cards_country`
--
ALTER TABLE `cards_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `cards_groups`
--
ALTER TABLE `cards_groups`
  ADD PRIMARY KEY (`cards_groups_id`),
  ADD KEY `fk_reference_10` (`card_id`),
  ADD KEY `fk_reference_9` (`group_id`);

--
-- Indexes for table `cards_occupations`
--
ALTER TABLE `cards_occupations`
  ADD PRIMARY KEY (`cards_occupation_id`),
  ADD KEY `fk_reference_7` (`occupation_id`),
  ADD KEY `fk_cards_has_occupation` (`card_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`occupation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`users_group_id`),
  ADD KEY `fk_reference_6` (`user_id`),
  ADD KEY `fk_group_has_users` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cards_categories`
--
ALTER TABLE `cards_categories`
  MODIFY `cards_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cards_city`
--
ALTER TABLE `cards_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cards_company`
--
ALTER TABLE `cards_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `cards_country`
--
ALTER TABLE `cards_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `cards_groups`
--
ALTER TABLE `cards_groups`
  MODIFY `cards_groups_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cards_occupations`
--
ALTER TABLE `cards_occupations`
  MODIFY `cards_occupation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `occupation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `users_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_reference_11` FOREIGN KEY (`company_id`) REFERENCES `cards_company` (`company_id`),
  ADD CONSTRAINT `fk_reference_5` FOREIGN KEY (`city_id`) REFERENCES `cards_city` (`city_id`);

--
-- Constraints for table `cards_categories`
--
ALTER TABLE `cards_categories`
  ADD CONSTRAINT `fk_cards_has_categorys` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`),
  ADD CONSTRAINT `fk_reference_8` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `cards_city`
--
ALTER TABLE `cards_city`
  ADD CONSTRAINT `fk_country_has_city` FOREIGN KEY (`country_id`) REFERENCES `cards_country` (`country_id`);

--
-- Constraints for table `cards_groups`
--
ALTER TABLE `cards_groups`
  ADD CONSTRAINT `fk_reference_10` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`),
  ADD CONSTRAINT `fk_reference_9` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `cards_occupations`
--
ALTER TABLE `cards_occupations`
  ADD CONSTRAINT `fk_cards_has_occupation` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`),
  ADD CONSTRAINT `fk_reference_7` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`occupation_id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_group_has_users` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `fk_reference_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
