-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2017 at 12:37 AM
-- Server version: 5.6.33-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pms_db17`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`accountant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`accountant_id`, `name`, `email`, `password`, `address`, `phone`) VALUES
(1, 'Accountant', 'acc@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'Mr. Admin', 'info@discovermypet.in', 'QWRtaW5AMTc=', '9011855666');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bording_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `appointment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `appointment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_appointment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=102 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `timestamp`, `doctor_id`, `patient_id`, `status`, `user_id`, `bording_number`, `appointment_type`, `appointment_status`, `add_appointment`) VALUES
(91, '1489050900', 84, 182, 'approved', NULL, '', 'Consultation', 'Close', NULL),
(98, '1489525500', 83, 176, 'approved', NULL, '', 'Consultation', 'Close', 'NULL'),
(93, '1488935400', 84, 183, 'approved', NULL, '', 'Consultation', 'Open', NULL),
(92, '1489186800', 84, 182, 'approved', NULL, '1234', 'Boarding', 'Close', NULL),
(88, '1488852600', 81, 177, 'approved', NULL, '', 'Consultation', 'Close', NULL),
(87, '1488849600', 81, 175, 'approved', NULL, '', 'Consultation', 'Open', NULL),
(85, '1489044600', 81, 171, 'approved', NULL, '', 'Vaccination', 'Open', NULL),
(84, '1490086800', 81, 171, 'approved', NULL, '1234', 'Boarding', 'Close', NULL),
(82, '0', 72, 170, 'approved', NULL, '', 'Vaccination', 'Close', NULL),
(83, '1488877200', 81, 172, 'approved', NULL, '', 'Consultation', 'Open', NULL),
(81, '0', 72, 170, 'approved', NULL, '', 'Vaccination', 'Close', NULL),
(80, '1489536000', 72, 170, 'approved', NULL, '', 'Consultation', 'Close', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE IF NOT EXISTS `bed` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` longtext NOT NULL COMMENT 'ward,cabin,ICU',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=unalloted;1=alloted',
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_id`, `bed_number`, `type`, `status`, `description`) VALUES
(1, '23', 'ward', 0, '2323');

-- --------------------------------------------------------

--
-- Table structure for table `bed_allotment`
--

CREATE TABLE IF NOT EXISTS `bed_allotment` (
  `bed_allotment_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `allotment_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `discharge_time` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `discharge_date` longtext,
  `allotment_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bed_allotment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bed_allotment`
--

INSERT INTO `bed_allotment` (`bed_allotment_id`, `bed_id`, `patient_id`, `allotment_date`, `discharge_time`, `discharge_date`, `allotment_time`) VALUES
(4, 1, 19, '1483488000', '1484273700', '1482710400', '1484270100'),
(5, 1, 19, '1484265600', '1484273400', '1484265600', '1484269800'),
(6, 1, 19, '1484265600', '1484278500', '1482796800', '1484277600');

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank`
--

CREATE TABLE IF NOT EXISTS `blood_bank` (
  `blood_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `blood_group` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`blood_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor`
--

CREATE TABLE IF NOT EXISTS `blood_donor` (
  `blood_donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_donation_timestamp` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`blood_donor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blood_donor`
--

INSERT INTO `blood_donor` (`blood_donor_id`, `name`, `blood_group`, `sex`, `age`, `phone`, `email`, `address`, `last_donation_timestamp`, `user_id`, `doctor_id`) VALUES
(2, 's', 'A-', 'male', 34, '4343', 'dsd2e343@3443', '4343', 1484179200, NULL, NULL),
(3, 'dsww', 'A+', 'male', 343, '4343', 'fdf@3434', '                                    343                                ', 1484870400, '25', '2'),
(4, 'dsfdf', 'A+', 'male', 343, '34343', 'ddg@23434', 'dgdg', 1484870400, '25', '2');

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE IF NOT EXISTS `breed` (
  `breed_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `species` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`breed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=298 ;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breed_id`, `name`, `doctor_id`, `user_id`, `species`) VALUES
(3, 'Affenpinscher', NULL, NULL, 'Dog'),
(4, 'Afghan Hound', NULL, NULL, 'Dog'),
(5, 'Airedale Terrier', NULL, NULL, 'Dog'),
(6, 'Abyssinian', NULL, NULL, 'Cat'),
(7, 'British Shorthair', NULL, NULL, 'Cat'),
(8, 'Akita', NULL, NULL, 'Dog'),
(9, 'Alaskan Malamute', NULL, NULL, 'Dog'),
(10, 'American English Coonhound', NULL, NULL, 'Dog'),
(11, 'American Eskimo Dog', NULL, NULL, 'Dog'),
(12, 'American Foxhound', NULL, NULL, 'Dog'),
(13, 'American Pit Bull Terrier', NULL, NULL, 'Dog'),
(14, 'American Water Spaniel', NULL, NULL, 'Dog'),
(15, 'Anatolian Shepherd Dog', NULL, NULL, 'Dog'),
(16, 'Appenzeller Sennenhunde', NULL, NULL, 'Dog'),
(17, 'Australian Cattle Dog\r\n', NULL, NULL, 'Dog'),
(18, 'Australian Shepherd', NULL, NULL, 'Dog'),
(19, 'Australian Terrier', NULL, NULL, 'Dog'),
(20, 'Azawakh', NULL, NULL, 'Dog'),
(21, 'Barbet', NULL, NULL, 'Dog'),
(22, 'Basenji', NULL, NULL, 'Dog'),
(23, 'Basset Hound', NULL, NULL, 'Dog'),
(24, 'Beagle', NULL, NULL, 'Dog'),
(25, 'Bearded Collie', NULL, NULL, 'Dog'),
(26, 'Bedlington Terrier', NULL, NULL, 'Dog'),
(27, 'Belgian Malinois', NULL, NULL, 'Dog'),
(28, 'Belgian Sheepdog', NULL, NULL, 'Dog'),
(29, 'Belgian Tervuren', NULL, NULL, 'Dog'),
(30, 'Berger Picard', NULL, NULL, 'Dog'),
(31, 'Bernese Mountain Dog', NULL, NULL, 'Dog'),
(32, 'Bichon Frise', NULL, NULL, 'Dog'),
(33, 'Black and Tan Coonhound', NULL, NULL, 'Dog'),
(34, 'Black Russian Terrier', NULL, NULL, 'Dog'),
(35, 'Bloodhound', NULL, NULL, 'Dog'),
(36, 'Bluetick Coonhound', NULL, NULL, 'Dog'),
(37, 'Bolognese', NULL, NULL, 'Dog'),
(38, 'Border Collie', NULL, NULL, 'Dog'),
(39, 'Border Terrier', NULL, NULL, 'Dog'),
(40, 'Borzoi', NULL, NULL, 'Dog'),
(41, 'Boston Terrier', NULL, NULL, 'Dog'),
(42, 'Bouvier des Flandres', NULL, NULL, 'Dog'),
(43, 'Boxer', NULL, NULL, 'Dog'),
(44, 'Boykin Spaniel', NULL, NULL, 'Dog'),
(45, 'Bracco Italiano', NULL, NULL, 'Dog'),
(46, 'Briard', NULL, NULL, 'Dog'),
(47, 'Brittany', NULL, NULL, 'Dog'),
(48, 'Brussels Griffon', NULL, NULL, 'Dog'),
(49, 'Bull Terrier', NULL, NULL, 'Dog'),
(50, 'Bulldog', NULL, NULL, 'Dog'),
(51, 'Bullmastiff', NULL, NULL, 'Dog'),
(52, 'Cairn Terrier', NULL, NULL, 'Dog'),
(53, 'Canaan Dog', NULL, NULL, 'Dog'),
(54, 'Cane Corso', NULL, NULL, 'Dog'),
(55, 'Cardigan Welsh Corgi', NULL, NULL, 'Dog'),
(56, 'Catahoula Leopard Dog', NULL, NULL, 'Dog'),
(57, 'Cavalier King Charles Spaniel', NULL, NULL, 'Dog'),
(58, 'Cesky Terrier', NULL, NULL, 'Dog'),
(59, 'Chesapeake Bay Retriever', NULL, NULL, 'Dog'),
(60, 'Chihuahua', NULL, NULL, 'Dog'),
(61, 'Chinese Crested', NULL, NULL, 'Dog'),
(62, 'Chinese Shar-Pei', NULL, NULL, 'Dog'),
(63, 'Chinook', NULL, NULL, 'Dog'),
(64, 'Chow Chow', NULL, NULL, 'Dog'),
(65, 'Clumber Spaniel', NULL, NULL, 'Dog'),
(66, 'Cockapoo', NULL, NULL, 'Dog'),
(67, 'Cocker Spaniel', NULL, NULL, 'Dog'),
(68, 'Collie', NULL, NULL, 'Dog'),
(69, 'Coton de Tulear', NULL, NULL, 'Dog'),
(70, 'Curly-Coated Retriever', NULL, NULL, 'Dog'),
(71, 'Value\r\n\r\n\r\n\r\n\r\n', NULL, NULL, 'Dog'),
(72, 'Dalmatian', NULL, NULL, 'Dog'),
(73, 'Dandie Dinmont Terrier', NULL, NULL, 'Dog'),
(74, 'Doberman Pinscher', NULL, NULL, 'Dog'),
(75, 'Dogue de Bordeaux', NULL, NULL, 'Dog'),
(76, 'English Cocker Spaniel', NULL, NULL, 'Dog'),
(77, 'English Foxhound', NULL, NULL, 'Dog'),
(78, 'English Setter', NULL, NULL, 'Dog'),
(79, 'English Springer Spaniel', NULL, NULL, 'Dog'),
(80, 'English Toy Spaniel', NULL, NULL, 'Dog'),
(81, 'Entlebucher Mountain Dog', NULL, NULL, 'Dog'),
(82, 'Field Spaniel', NULL, NULL, 'Dog'),
(83, 'Finnish Lapphund', NULL, NULL, 'Dog'),
(84, 'Finnish Spitz', NULL, NULL, 'Dog'),
(85, 'Flat-Coated Retriever', NULL, NULL, 'Dog'),
(86, 'Fox Terrier', NULL, NULL, 'Dog'),
(87, 'French Bulldog\r\n', NULL, NULL, 'Dog'),
(88, 'German Pinscher\r\n', NULL, NULL, 'Dog'),
(89, 'German Shepherd Dog\r\n', NULL, NULL, 'Dog'),
(90, 'German Shorthaired Pointer\r\n', NULL, NULL, 'Dog'),
(91, 'German Wirehaired Pointer\r\n', NULL, NULL, 'Dog'),
(92, 'Giant Schnauzer\r\n', NULL, NULL, 'Dog'),
(93, 'Glen of Imaal Terrier\r\n', NULL, NULL, 'Dog'),
(94, 'Goldador\r\n', NULL, NULL, 'Dog'),
(95, 'Golden Retriever\r\n', NULL, NULL, 'Dog'),
(96, 'Goldendoodle\r\n', NULL, NULL, 'Dog'),
(97, 'Gordon Setter\r\n', NULL, NULL, 'Dog'),
(98, 'Great Dane\r\n', NULL, NULL, 'Dog'),
(99, 'Great Pyrenees\r\n', NULL, NULL, 'Dog'),
(100, 'Greater Swiss Mountain Dog\r\n', NULL, NULL, 'Dog'),
(101, 'Greyhound\r\n', NULL, NULL, 'Dog'),
(102, 'Harrier\r\n', NULL, NULL, 'Dog'),
(103, 'Havanese\r\n', NULL, NULL, 'Dog'),
(104, 'Ibizan Hound\r\n', NULL, NULL, 'Dog'),
(105, 'Icelandic Sheepdog\r\n', NULL, NULL, 'Dog'),
(106, 'Irish Red and White Setter\r\n', NULL, NULL, 'Dog'),
(107, 'Irish Setter\r\n', NULL, NULL, 'Dog'),
(108, 'Irish Terrier\r\n', NULL, NULL, 'Dog'),
(109, 'Irish Water Spaniel\r\n', NULL, NULL, 'Dog'),
(110, 'Irish Wolfhound\r\n', NULL, NULL, 'Dog'),
(111, 'Italian Greyhound\r\n', NULL, NULL, 'Dog'),
(112, 'Jack Russell Terrier\r\n', NULL, NULL, 'Dog'),
(113, 'Japanese Chin\r\n', NULL, NULL, 'Dog'),
(114, 'Japanese Chin\r\n', NULL, NULL, 'Dog'),
(115, 'Keeshond\r\n', NULL, NULL, 'Dog'),
(116, 'Kerry Blue Terrier\r\n', NULL, NULL, 'Dog'),
(117, 'Komondor\r\n', NULL, NULL, 'Dog'),
(118, 'Kooikerhondje\r\n', NULL, NULL, 'Dog'),
(119, 'Korean Jindo Dog\r\n', NULL, NULL, 'Dog'),
(120, 'Kuvasz\r\n', NULL, NULL, 'Dog'),
(121, 'Labradoodle\r\n', NULL, NULL, 'Dog'),
(122, 'Labrador Retriever\r\n', NULL, NULL, 'Dog'),
(123, 'Lakeland Terrier\r\n', NULL, NULL, 'Dog'),
(124, 'Lancashire Heeler\r\n', NULL, NULL, 'Dog'),
(125, 'Leonberger\r\n', NULL, NULL, 'Dog'),
(126, 'Lhasa Apso\r\n', NULL, NULL, 'Dog'),
(127, 'Lowchen\r\n', NULL, NULL, 'Dog'),
(128, 'Maltese\r\n', NULL, NULL, 'Dog'),
(129, 'Maltese Shih Tzu\r\n', NULL, NULL, 'Dog'),
(130, 'Maltipoo\r\n', NULL, NULL, 'Dog'),
(131, 'Manchester Terrier\r\n', NULL, NULL, 'Dog'),
(132, 'Mastiff\r\n', NULL, NULL, 'Dog'),
(133, 'Miniature Pinscher\r\n', NULL, NULL, 'Dog'),
(134, 'Miniature Schnauzer\r\n', NULL, NULL, 'Dog'),
(135, 'Mutt\r\n', NULL, NULL, 'Dog'),
(136, 'Neapolitan Mastiff\r\n', NULL, NULL, 'Dog'),
(137, 'Newfoundland\r\n', NULL, NULL, 'Dog'),
(138, 'Norfolk Terrier\r\n', NULL, NULL, 'Dog'),
(139, 'Norwegian Buhund\r\n', NULL, NULL, 'Dog'),
(140, 'Norwegian Elkhound\r\n', NULL, NULL, 'Dog'),
(141, 'Norwegian Lundehund\r\n', NULL, NULL, 'Dog'),
(142, 'Norwich Terrier\r\n', NULL, NULL, 'Dog'),
(143, 'Nova Scotia Duck Tolling Retriever\r\n', NULL, NULL, 'Dog'),
(144, 'Old English Sheepdog\r\n', NULL, NULL, 'Dog'),
(145, 'Otterhound\r\n', NULL, NULL, 'Dog'),
(146, 'Papillon\r\n', NULL, NULL, 'Dog'),
(147, 'Peekapoo\r\n', NULL, NULL, 'Dog'),
(148, 'Pekingese\r\n', NULL, NULL, 'Dog'),
(149, 'Pembroke Welsh Corgi\r\n', NULL, NULL, 'Dog'),
(150, 'Petit Basset Griffon Vendeen\r\n', NULL, NULL, 'Dog'),
(151, 'Pharaoh Hound\r\n', NULL, NULL, 'Dog'),
(152, 'Plott\r\n', NULL, NULL, 'Dog'),
(153, 'Pocket Beagle\r\n', NULL, NULL, 'Dog'),
(154, 'Pointer\r\n', NULL, NULL, 'Dog'),
(155, 'Polish Lowland Sheepdog\r\n', NULL, NULL, 'Dog'),
(156, 'Pomeranian\r\n', NULL, NULL, 'Dog'),
(157, 'Poodle\r\n', NULL, NULL, 'Dog'),
(158, 'Portuguese Water Dog\r\n', NULL, NULL, 'Dog'),
(159, 'Pug\r\n', NULL, NULL, 'Dog'),
(160, 'Puggle\r\n', NULL, NULL, 'Dog'),
(161, 'Puli\r\n', NULL, NULL, 'Dog'),
(162, 'Pyrenean Shepherd\r\n', NULL, NULL, 'Dog'),
(163, 'Rat Terrier\r\n', NULL, NULL, 'Dog'),
(164, 'Redbone Coonhound\r\n', NULL, NULL, 'Dog'),
(165, 'Rhodesian Ridgeback\r\n', NULL, NULL, 'Dog'),
(166, 'Rottweiler\r\n', NULL, NULL, 'Dog'),
(167, 'Saint Bernard\r\n', NULL, NULL, 'Dog'),
(168, 'Saluki\r\n', NULL, NULL, 'Dog'),
(169, 'Samoyed\r\n', NULL, NULL, 'Dog'),
(170, 'Schipperke\r\n', NULL, NULL, 'Dog'),
(171, 'Schnoodle\r\n', NULL, NULL, 'Dog'),
(172, 'Scottish Deerhound\r\n', NULL, NULL, 'Dog'),
(173, 'Scottish Terrier\r\n', NULL, NULL, 'Dog'),
(174, 'Sealyham Terrier\r\n', NULL, NULL, 'Dog'),
(175, 'Shetland Sheepdog\r\n', NULL, NULL, 'Dog'),
(176, 'Shiba Inu\r\n', NULL, NULL, 'Dog'),
(177, 'Shih Tzu\r\n', NULL, NULL, 'Dog'),
(178, 'Siberian Husky\r\n', NULL, NULL, 'Dog'),
(179, 'Silky Terrier\r\n', NULL, NULL, 'Dog'),
(180, 'Skye Terrier\r\n', NULL, NULL, 'Dog'),
(181, 'Sloughi\r\n', NULL, NULL, 'Dog'),
(182, 'Small Munsterlander Pointer\r\n', NULL, NULL, 'Dog'),
(183, 'Soft Coated Wheaten Terrier\r\n', NULL, NULL, 'Dog'),
(184, 'Stabyhoun\r\n', NULL, NULL, 'Dog'),
(185, 'Staffordshire Bull Terrier\r\n', NULL, NULL, 'Dog'),
(186, 'Standard Schnauzer', NULL, NULL, 'Dog'),
(187, 'Sussex Spaniel\r\n', NULL, NULL, 'Dog'),
(188, 'Swedish Vallhund\r\n', NULL, NULL, 'Dog'),
(189, 'Tibetan Mastiff\r\n', NULL, NULL, 'Dog'),
(190, 'Tibetan Spaniel\r\n', NULL, NULL, 'Dog'),
(191, 'Tibetan Terrier\r\n', NULL, NULL, 'Dog'),
(192, 'Toy Fox Terrier\r\n', NULL, NULL, 'Dog'),
(193, 'Treeing Tennessee Brindle\r\n', NULL, NULL, 'Dog'),
(194, 'Treeing Walker Coonhound\r\n', NULL, NULL, 'Dog'),
(195, 'Vizsla\r\n', NULL, NULL, 'Dog'),
(196, 'Weimaraner\r\n', NULL, NULL, 'Dog'),
(197, 'Welsh Springer Spaniel\r\n', NULL, NULL, 'Dog'),
(198, 'Welsh Terrier\r\n', NULL, NULL, 'Dog'),
(199, 'West Highland White Terrier\r\n', NULL, NULL, 'Dog'),
(200, 'Whippet\r\n', NULL, NULL, 'Dog'),
(201, 'Wirehaired Pointing Griffon\r\n', NULL, NULL, 'Dog'),
(202, 'Xoloitzcuintli\r\n', NULL, NULL, 'Dog'),
(203, 'Yorkipoo\r\n', NULL, NULL, 'Dog'),
(204, 'Yorkshire Terrier\r\n', NULL, NULL, 'Dog'),
(205, 'Exotic Shorthair\r\n', NULL, NULL, 'Cat'),
(206, 'Maine Coon\r\n', NULL, NULL, 'Cat'),
(207, 'Manx\r\n', NULL, NULL, 'Cat'),
(208, 'Mekong Bobtail\r\n', NULL, NULL, 'Cat'),
(209, 'Persian (Modern Persian Cat)\r\n', NULL, NULL, 'Cat'),
(210, 'Ragdoll\r\n', NULL, NULL, 'Cat'),
(211, 'Scottish Fold\r\n', NULL, NULL, 'Cat'),
(212, 'Siamese\r\n', NULL, NULL, 'Cat'),
(213, 'Aegean\r\n', NULL, NULL, 'Cat'),
(214, 'American Curl\r\n', NULL, NULL, 'Cat'),
(215, 'American Bobtail\r\n', NULL, NULL, 'Cat'),
(216, 'American Shorthair\r\n', NULL, NULL, 'Cat'),
(217, 'American Wirehair\r\n', NULL, NULL, 'Cat'),
(218, 'Arabian Mau\r\n', NULL, NULL, 'Cat'),
(219, 'Australian Mist\r\n', NULL, NULL, 'Cat'),
(220, 'Asian\r\n', NULL, NULL, 'Cat'),
(221, 'Asian Semi-longhair\r\n', NULL, NULL, 'Cat'),
(222, 'Bambino\r\n', NULL, NULL, 'Cat'),
(223, 'Bengal', NULL, NULL, 'Cat'),
(224, 'Birman\r\n', NULL, NULL, 'Cat'),
(225, 'Bombay\r\n', NULL, NULL, 'Cat'),
(226, 'Brazilian Shorthair\r\n', NULL, NULL, 'Cat'),
(227, 'British Semi-longhair\r\n', NULL, NULL, 'Cat'),
(228, 'British Longhair\r\n', NULL, NULL, 'Cat'),
(229, 'Burmese\r\n', NULL, NULL, 'Cat'),
(230, 'Burmilla\r\n', NULL, NULL, 'Cat'),
(231, 'California Spangled\r\n', NULL, NULL, 'Cat'),
(232, 'Chantilly-Tiffany\r\n', NULL, NULL, 'Cat'),
(233, 'Chartreux\r\n', NULL, NULL, 'Cat'),
(234, 'Chausie\r\n', NULL, NULL, 'Cat'),
(235, 'Cheetoh\r\n', NULL, NULL, 'Cat'),
(236, 'Colorpoint Shorthair\r\n', NULL, NULL, 'Cat'),
(237, 'Cornish Rex\r\n', NULL, NULL, 'Cat'),
(238, 'Cymric\r\n', NULL, NULL, 'Cat'),
(239, 'Cyprus\r\n', NULL, NULL, 'Cat'),
(240, 'Donskoy,\r\n', NULL, NULL, 'Cat'),
(241, 'Devon Rex\r\n', NULL, NULL, 'Cat'),
(242, 'Dragon Li\r\n', NULL, NULL, 'Cat'),
(243, 'Dwarf cat\r\n', NULL, NULL, 'Cat'),
(244, 'Egyptian Mau\r\n', NULL, NULL, 'Cat'),
(245, 'European Shorthair\r\n', NULL, NULL, 'Cat'),
(246, 'Foldex\r\n', NULL, NULL, 'Cat'),
(247, 'German Rex\r\n', NULL, NULL, 'Cat'),
(248, 'Havana Brown\r\n', NULL, NULL, 'Cat'),
(249, 'Highlander\r\n', NULL, NULL, 'Cat'),
(250, 'Himalayan\r\n', NULL, NULL, 'Cat'),
(251, 'Japanese Bobtail\r\n', NULL, NULL, 'Cat'),
(252, 'Javanese\r\n', NULL, NULL, 'Cat'),
(253, 'Kurilian Bobtail\r\n', NULL, NULL, 'Cat'),
(254, 'KhaoManee\r\n', NULL, NULL, 'Cat'),
(255, 'Korat\r\n', NULL, NULL, 'Cat'),
(256, 'Korean Bobtail\r\n', NULL, NULL, 'Cat'),
(257, 'KornJa\r\n', NULL, NULL, 'Cat'),
(258, 'Kurilian Bobtail\r\n', NULL, NULL, 'Cat'),
(259, 'LaPerm\r\n', NULL, NULL, 'Cat'),
(260, 'Lykoi\r\n', NULL, NULL, 'Cat'),
(261, 'Minskin\r\n', NULL, NULL, 'Cat'),
(262, 'Munchkin\r\n', NULL, NULL, 'Cat'),
(263, 'Nebelung\r\n', NULL, NULL, 'Cat'),
(264, 'Napoleon\r\n', NULL, NULL, 'Cat'),
(265, 'Norwegian Forest cat\r\n', NULL, NULL, 'Cat'),
(266, 'Ocicat\r\n', NULL, NULL, 'Cat'),
(267, 'Ojos Azules\r\n', NULL, NULL, 'Cat'),
(268, 'Oregon Rex\r\n', NULL, NULL, 'Cat'),
(269, 'Oriental Bicolor\r\n', NULL, NULL, 'Cat'),
(270, 'Oriental Shorthair\r\n', NULL, NULL, 'Cat'),
(271, 'Oriental Longhair\r\n', NULL, NULL, 'Cat'),
(272, 'Persian (Traditional Persian Cat)\r\n', NULL, NULL, 'Cat'),
(273, 'Peterbald\r\n', NULL, NULL, 'Cat'),
(274, 'Pixie-bob\r\n', NULL, NULL, 'Cat'),
(275, 'Raas\r\n', NULL, NULL, 'Cat'),
(276, 'Ragamuffin', NULL, NULL, 'Cat\r\n'),
(277, 'Russian Blue\r\n', NULL, NULL, 'Cat\r\n'),
(278, 'Russian White, Black and Tabby\r\n', NULL, NULL, 'Cat'),
(279, 'Sam Sawet\r\n', NULL, NULL, 'Cat'),
(280, 'Savannah\r\n', NULL, NULL, 'Cat'),
(281, 'Selkirk Rex\r\n', NULL, NULL, 'Cat'),
(282, 'Serengeti\r\n', NULL, NULL, 'Cat'),
(283, 'Serrade petit\r\n', NULL, NULL, 'Cat'),
(284, 'Siberian\r\n', NULL, NULL, 'Cat'),
(285, 'Singapura\r\n', NULL, NULL, 'Cat'),
(286, 'Snowshoe', NULL, NULL, 'Cat'),
(287, 'Sokoke\r\n', NULL, NULL, 'Cat'),
(288, 'Somali\r\n', NULL, NULL, 'Cat'),
(289, 'Sphynx\r\n', NULL, NULL, 'Cat'),
(290, 'Suphalak\r\n', NULL, NULL, 'Cat'),
(291, 'Thai\r\n', NULL, NULL, 'Cat'),
(292, 'Thai Lilac\r\n', NULL, NULL, 'Cat'),
(293, 'Tonkinese\r\n', NULL, NULL, 'Cat'),
(294, 'Toyger\r\n', NULL, NULL, 'Cat'),
(295, 'Turkish Angora\r\n', NULL, NULL, 'Cat'),
(296, 'Turkish Van\r\n', NULL, NULL, 'Cat'),
(297, 'Ukrainian Levkoy\r\n', NULL, NULL, 'Cat\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('07d3035d64ad75c50846ada9f639d79c8e35a964', '45.117.212.193', 1489496282, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439363030313b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('0e83ac69ef2933b9264e05bfe5476ade3d408ab0', '45.117.212.193', 1489489583, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393438393231353b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('0fd36bcb4e8e1b1a9b85838f6f9c285e87f0c2bc', '45.117.212.193', 1489495981, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439353638363b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b6c6173745f706167657c733a36303a22687474703a2f2f736f6c7574696f6e6e65722e636f6d2f446973636f7665724d795065742f696e6465782e7068703f2f61646d696e2f646f63746f72223b),
('241522fefe9f2b8738b0aae00a7ea85c783ffdf4', '45.117.212.193', 1489497467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439363939343b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('2ca19769553c36b779ce335d39341ccfa105c52f', '45.117.212.193', 1489495075, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439353037303b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('3c46cd9731881231db34264d613083b25aa9a307', '45.117.212.193', 1489490955, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439303934373b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('3c659817b042cd5fbf3947fe0809be786d893756', '45.117.212.193', 1489491925, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439313237383b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('408193b720f56c9ae15cd3b973f2fcf60082d879', '45.117.212.193', 1489497764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439373535343b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('599eca0ccff1cc34c7aac22b66e36eea0a6b193e', '45.117.212.193', 1489489878, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393438393837373b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b6c6173745f696e7365727465645f69647c693a34373b),
('60f4cd519613f2453d622e488e1f17704f607f59', '45.117.212.193', 1489490910, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439303632353b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('694fdb4d229f3b2b5079cd8b54f3432a45a67c1d', '45.117.212.193', 1489499004, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439383831353b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('701a628ca2a23a3bffc9cca09016639ed97f9a57', '45.117.212.193', 1489495104, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439343838313b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('89f9ffe471f43e3e7960e189723462444a6d842d', '45.117.212.193', 1489491938, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439313933383b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('92e8fc544b3057db4b15f8ebf08e569d81058726', '45.117.212.193', 1489495136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439353133353b6c6173745f706167657c733a35343a22687474703a2f2f736f6c7574696f6e6e65722e636f6d2f446973636f7665724d795065742f696e6465782e7068703f2f646f63746f72223b),
('a05531b129e398d438b664fc4a6caed95af33e96', '45.117.212.193', 1489491537, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439313331343b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('ab05cf10cb5903fcff6547608c1cc9434965ab8f', '45.117.212.193', 1489490609, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439303332343b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('af5a6c79481f220d0d81b88cdac9d31cbc6379f5', '45.117.212.193', 1489496975, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439363637393b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('b5a957c5f2b5d4239983671382e63935450e927d', '45.117.212.193', 1489492210, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439323032353b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('b95c70975578279f9e5cea7158d9ec3a739c1433', '45.117.212.193', 1489559545, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393535393534353b),
('b9d55d6257d01c483c16d38879b6ffbe04ffad3c', '45.117.212.193', 1489492429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439323333333b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b6d6573736167657c733a31363a2253657474696e67732055706461746564223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('c1214ee76dda40854eacf93612f99a16f81e7c9e', '45.117.212.193', 1489495486, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439353238343b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('c18625bec3c446227fa4071e803bbcaf044470d2', '45.117.212.193', 1489498752, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439383437363b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('d029bca4c995c739f25b51bd57fff0c939d719b0', '45.117.212.193', 1489498815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439383831353b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b),
('db06aeae339a9367edca61e750755b518a0e7905', '45.117.212.193', 1489491080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439303835373b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('df9758a2a39ab248fe79f18870bcf27ed957bc8c', '45.117.212.193', 1489490491, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439303438373b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('ee6293be523d40ce2be202156e7f06bd9a9f4ab7', '45.117.212.193', 1489492014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439313637363b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a393a224d722e2041646d696e223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('f4b3635b22f0260bde94bb9bd442d1f843c773f2', '45.117.212.193', 1489496603, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438393439363332313b646f63746f725f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a323a223833223b6e616d657c733a333a22526f79223b6c6f67696e5f747970657c733a363a22646f63746f72223b);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` longtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `description`) VALUES
(1, 'General', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_report`
--

CREATE TABLE IF NOT EXISTS `diagnosis_report` (
  `diagnosis_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'xray,blood test',
  `document_type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'text,photo',
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `laboratorist_id` int(11) NOT NULL,
  PRIMARY KEY (`diagnosis_report_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `diagnosis_report`
--

INSERT INTO `diagnosis_report` (`diagnosis_report_id`, `report_type`, `document_type`, `file_name`, `prescription_id`, `description`, `timestamp`, `laboratorist_id`) VALUES
(1, 'blood_test', 'image', 'art8.jpg', 2, 'Description Here', 1483200300, 0),
(2, '', 'image', 'Jellyfish.jpg', 5, 'ww', 1485480000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `profile` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_no` varchar(255) DEFAULT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `vat_percentage` varchar(255) DEFAULT NULL,
  `service_tax` varchar(255) DEFAULT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `clinic_image` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `alternate_contact_no1` varchar(255) DEFAULT NULL,
  `alternate_contact_no2` varchar(255) DEFAULT NULL,
  `payment_amount` varchar(255) DEFAULT NULL,
  `payment_by` varchar(255) DEFAULT NULL,
  `state_council_registration_no` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `name`, `email`, `password`, `address`, `phone`, `department_id`, `profile`, `registration_no`, `clinic_name`, `role`, `admin_id`, `user_id`, `id`, `vat_percentage`, `service_tax`, `website_name`, `clinic_image`, `profile_image`, `alternate_contact_no1`, `alternate_contact_no2`, `payment_amount`, `payment_by`, `state_council_registration_no`, `order_id`, `created_at`) VALUES
(83, 'Roy', 'dt@gmail.com', 'Um95', '                                                                    ', '9404291000', 0, '', '', 'Roy', 'Doctor', 1, NULL, NULL, '20', '20', '', 'images (1).jpg_1488884456.jpg', 'images (2).jpg_1489045810.jpg', '', '', NULL, NULL, NULL, NULL, '2017-03-06 07:14:29'),
(84, 'Maitri', 'maitripandit19@gmail.com', 'MTIzNDU2Nw==', 'Ahmedabad', '9558272642', 0, '', '1235', 'Maitri''s Clinic', 'Doctor', 1, NULL, NULL, '', '', '', 'dog_bench_sit_curls_51392_1920x1080.jpg_1488956320.jpg', 'boy-04.jpg_1488956324.jpg', '', '', '120', 'Cheque', 'Maharshtra', NULL, '2017-03-08 06:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `instruction` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(225) DEFAULT NULL,
  `event_date` longtext,
  `event_time` time DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_date`, `event_time`, `doctor_id`) VALUES
(8, 'dsdsdf222', '1484277600', '01:15:00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `form_element`
--

CREATE TABLE IF NOT EXISTS `form_element` (
  `form_element_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `html` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`form_element_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `health_record`
--

CREATE TABLE IF NOT EXISTS `health_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type` varchar(255) DEFAULT NULL,
  `patient_id` varchar(255) DEFAULT NULL,
  `health_record` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `vaccine_name` varchar(255) DEFAULT NULL,
  `vaccine_date` longtext,
  `vaccine_status` varchar(255) DEFAULT NULL,
  `vaccine_brand_name` varchar(255) DEFAULT NULL,
  `vaccine_batch_no` varchar(255) DEFAULT NULL,
  `deworming_date` varchar(255) DEFAULT NULL,
  `deworming_status` varchar(255) DEFAULT NULL,
  `deworming_brand_name` varchar(255) DEFAULT NULL,
  `deworming_batch_no` varchar(255) DEFAULT NULL,
  `parasite_control_status` varchar(255) DEFAULT NULL,
  `parasite_control_brand_name` varchar(255) DEFAULT NULL,
  `parasite_control_batch_no` varchar(255) DEFAULT NULL,
  `diet` varchar(255) DEFAULT NULL,
  `brief_medical_history` varchar(255) DEFAULT NULL,
  `creation_timestamp` longtext,
  `allergy` varchar(255) DEFAULT NULL,
  `add_weight` varchar(255) DEFAULT NULL,
  `add_vaccination` varchar(255) DEFAULT NULL,
  `add_dewormer` varchar(255) DEFAULT NULL,
  `add_parasite` varchar(255) DEFAULT NULL,
  `add_diet` varchar(255) DEFAULT NULL,
  `add_allergy` varchar(255) DEFAULT NULL,
  `deworming_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `health_record`
--

INSERT INTO `health_record` (`id`, `file_type`, `patient_id`, `health_record`, `doctor_id`, `user_id`, `weight`, `height`, `vaccine_name`, `vaccine_date`, `vaccine_status`, `vaccine_brand_name`, `vaccine_batch_no`, `deworming_date`, `deworming_status`, `deworming_brand_name`, `deworming_batch_no`, `parasite_control_status`, `parasite_control_brand_name`, `parasite_control_batch_no`, `diet`, `brief_medical_history`, `creation_timestamp`, `allergy`, `add_weight`, `add_vaccination`, `add_dewormer`, `add_parasite`, `add_diet`, `add_allergy`, `deworming_name`) VALUES
(46, NULL, '176', NULL, '83', NULL, '', '', 'Hepatitis', NULL, 'Scheduled', '', '', NULL, 'Scheduled', '', '', 'In Line', 'Ticks', '', '', '', '2017-03-09', 'Rubber/Plastic', NULL, NULL, NULL, NULL, NULL, NULL, 'Roundworms');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `patient_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_entries` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `due_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  `doctor_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fees` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_billing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_number`, `patient_id`, `title`, `invoice_entries`, `creation_timestamp`, `due_timestamp`, `status`, `doctor_id`, `user_id`, `fees`, `total_amount`, `add_billing`) VALUES
(74, '19767', 186, 'AAA', '', '03/09/2017', '', 'paid', '83', NULL, '1000', '2000', NULL),
(75, '23846', 176, 'sffd', '', '2017-03-14', '', 'paid', '83', NULL, '200', '1000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_medicine`
--

CREATE TABLE IF NOT EXISTS `invoice_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `medicine_id` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `invoice_medicine`
--

INSERT INTO `invoice_medicine` (`id`, `invoice_id`, `quantity`, `price`, `medicine_id`, `doctor_id`, `user_id`) VALUES
(136, '70', '10', '10000', '29', '72', NULL),
(137, '71', '1', '21', '30', '81', NULL),
(138, '72', '10', '200', '31', '84', NULL),
(139, '72', '5', '100', '31', '84', NULL),
(140, '73', '2', '2000', '32', '83', NULL),
(141, '73', '6', '6000', '32', '83', NULL),
(142, '74', '1', '1000', '32', '83', NULL),
(143, '74', '1', '1000', '32', '83', NULL),
(144, '75', '1', '1000', '32', '83', NULL),
(145, '76', '1', '1000', '32', '83', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laboratorist`
--

CREATE TABLE IF NOT EXISTS `laboratorist` (
  `laboratorist_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`laboratorist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `laboratorist`
--

INSERT INTO `laboratorist` (`laboratorist_id`, `name`, `email`, `password`, `address`, `phone`) VALUES
(1, 'Labor', 'l@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE IF NOT EXISTS `medicine` (
  `medicine_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `medicine_category_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `manufacturing_company` longtext COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `medicine_sub_category_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`medicine_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `name`, `medicine_category_id`, `description`, `price`, `manufacturing_company`, `quantity`, `supplier_id`, `medicine_sub_category_id`, `doctor_id`, `user_id`) VALUES
(32, 'aa', 19, 'a', '1000', 'a', '71', 15, '38', '83', NULL),
(31, 'jnakxjank', 22, '', '20', 'Jumbo Food', '8', 14, '40', '84', NULL),
(30, 'sddcsdc', 22, 'gghv', '21', 'jbj', '53', 13, '41', '81', NULL),
(29, 'Ativan', 19, '', '1000', 'Ativan', '999970', 12, '36', '72', NULL),
(27, 'xyz', 22, 'jbkasbx', '259', 'Pedigree', '200', 12, '73', '72', NULL),
(28, 'Royal Canin Chew Sticks', 22, '', '200', 'Royal Canin', '200', 12, '40', '72', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE IF NOT EXISTS `medicine_category` (
  `medicine_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_for_all` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`medicine_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`medicine_category_id`, `name`, `doctor_id`, `user_id`, `category_for_all`) VALUES
(17, 'Beds & Furniture', NULL, NULL, 'True'),
(18, 'Carriers & Travel Products', NULL, NULL, 'True'),
(19, 'Collars, Harnesses & Leashes', NULL, NULL, 'True'),
(20, 'Doors, Gates & Ramps', NULL, NULL, 'True'),
(21, 'Feeding & Watering Supplies', NULL, NULL, 'True'),
(23, 'Grooming', NULL, NULL, 'True'),
(45, 'Training & Behavior Aids', NULL, NULL, 'True'),
(44, 'Houses, Kennels & Pens', NULL, NULL, 'True'),
(43, 'Litter & Housebreaking', NULL, NULL, 'True'),
(42, 'Toys', NULL, NULL, 'True'),
(41, 'Clothing & Accessories', NULL, NULL, 'True'),
(40, 'Pet Food', NULL, NULL, 'True'),
(39, 'Health Supplies', NULL, NULL, 'True'),
(38, 'Food', '72', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_sub_category`
--

CREATE TABLE IF NOT EXISTS `medicine_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `sub_category_for_all` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `medicine_sub_category`
--

INSERT INTO `medicine_sub_category` (`id`, `medicine_category_id`, `name`, `doctor_id`, `user_id`, `sub_category_for_all`) VALUES
(17, 41, 'Bandanas', NULL, NULL, 'True'),
(18, 41, 'Boots & Paw Protectors', NULL, NULL, 'True'),
(20, 41, 'Cold Weather Coats', NULL, NULL, 'True'),
(21, 41, 'Costumes', NULL, NULL, 'True'),
(22, 41, 'Dresses', NULL, NULL, 'True'),
(23, 41, 'Hats', NULL, NULL, 'True'),
(24, 41, 'Hoodies', NULL, NULL, 'True'),
(25, 41, 'Lifejackets', NULL, NULL, 'True'),
(26, 41, 'Raincoats', NULL, NULL, 'True'),
(27, 41, 'Shirts', NULL, NULL, 'True'),
(28, 41, 'Sweaters', NULL, NULL, 'True'),
(29, 17, 'Bed Blankets', NULL, NULL, 'True'),
(30, 17, 'Beds', NULL, NULL, 'True'),
(31, 17, 'Sofas & Chairs', NULL, NULL, 'True'),
(32, 18, 'Backpacks', NULL, NULL, 'True'),
(33, 18, 'Car Travel Accessories', NULL, NULL, 'True'),
(35, 19, 'Collar Charms', NULL, NULL, 'True'),
(36, 19, 'Collars', NULL, NULL, 'True'),
(37, 19, 'Harnesses', NULL, NULL, 'True'),
(38, 19, 'Leashes', NULL, NULL, 'True'),
(39, 19, 'Muzzles', NULL, NULL, 'True'),
(40, 40, 'Dry Food', NULL, NULL, 'True'),
(41, 40, 'Wet Food', NULL, NULL, 'True'),
(44, 23, 'Brushes', NULL, NULL, 'True'),
(45, 23, 'Combs', NULL, NULL, 'True'),
(46, 23, 'Deodorizers', NULL, NULL, 'True'),
(47, 23, 'Grooming Wipes', NULL, NULL, 'True'),
(48, 23, 'Hair Removal Mitts & Rollers', NULL, NULL, 'True'),
(49, 23, 'Scissors', NULL, NULL, 'True'),
(50, 23, 'Shampoos & Conditioners', NULL, NULL, 'True'),
(51, 23, 'Shower & Bath Accessories', NULL, NULL, 'True'),
(52, 39, 'Dental Care', NULL, NULL, 'True'),
(53, 39, 'Flea, Lice & Tick Control', NULL, NULL, 'True'),
(54, 39, 'Supplements & Vitamins', NULL, NULL, 'True'),
(55, 43, 'Diapers', NULL, NULL, 'True'),
(56, 43, 'Training Pads', NULL, NULL, 'True'),
(57, 42, 'Balls', NULL, NULL, 'True'),
(58, 42, 'Chew Toys', NULL, NULL, 'True'),
(59, 42, 'Interactive Toys', NULL, NULL, 'True'),
(60, 42, 'Plush Toys', NULL, NULL, 'True'),
(61, 42, 'Ropes', NULL, NULL, 'True'),
(63, 40, 'Bones', NULL, NULL, 'True'),
(64, 29, 'Cookies, Biscuits & Snacks', NULL, NULL, 'True'),
(65, 40, 'Jerky', NULL, NULL, 'True'),
(66, 40, 'Rawhide', NULL, NULL, 'True'),
(75, 16, 'Clothing', '72', NULL, NULL),
(76, 39, 'Dewormers', NULL, NULL, 'True'),
(77, 39, 'Heart Health\r\n\r\n\r\n\r\n\r\n\r\n', NULL, NULL, 'True'),
(78, 39, 'Digestive', NULL, NULL, 'True'),
(79, 39, 'Skin Care', NULL, NULL, 'True'),
(80, 39, 'Ear Care', NULL, NULL, 'True'),
(81, 39, 'Eye Care', NULL, NULL, 'True'),
(82, 39, 'Pain', NULL, NULL, 'True'),
(83, 39, 'Bone Care', NULL, NULL, 'True'),
(84, 39, 'Sanitory', NULL, NULL, 'True'),
(85, 39, 'Fur Care', NULL, NULL, 'True'),
(86, 39, 'NSAID’s', NULL, NULL, 'True'),
(87, 40, 'Treats', NULL, NULL, 'True'),
(88, 40, 'Cookies', NULL, NULL, 'True'),
(89, 40, 'Cake', NULL, NULL, 'True'),
(90, 40, 'Pastries', NULL, NULL, 'True'),
(91, 40, 'Biscuits & Snacks', NULL, NULL, 'True'),
(92, 40, 'Muffins\r\n\r\n\r\n\r\n\r\n\r\n', NULL, NULL, 'True'),
(95, 20, 'Doors, Gates & Ramps', NULL, NULL, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext NOT NULL,
  `message` longtext NOT NULL,
  `sender` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 unread 1 read',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message_thread_code`, `message`, `sender`, `timestamp`, `read_status`) VALUES
(46, '5f9f8bd0085ef63', 'hiiii', 'doctor-83', '1489060241', 0),
(44, 'c65a401618c9491', 'lucy', 'doctor-83', '1489053710', 0),
(45, '5f9f8bd0085ef63', 'Hows it', 'doctor-83', '1489056261', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

CREATE TABLE IF NOT EXISTS `message_thread` (
  `message_thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reciever` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_message_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`message_thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `message_thread`
--

INSERT INTO `message_thread` (`message_thread_id`, `message_thread_code`, `sender`, `reciever`, `last_message_timestamp`) VALUES
(1, '70465ce03247384', 'doctor-81', 'patient-177', ''),
(3, '34dcb2cfd67a585', 'doctor-84', 'patient-182', ''),
(7, '5f9f8bd0085ef63', 'doctor-83', 'patient-186', '');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `color` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_create` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_last_update` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `start_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `end_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `name`, `description`, `image_path`, `doctor_id`, `file_type`, `user_id`) VALUES
(10, 'Discount', '10%', '1488546878.jpg', 72, 'image/jpeg', NULL),
(11, 'test', 'test', '1489486304.jpg', 83, 'image/jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE IF NOT EXISTS `nurse` (
  `nurse_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`nurse_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `account_opening_timestamp` int(11) NOT NULL,
  `doctor_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `species` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grooming_package` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sterilization_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `breed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brief_medical_history` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `master_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mating_preference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drug_sensitivity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `microchip_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boarding_everytime_details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_dog` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=187 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `name`, `email`, `password`, `address`, `phone`, `sex`, `birth_date`, `age`, `blood_group`, `account_opening_timestamp`, `doctor_id`, `user_id`, `species`, `grooming_package`, `sterilization_status`, `color`, `breed`, `parent_name`, `parent_contact_no`, `parent_address`, `brief_medical_history`, `remarks`, `master_id`, `mating_preference`, `drug_sensitivity`, `microchip_no`, `boarding_everytime_details`, `unique_id`, `verify_dog`) VALUES
(176, 'Tom', 't@t.com', 'VG9t', '', '1234567890', 'Male', '0', '0', 'A+', 0, '83', NULL, 'Dog', NULL, 'Yes', 'Black', 'Abyssinian', 'Tom', '1234567890', 'pune', NULL, '                           	                            	                             \r\n                                                                                    ', NULL, '', '', '', NULL, '', NULL),
(186, 'Lucy', 'dtlohare1@gmail.com', '', '', '9404291463', 'Male', '0', '0', 'A+', 0, '83', NULL, 'Cat', NULL, 'Yes', 'Amber', NULL, 'Lucy', '9404291463', 'Lucy', NULL, '										                             \r\n                            										', NULL, '', '', '', NULL, '', NULL),
(182, 'Piku', 'sizzling19dews@gmail.com', 'MTIzNDU2Nw==', '', '9558272642', 'Male', '1475539200', '0 years, 5 months, and 4 days', '', 0, '84', NULL, 'Dog', NULL, 'Yes', 'Amber', '', 'Mishree', '9558272642', 'Pune', NULL, '                            \r\n                            ', '84760', 'Yes', 'Yes', '', NULL, '', NULL),
(183, 'pravin', 'pravinjagtap2542@gmail.com', '', '', '9860438496', 'Male', '1501718400', '0 years, 0 months, and 0 days', 'A+', 0, '84', NULL, 'Cat', NULL, 'Yes', 'Amber', NULL, 'pravin', '9860438496', 'Pune', NULL, '										                             1\r\n                            										', NULL, '1', '1', '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'income expense',
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE IF NOT EXISTS `pharmacist` (
  `pharmacist_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pharmacist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE IF NOT EXISTS `prescription` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `add_prescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`prescription_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_prescreption`
--

CREATE TABLE IF NOT EXISTS `product_prescreption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precreption_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dose` varchar(255) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `product_prescreption`
--

INSERT INTO `product_prescreption` (`id`, `precreption_id`, `quantity`, `dose`, `medicine_id`, `doctor_id`, `user_id`) VALUES
(48, 32, 3443, '22', 27, 72, NULL),
(49, 32, 2, 'er33', 28, 72, NULL),
(50, 33, 5, '5', 29, 72, NULL),
(51, 33, 10, '6', 29, 72, NULL),
(52, 34, 2, '3', 30, 81, NULL),
(53, 35, 5, '2', 32, 83, NULL),
(54, 36, 23, '2', 32, 83, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE IF NOT EXISTS `receptionist` (
  `receptionist_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`receptionist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'operation,birth,death',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `death_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `death_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `type`, `description`, `timestamp`, `doctor_id`, `patient_id`, `parent_name`, `death_location`, `death_reason`, `user_id`) VALUES
(8, 'birth', 'SSS', '1490140800', 83, 182, NULL, '', '', NULL),
(7, 'operation', 'AAA', '1488412800', 83, 186, NULL, '', '', NULL),
(6, 'operation', '', '1489536000', 72, 170, NULL, '', '', NULL),
(9, 'death', 'SSS', '1489104000', 83, 176, NULL, 'SSS', 'AS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Vet Nex'),
(2, 'system_title', 'Vet Nex'),
(3, 'address', 'Pune'),
(4, 'phone', '8412013381'),
(5, 'paypal_email', 'payment@creativeitem.com'),
(6, 'currency', 'usd'),
(7, 'system_email', 'info@discovermypet.in'),
(8, 'buyer', ''),
(9, 'purchase_code', ''),
(11, 'language', 'english'),
(12, 'text_align', 'left-to-right'),
(13, 'system_currency_id', '1'),
(14, 'clickatell_user', '[YOUR CLICKATELL USERNAME]'),
(15, 'clickatell_password', '[YOUR CLICKATELL PASSWORD]'),
(16, 'clickatell_api_id', '[YOUR CLICKATELL API ID]');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `phone`, `email`, `doctor_id`, `user_id`, `role`) VALUES
(12, 'Manmohan Sinha', 'Pune', '1234567891', 'man@gmail.com', 72, NULL, 'doctor'),
(13, 'Minku', 'Pune', '8805194395', 'sizzling21dews@gmail.com', 81, NULL, 'doctor'),
(14, 'Kanhika', 'Pune', '8805194395', 'sizzling21dews@gmail.com', 84, NULL, 'doctor'),
(15, 'sss', 's', 's', 's@s.com', 83, NULL, 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_id`, `name`, `email`, `role`, `password`, `address`, `phone`, `user_id`, `admin_id`, `profile`) VALUES
(11, 72, 'Staff', 'Staff@Staff.COM', 'Ambulance Service', 'U3RhZmY=', 'Pune', 1111111111, NULL, NULL, NULL),
(12, 83, 'DD', 'D@D1.COM', 'Breeder', NULL, 'SS', 2147483647, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
