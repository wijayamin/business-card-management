-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2015 at 11:16 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kartunama`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `card_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`card_id`, `group_id`, `city_id`, `company_id`, `card_name`, `card_phone`, `card_mobile`, `card_fax`, `card_email`, `card_website`, `card_address`, `card_image`, `card_note`) VALUES
(1, NULL, 1, 1, 'Sri Hariani Eko Wulandari', '123456789012', '123456789012', '123456789012', 'abcdefg@hijklmn.opq', 'abcdefghij.klm', 'Sangat jauh Sekali Boos', 'img006.pdf', 'lalalalalala alalsldldasdka as lkadsjalskdj akj  kajsldk ja');

-- --------------------------------------------------------

--
-- Table structure for table `cards_categories`
--

CREATE TABLE IF NOT EXISTS `cards_categories` (
  `cards_category_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_categories`
--

INSERT INTO `cards_categories` (`cards_category_id`, `category_id`, `card_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cards_city`
--

CREATE TABLE IF NOT EXISTS `cards_city` (
  `city_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_city`
--

INSERT INTO `cards_city` (`city_id`, `country_id`, `city_name`) VALUES
(1, 1, 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `cards_company`
--

CREATE TABLE IF NOT EXISTS `cards_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_company`
--

INSERT INTO `cards_company` (`company_id`, `company_name`) VALUES
(1, 'STIKOM SURABAYA'),
(2, 'a'),
(3, 'b'),
(4, 'c'),
(5, 'd'),
(6, 'e'),
(7, 'f'),
(8, 'g'),
(9, 'h'),
(10, 'i'),
(11, 'j'),
(12, 'k'),
(13, 'l'),
(14, ','),
(15, 'm'),
(16, 'o'),
(17, 'asd'),
(18, 'a'),
(19, 'sd'),
(20, 'd'),
(21, 'gsdgd'),
(22, NULL),
(23, NULL),
(24, 'Zf'),
(25, 'bd'),
(26, NULL),
(27, 'g'),
(28, 'sd'),
(29, 'sdf'),
(30, 'a'),
(31, 'ds'),
(32, 'ADS'),
(33, 'ADAF'),
(34, 'F'),
(35, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cards_country`
--

CREATE TABLE IF NOT EXISTS `cards_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `country_name_ind` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_country`
--

INSERT INTO `cards_country` (`country_id`, `country_name`, `country_name_ind`) VALUES
(1, 'Indonesia', 'Indonesia'),
(3, 'Afghanistan', 'Afganistan'),
(4, 'Albania', 'Albania'),
(5, 'Algeria', 'Aljazair'),
(6, 'American Samoa', 'Samoa Amerika'),
(7, 'Andorra', 'Andorra'),
(8, 'Angola', 'Angola'),
(9, 'Anguilla', 'Anguilla'),
(10, 'Antarctica', 'Antartika'),
(11, 'Antigua and Barbuda', 'Antigua dan Barbuda'),
(12, 'Argentina', 'Argentina'),
(13, 'Armenia', 'Armenia'),
(14, 'Aruba', 'Aruba'),
(15, 'Australia', 'Australia'),
(16, 'Austria', 'Austria'),
(17, 'Azerbaijan', 'Azerbaijan'),
(18, 'Bahamas', 'Bahama'),
(19, 'Bahrain', 'Bahrain'),
(20, 'Bangladesh', 'Bangladesh'),
(21, 'Barbados', 'Barbados'),
(22, 'Belarus', 'Belarus'),
(23, 'Belgium', 'Belgia'),
(24, 'Belize', 'Belize'),
(25, 'Benin', 'Benin'),
(26, 'Bermuda', 'Bermuda'),
(27, 'Bhutan', 'Bhutan'),
(28, 'Bolivia', 'Bolivia'),
(29, 'Bosnia and Herzegovina', 'Bosnia and Herzegovina'),
(30, 'Botswana', 'Botswana'),
(31, 'Brazil', 'Brazil'),
(32, 'British Indian Ocean Territory', 'British Indian Ocean Territory'),
(33, 'British Virgin Islands', 'Kepulauan Virgin Inggris'),
(34, 'Brunei', 'Brunei'),
(35, 'Bulgaria', 'Bulgaria'),
(36, 'Burkina Faso', 'Burkina Faso'),
(37, 'Burundi', 'Burundi'),
(38, 'Cambodia', 'Kamboja'),
(39, 'Cameroon', 'Kamerun'),
(40, 'Canada', 'Kanada'),
(41, 'Cape Verde', 'Cape Verde'),
(42, 'Cayman Islands', 'Pulau cayman'),
(43, 'Central African Republic', 'Republik Afrika Tengah'),
(44, 'Chad', 'Chad'),
(45, 'Chile', 'Chili'),
(46, 'China', 'Cina'),
(47, 'Christmas Island', 'Christmas Island'),
(48, 'Cocos Islands', 'Kepulauan Cocos'),
(49, 'Colombia', 'Kolumbia'),
(50, 'Comoros', 'Komoro'),
(51, 'Cook Islands', 'Kepulauan Cook'),
(52, 'Costa Rica', 'Kosta Rika'),
(53, 'Croatia', 'Kroasia'),
(54, 'Cuba', 'Kuba'),
(55, 'Curacao', 'Curacao'),
(56, 'Cyprus', 'Siprus'),
(57, 'Czech Republic', 'Republik Ceko'),
(58, 'Democratic Republic of the Congo', 'Republik Demokratik Kongo'),
(59, 'Denmark', 'Denmark'),
(60, 'Djibouti', 'Djibouti'),
(61, 'Dominica', 'Dominica'),
(62, 'Dominican Republic', 'Republik Dominika'),
(63, 'East Timor', 'Timor Timur'),
(64, 'Ecuador', 'Ekuador'),
(65, 'Egypt', 'Mesir'),
(66, 'El Salvador', 'El Salvador'),
(67, 'Equatorial Guinea', 'Guinea ekuator'),
(68, 'Eritrea', 'Eritrea'),
(69, 'Estonia', 'Estonia'),
(70, 'Ethiopia', 'Etiopia'),
(71, 'Falkland Islands', 'Kepulauan Falkland'),
(72, 'Faroe Islands', 'Kepulauan Faroe'),
(73, 'Fiji', 'Fiji'),
(74, 'Finland', 'Finlandia'),
(75, 'France', 'Prancis'),
(76, 'French Polynesia', 'Polinesia Perancis'),
(77, 'Gabon', 'Gabon'),
(78, 'Gambia', 'Gambia'),
(79, 'Georgia', 'Georgia'),
(80, 'Germany', 'Jerman'),
(81, 'Ghana', 'Ghana'),
(82, 'Gibraltar', 'Gibraltar'),
(83, 'Greece', 'Yunani'),
(84, 'Greenland', 'Tanah penggembalaan'),
(85, 'Grenada', 'Grenada'),
(86, 'Guam', 'Guam'),
(87, 'Guatemala', 'Guatemala'),
(88, 'Guernsey', 'Guernsey'),
(89, 'Guinea', 'Guinea'),
(90, 'Guinea-Bissau', 'Guinea-Bissau'),
(91, 'Guyana', 'Guyana'),
(92, 'Haiti', 'Haiti'),
(93, 'Honduras', 'Honduras'),
(94, 'Hong Kong', 'Hongkong'),
(95, 'Hungary', 'Hongaria'),
(96, 'Iceland', 'Islandia'),
(97, 'India', 'India'),
(98, 'Iran', 'Iran'),
(99, 'Iraq', 'Irak'),
(100, 'Ireland', 'Irlandia'),
(101, 'Isle of Man', 'Pulau manusia'),
(102, 'Israel', 'Israel'),
(103, 'Italy', 'Italia'),
(104, 'Ivory Coast', 'pantai Gading'),
(105, 'Jamaica', 'Jamaika'),
(106, 'Japan', 'Jepang'),
(107, 'Jersey', 'Baju kaos'),
(108, 'Jordan', 'Jordan'),
(109, 'Kazakhstan', 'Kazakhstan'),
(110, 'Kenya', 'Kenya'),
(111, 'Kiribati', 'Kiribati'),
(112, 'Kosovo', 'Kosovo'),
(113, 'Kuwait', 'Kuwait'),
(114, 'Kyrgyzstan', 'Kyrgyzstan'),
(115, 'Laos', 'Laos'),
(116, 'Latvia', 'Latvia'),
(117, 'Lebanon', 'Libanon'),
(118, 'Lesotho', 'Lesotho'),
(119, 'Liberia', 'Liberia'),
(120, 'Libya', 'Libya'),
(121, 'Liechtenstein', 'Liechtenstein'),
(122, 'Lithuania', 'Lithuania'),
(123, 'Luxembourg', 'Luksemburg'),
(124, 'Macao', 'Macao'),
(125, 'Macedonia', 'Makedonia'),
(126, 'Madagascar', 'Madagaskar'),
(127, 'Malawi', 'Malawi'),
(128, 'Malaysia', 'Malaysia'),
(129, 'Maldives', 'Maladewa'),
(130, 'Mali', 'Mali'),
(131, 'Malta', 'Malta'),
(132, 'Marshall Islands', 'Kepulauan Marshall'),
(133, 'Mauritania', 'Mauritania'),
(134, 'Mauritius', 'Mauritius'),
(135, 'Mayotte', 'Mayotte'),
(136, 'Mexico', 'Mexico'),
(137, 'Micronesia', 'Mikronesia'),
(138, 'Moldova', 'Moldova'),
(139, 'Monaco', 'Monako'),
(140, 'Mongolia', 'Mongolia'),
(141, 'Montenegro', 'Montenegro'),
(142, 'Montserrat', 'Montserrat'),
(143, 'Morocco', 'Kulit kambing yg halus'),
(144, 'Mozambique', 'Mozambik'),
(145, 'Myanmar', 'Myanmar'),
(146, 'Namibia', 'Namibia'),
(147, 'Nauru', 'Nauru'),
(148, 'Nepal', 'Nepal'),
(149, 'Netherlands', 'Belanda'),
(150, 'Netherlands Antilles', 'Antillen Belanda'),
(151, 'New Caledonia', 'Kaledonia Baru'),
(152, 'New Zealand', 'New Zealand'),
(153, 'Nicaragua', 'Nikaragua'),
(154, 'Niger', 'Niger'),
(155, 'Nigeria', 'Nigeria'),
(156, 'Niue', 'Niue'),
(157, 'North Korea', 'Korea Utara'),
(158, 'Northern Mariana Islands', 'Kepulauan Mariana Utara'),
(159, 'Norway', 'Norwegia'),
(160, 'Oman', 'Oman'),
(161, 'Pakistan', 'Pakistan'),
(162, 'Palau', 'Palau'),
(163, 'Palestine', 'Palestina'),
(164, 'Panama', 'Panama'),
(165, 'Papua New Guinea', 'Papua Nugini'),
(166, 'Paraguay', 'Paraguai'),
(167, 'Peru', 'Peru'),
(168, 'Philippines', 'Pilipina'),
(169, 'Pitcairn', 'Pitcairn'),
(170, 'Poland', 'Polandia'),
(171, 'Portugal', 'Portugal'),
(172, 'Puerto Rico', 'Puerto Rico'),
(173, 'Qatar', 'Qatar'),
(174, 'Republic of the Congo', 'Republik Kongo'),
(175, 'Reunion', 'Reuni'),
(176, 'Romania', 'Rumania'),
(177, 'Russia', 'Rusia'),
(178, 'Rwanda', 'Rwanda'),
(179, 'Saint Barthelemy', 'Saint Barthelemy'),
(180, 'Saint Helena', 'Saint Helena'),
(181, 'Saint Kitts and Nevis', 'Saint Kitts dan Nevis'),
(182, 'Saint Lucia', 'Saint Lucia'),
(183, 'Saint Martin', 'Saint Martin'),
(184, 'Saint Pierre and Miquelon', 'Saint Pierre dan Miquelon'),
(185, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines'),
(186, 'Samoa', 'Samoa'),
(187, 'San Marino', 'San Marino'),
(188, 'Sao Tome and Principe', 'Sao Tome dan Principe'),
(189, 'Saudi Arabia', 'Arab Saudi'),
(190, 'Senegal', 'Senegal'),
(191, 'Serbia', 'Serbia'),
(192, 'Seychelles', 'Seychelles'),
(193, 'Sierra Leone', 'Sierra Leone'),
(194, 'Singapore', 'Singapura'),
(195, 'Sint Maarten', 'Sint Maarten'),
(196, 'Slovakia', 'Slovakia'),
(197, 'Slovenia', 'Slovenia'),
(198, 'Solomon Islands', 'Kepulauan Solomon'),
(199, 'Somalia', 'Somalia'),
(200, 'South Africa', 'Afrika Selatan'),
(201, 'South Korea', 'Korea Selatan'),
(202, 'South Sudan', 'Sudan Selatan'),
(203, 'Spain', 'Spanyol'),
(204, 'Sri Lanka', 'Sri Lanka'),
(205, 'Sudan', 'Sudan'),
(206, 'Suriname', 'Suriname'),
(207, 'Svalbard and Jan Mayen', 'Svalbard dan Jan Mayen'),
(208, 'Swaziland', 'Swaziland'),
(209, 'Sweden', 'Swedia'),
(210, 'Switzerland', 'Swiss'),
(211, 'Syria', 'Suriah'),
(212, 'Taiwan', 'Taiwan'),
(213, 'Tajikistan', 'Tajikistan'),
(214, 'Tanzania', 'Tanzania'),
(215, 'Thailand', 'Thailand'),
(216, 'Togo', 'Untuk pergi'),
(217, 'Tokelau', 'Tokelau'),
(218, 'Tonga', 'Tonga'),
(219, 'Trinidad and Tobago', 'Trinidad dan Tobago'),
(220, 'Tunisia', 'Tunisia'),
(221, 'Turkey', 'Turki'),
(222, 'Turkmenistan', 'Turkmenistan'),
(223, 'Turks and Caicos Islands', 'Kepulauan Turks dan Caicos'),
(224, 'Tuvalu', 'Tuvalu'),
(225, 'U.S. Virgin Islands', 'Kepulauan Virgin AS'),
(226, 'Uganda', 'Uganda'),
(227, 'Ukraine', 'Ukraina'),
(228, 'United Arab Emirates', 'Uni Emirat Arab'),
(229, 'United Kingdom', 'Inggris'),
(230, 'United States', 'Amerika Serikat'),
(231, 'Uruguay', 'Uruguay'),
(232, 'Uzbekistan', 'Uzbekistan'),
(233, 'Vanuatu', 'Vanuatu'),
(234, 'Vatican', 'Vatikan'),
(235, 'Venezuela', 'Venezuela'),
(236, 'Vietnam', 'Vietnam'),
(237, 'Wallis and Futuna', 'Wallis dan Futuna'),
(238, 'Western Sahara', 'Sahara Barat'),
(239, 'Yemen', 'Yaman'),
(240, 'Zambia', 'Zambia'),
(241, 'Zimbabwe', 'Zimbabwe'),
(242, 'Tidak Diketahui', 'Tidak Diketahui');

-- --------------------------------------------------------

--
-- Table structure for table `cards_occupations`
--

CREATE TABLE IF NOT EXISTS `cards_occupations` (
  `cards_occupation_id` int(11) NOT NULL,
  `occupation_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards_occupations`
--

INSERT INTO `cards_occupations` (`cards_occupation_id`, `occupation_id`, `card_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, '-');

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
(1, 'Direktur Utama', 'Grup Kartu Nama Milik Bagian Direktur Utama');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE IF NOT EXISTS `occupations` (
  `occupation_id` int(11) NOT NULL,
  `occupation_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`occupation_id`, `occupation_name`) VALUES
(1, '-'),
(2, 'a');

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
  `permission` enum('superuser','admin','write','read') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `real_name`, `image`, `activated`, `last_login`, `permission`) VALUES
(9, 'mientz', 'f04878fc9c0d6452eb8d6603371f2548', 'drak_nes@yahoo.com', 'gentho wijaya', 'no-photo.png', 1, '2015-10-10 13:41:36', 'superuser'),
(10, 'gentho', 'f04878fc9c0d6452eb8d6603371f2548', 'admin@palcards.000free.us', 'Risma Distya', 'no-photo.png', 1, '2015-10-10 13:54:24', 'write');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `users_group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`users_group_id`, `user_id`, `group_id`) VALUES
(1, 10, 1),
(2, 9, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `fk_cards_has_groups` (`group_id`),
  ADD KEY `fk_city_has_cards` (`city_id`),
  ADD KEY `fk_company_has_cards` (`company_id`);

--
-- Indexes for table `cards_categories`
--
ALTER TABLE `cards_categories`
  ADD PRIMARY KEY (`cards_category_id`),
  ADD KEY `fk_cards_has_categorys` (`card_id`),
  ADD KEY `fk_categorys_has_cards` (`category_id`);

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
-- Indexes for table `cards_occupations`
--
ALTER TABLE `cards_occupations`
  ADD PRIMARY KEY (`cards_occupation_id`),
  ADD KEY `fk_cards_has_occupation` (`card_id`),
  ADD KEY `fk_occupation_has_cards` (`occupation_id`);

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
  ADD KEY `fk_group_has_users` (`group_id`),
  ADD KEY `fk_users_have_group` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cards_categories`
--
ALTER TABLE `cards_categories`
  MODIFY `cards_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cards_city`
--
ALTER TABLE `cards_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cards_company`
--
ALTER TABLE `cards_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `cards_country`
--
ALTER TABLE `cards_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `cards_occupations`
--
ALTER TABLE `cards_occupations`
  MODIFY `cards_occupation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `occupation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `users_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_cards_has_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `fk_city_has_cards` FOREIGN KEY (`city_id`) REFERENCES `cards_city` (`city_id`),
  ADD CONSTRAINT `fk_company_has_cards` FOREIGN KEY (`company_id`) REFERENCES `cards_company` (`company_id`);

--
-- Constraints for table `cards_categories`
--
ALTER TABLE `cards_categories`
  ADD CONSTRAINT `fk_cards_has_categorys` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`),
  ADD CONSTRAINT `fk_categorys_has_cards` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `cards_city`
--
ALTER TABLE `cards_city`
  ADD CONSTRAINT `fk_country_has_city` FOREIGN KEY (`country_id`) REFERENCES `cards_country` (`country_id`);

--
-- Constraints for table `cards_occupations`
--
ALTER TABLE `cards_occupations`
  ADD CONSTRAINT `fk_cards_has_occupation` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`),
  ADD CONSTRAINT `fk_occupation_has_cards` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`occupation_id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_group_has_users` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `fk_users_have_group` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
