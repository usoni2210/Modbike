-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 05, 2019 at 11:06 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modbike`
--
DROP DATABASE IF EXISTS `modbike`;
CREATE DATABASE IF NOT EXISTS `modbike` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `modbike`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(25) NOT NULL,
  `admin_username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `email_id` varchar(35) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `image` varchar(30) DEFAULT NULL,
  `update_profile` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_username` (`admin_username`),
  UNIQUE KEY `phone_no` (`phone_no`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `password`, `email_id`, `phone_no`, `image`, `update_profile`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@modbike.com', '9876543210', 'admin.png', '2019-03-22 16:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

DROP TABLE IF EXISTS `bikes`;
CREATE TABLE IF NOT EXISTS `bikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `release_year` int(4) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_company_id` (`comp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `name`, `comp_id`, `type`, `release_year`, `created_on`) VALUES
(1, 'YZF R3', 4, 'Sport Bikes', 2018, '2019-03-23 10:45:03'),
(2, 'Avenger Street 220', 1, 'Adventure Touring Bikes', 2018, '2019-03-23 10:51:30'),
(3, 'Passion Pro i3s', 3, 'Choppers', 2017, '2019-03-23 10:53:25'),
(4, 'Intruder', 5, 'Cruisers', 2017, '2019-04-04 16:07:06'),
(5, 'S 1000 RR', 2, 'Sport Bikes', 2009, '2019-04-04 16:13:25');


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_name` varchar(100) NOT NULL,
  `logo_file` varchar(20) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `comp_name`, `logo_file`, `created_on`) VALUES
(1, 'BAJAJ', '1.png', '2019-03-18 19:10:37'),
(2, 'BMW', '2.png', '2019-03-18 19:10:59'),
(3, 'Hero', '3.png', '2019-03-18 19:11:08'),
(4, 'YAMAHA', '4.png', '2019-03-18 19:11:32'),
(5, 'Suzuki', '5.png', '2019-03-18 19:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_view` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`, `upload_date`, `is_view`) VALUES
(1, 'Umesh Soni', 'usoni2210@gmail.com', 'Feedback Testing 1', 'Thank You', '2019-03-23 10:11:15', 1),
(2, 'Ankit Agarwal', 'ankit.agarwal2018@vitstudent.ac.in', 'Feedback Testing 2', 'Good Work', '2019-03-23 10:11:32', 1),
(3, 'Yash Laddha', 'yashladdha72@gmail.com', 'Feedback Testing 3', 'Always Happy', '2019-03-23 10:11:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(40) NOT NULL,
  `file_name` varchar(10) DEFAULT NULL,
  `email_id` varchar(35) NOT NULL,
  `make_private` tinyint(1) NOT NULL DEFAULT '0',
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_by` int(11) DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `fk_admin_id_approve` (`approved_by`),
  KEY `fk_admin_id_disable` (`disable_by`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `file_name`, `email_id`, `make_private`, `upload_date`, `approved_by`, `disable_by`) VALUES
(1, 'BMW R1200 GS Cafe Racer', '1.jpg', 'usoni2210@gmail.com', 1, '2019-03-23 10:54:27', 3, NULL),
(2, 'BMW S1000RR ABS 2012', '2.jpg', 'Test@mail.com', 0, '2019-03-23 10:54:35', 3, NULL),
(3, 'Harley Davidson Iron Average', '3.jpg', 'ankit.agarwal2018@gmail.com', 0, '2019-03-23 10:54:44', 3, NULL),
(4, 'Harley Davidson Sportster', '4.jpg', 'usoni2210@gmail.com', 0, '2019-03-23 10:54:51', 3, NULL),
(5, 'Kawasaki Z1000 SX 2016', '5.jpg', 'yashladda72@gmail.com', 0, '2019-03-23 10:55:01', 3, NULL),
(6, 'Pulsar 200 NS', '6.jpg', 'usoni2210@gmail.com', 0, '2019-03-23 10:57:06', 1, NULL),
(7, 'Kawasaki Z1000', '7.jpg', 'usoni2210@hotmail.com', 0, '2019-03-23 10:56:34', NULL, NULL),
(8, 'KTM 790 Duke', '8.jpg', 'Test@mail.com', 0, '2019-03-23 10:56:44', NULL, NULL),
(9, 'Modern Motorcycle', '9.jpg', 'Test@mail.com', 1, '2019-03-23 10:56:52', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cid` int(11) NOT NULL,
  `image` varchar(25) DEFAULT NULL,
  `price` varchar(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `name`, `cid`, `image`, `price`, `created_on`) VALUES
(1, 'Bikz Hub Petrol Tank RX100', 3, '1.jpg', '4900', '2019-03-23 09:46:07'),
(2, 'Custom Aluminum Gas Tank', 3, '2.jpg', '4500', '2019-03-23 09:49:42'),
(3, 'TB-R Edge Gas Tank', 3, '3.jpg', '4150', '2019-03-23 09:51:52'),
(4, 'Segolike 12V 35W Black Dual LED Headlight', 4, '4.jpg', '1740', '2019-03-23 09:54:10'),
(5, 'BJ-HLA-002 Custom Headlight', 4, '5.jpg', '2500', '2019-03-23 10:01:25'),
(6, 'BJ-HLA-004 Double Headlight', 4, '6.jpg', '2000', '2019-03-23 10:03:42'),
(7, 'Gallop Style Twin Bike Seat', 5, '7.jpg', '846', '2019-03-23 10:06:41'),
(8, 'EXRSCET PU Bike Seat', 5, '8.jpg', '750', '2019-03-23 10:08:16'),
(9, 'EXCSCRB PU Bike Seat', 5, '9.jpg', '500', '2019-03-23 10:09:56'),
(10, 'True Vision PE-2', 2, '10.jpg', '549', '2019-03-23 10:15:05'),
(11, 'Andride 51mm Inlet Long Grenade Launcher Shape', 2, '11.jpg', '2499', '2019-03-23 10:16:52'),
(12, 'Trustway WV01RCA08417', 2, '12.jpg', '2400', '2019-03-23 10:21:01'),
(13, 'Autofy Universal Bright Tail Light', 1, '13.jpg', '426', '2019-03-23 10:23:51'),
(14, 'Generic Chopped Fender Edge', 1, '14.jpg', '1780', '2019-03-23 10:26:33'),
(15, 'X-Wing Tail Light ', 1, '15.jpg', '730', '2019-03-23 10:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `part_category`
--

DROP TABLE IF EXISTS `part_category`;
CREATE TABLE IF NOT EXISTS `part_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  `table_name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_category`
--

INSERT INTO `part_category` (`id`, `cat_name`, `table_name`) VALUES
(1, 'Tail Light', 'tbl_tail_light'),
(2, 'Silencer', 'tbl_silencer'),
(3, 'Fuel Tanks', 'tbl_fuel_tank'),
(4, 'Head Light', 'tbl_head_light'),
(5, 'Seat', 'tbl_seat');

-- --------------------------------------------------------

--
-- Table structure for table `part_support`
--

DROP TABLE IF EXISTS `part_support`;
CREATE TABLE IF NOT EXISTS `part_support` (
  `bid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`pid`,`bid`),
  KEY `fk_bike_id_support` (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_support`
--

INSERT INTO `part_support` (`bid`, `pid`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 7),
(1, 9),
(1, 10),
(1, 11),
(1, 13),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 10),
(2, 14),
(2, 15),
(3, 1),
(3, 2),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 12),
(3, 14),
(3, 15),
(4, 2),
(4, 3),
(4, 4),
(4, 6),
(4, 8),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(5, 1),
(5, 3),
(5, 5),
(5, 6),
(5, 8),
(5, 9),
(5, 11),
(5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `shoppes`
--

DROP TABLE IF EXISTS `shoppes`;
CREATE TABLE IF NOT EXISTS `shoppes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `owner` varchar(35) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `image` varchar(30) DEFAULT NULL,
  `addr_fline` varchar(40) NOT NULL,
  `addr_sline` varchar(40) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(25) NOT NULL,
  `pin_code` varchar(6) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppes`
--

INSERT INTO `shoppes` (`id`, `name`, `owner`, `phone_no`, `image`, `addr_fline`, `addr_sline`, `city`, `state`, `pin_code`, `created_on`, `updated_on`) VALUES
(1, 'Rathore Bike Modification', 'D. S Rathore', '919152676425', '1.jpg', 'Shop No 1, Baara Hazari Street,', 'Nanpura Main Road, Nanpura', 'Surat', 'Gujarat', '395001', '2019-03-23 10:35:49', '2019-03-23 10:35:49'),
(2, 'Bike World', 'R. K. Sharma', '08041757475', '2.JPG', 'Yelahanka New Town,', 'Hosur Main Road,', 'Bangalore', 'Karnataka', '560064', '2019-03-23 10:40:22', '2019-03-23 10:40:22'),
(5, 'Thirumala Auto Accessories', 'Kailash Thirumala', '9845194915', '5.jpg', '100 Goverdhan Building Lalbagh Fort Road', 'Doddamavalli Sudhama Nagar', 'bangalore', 'karnataka', '560004', '2019-04-04 15:46:09', '2019-04-04 15:46:09'),
(6, 'Golden Bikes', 'VS Tripathi', '9811997999', '6.jpg', 'Gali No 52 Nai Walan Karol Bagh', 'Near Vardhman Hotel', 'Delhi', 'UttarPradesh', '110005', '2019-04-04 15:47:44', '2019-04-04 15:47:44'),
(7, 'BD KITZ', 'Shankar Singh', '7608080561', '7.jpg', 'R 8 Vaishali Nagar', 'Nursery Circle', 'jaipur', 'rajasthan', '302021', '2019-04-04 16:44:37', '2019-04-04 16:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `shop_sales`
--

DROP TABLE IF EXISTS `shop_sales`;
CREATE TABLE IF NOT EXISTS `shop_sales` (
  `sid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`sid`,`pid`),
  KEY `fk_part_id_sales` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_sales`
--

INSERT INTO `shop_sales` (`sid`, `pid`) VALUES
(1, 1),
(2, 1),
(5, 1),
(1, 2),
(2, 2),
(2, 3),
(6, 3),
(7, 3),
(1, 4),
(2, 4),
(7, 4),
(2, 5),
(5, 5),
(2, 6),
(6, 6),
(1, 7),
(2, 7),
(2, 8),
(6, 8),
(7, 8),
(2, 9),
(5, 9),
(1, 10),
(2, 10),
(2, 11),
(5, 11),
(2, 12),
(6, 12),
(7, 12),
(1, 13),
(2, 13),
(6, 13),
(2, 14),
(7, 14),
(1, 15),
(2, 15),
(5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_tank`
--

DROP TABLE IF EXISTS `tbl_fuel_tank`;
CREATE TABLE IF NOT EXISTS `tbl_fuel_tank` (
  `id` int(11) NOT NULL,
  `capacity` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fuel_tank`
--

INSERT INTO `tbl_fuel_tank` (`id`, `capacity`, `color`) VALUES
(1, '11', 'Multi-Color'),
(2, '11', 'Red-Blue'),
(3, '11', 'Black-Green');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_head_light`
--

DROP TABLE IF EXISTS `tbl_head_light`;
CREATE TABLE IF NOT EXISTS `tbl_head_light` (
  `id` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `dimension` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_head_light`
--

INSERT INTO `tbl_head_light` (`id`, `material`, `dimension`, `color`) VALUES
(4, 'Plastic', '5x5x5', 'Black'),
(5, 'ABS Plastic', '7x6x5', 'Black with Reflective Chrome Interior Housing'),
(6, 'ABS Plastic', '10x8x5', 'Black with Reflective Chrome Interior Housing');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seat`
--

DROP TABLE IF EXISTS `tbl_seat`;
CREATE TABLE IF NOT EXISTS `tbl_seat` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `material` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seat`
--

INSERT INTO `tbl_seat` (`id`, `type`, `material`, `color`) VALUES
(7, 'Split', 'Leatherite', 'Black'),
(8, 'Single', 'Nylon', 'Black'),
(9, 'Single', 'Nylon', 'Red, Black');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_silencer`
--

DROP TABLE IF EXISTS `tbl_silencer`;
CREATE TABLE IF NOT EXISTS `tbl_silencer` (
  `id` int(11) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `dimension` varchar(10) NOT NULL,
  `material` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_silencer`
--

INSERT INTO `tbl_silencer` (`id`, `weight`, `dimension`, `material`) VALUES
(10, '499', '32x6x6', 'Durable Long lasting Steel'),
(11, '1860', '22x22x45', 'Metal'),
(12, '3960', '48x8x8', 'Metal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tail_light`
--

DROP TABLE IF EXISTS `tbl_tail_light`;
CREATE TABLE IF NOT EXISTS `tbl_tail_light` (
  `id` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `dimension` varchar(20) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tail_light`
--

INSERT INTO `tbl_tail_light` (`id`, `material`, `dimension`, `color`) VALUES
(13, 'Plastic', '5x4x2', 'White'),
(14, 'ABS Plastic', '16.5x3x7.5', 'Red'),
(15, 'ABS Plastic', '5.4x0.6x0.8', 'White');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bikes`
--
ALTER TABLE `bikes`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`comp_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_admin_id_approve` FOREIGN KEY (`approved_by`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_admin_id_disable` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`cid`) REFERENCES `part_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `part_support`
--
ALTER TABLE `part_support`
  ADD CONSTRAINT `fk_bike_id_support` FOREIGN KEY (`bid`) REFERENCES `bikes` (`id`),
  ADD CONSTRAINT `fk_part_id_support` FOREIGN KEY (`pid`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_sales`
--
ALTER TABLE `shop_sales`
  ADD CONSTRAINT `fk_part_id_sales` FOREIGN KEY (`pid`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shop_id_sales` FOREIGN KEY (`sid`) REFERENCES `shoppes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_fuel_tank`
--
ALTER TABLE `tbl_fuel_tank`
  ADD CONSTRAINT `fk_part_id_fuel` FOREIGN KEY (`id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_head_light`
--
ALTER TABLE `tbl_head_light`
  ADD CONSTRAINT `fk_part_id_head` FOREIGN KEY (`id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_seat`
--
ALTER TABLE `tbl_seat`
  ADD CONSTRAINT `fk_part_id_seat` FOREIGN KEY (`id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_silencer`
--
ALTER TABLE `tbl_silencer`
  ADD CONSTRAINT `fk_part_id_silencer` FOREIGN KEY (`id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_tail_light`
--
ALTER TABLE `tbl_tail_light`
  ADD CONSTRAINT `fk_part_id_tail` FOREIGN KEY (`id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
