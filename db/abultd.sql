-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2015 at 08:39 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abultd`
--
DROP DATABASE IF EXISTS abultd;
CREATE DATABASE IF NOT EXISTS abultd DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE abultd;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` date DEFAULT NULL,
  `paymentType` varchar(45) DEFAULT NULL,
  `service_type` varchar(45) DEFAULT NULL,
  `service_start` date DEFAULT NULL,
  `service_end` date DEFAULT NULL,
  `customer_customer_id` int(11) NOT NULL,
  `invoice_invoice_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `fk_booking_customer1_idx` (`customer_customer_id`),
  KEY `fk_booking_invoice1_idx` (`invoice_invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `booking_vehicle`
--

CREATE TABLE IF NOT EXISTS `booking_vehicle` (
  `booking_booking_id` int(11) NOT NULL,
  `vehicle_vehicle_id` int(11) NOT NULL,
  `employee_employee_id` int(11) DEFAULT NULL,
  KEY `fk_vehicle_booking_booking1_idx` (`booking_booking_id`),
  KEY `fk_vehicle_booking_vehicle1_idx` (`vehicle_vehicle_id`),
  KEY `fk_vehicle_booking_employee1_idx` (`employee_employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE IF NOT EXISTS `card_info` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`card_id`),
  KEY `my_contacts_contact_id_fk` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `card_info`
--

INSERT INTO `card_info` (`card_id`, `name`, `card_number`, `expiry_date`, `customer_id`) VALUES
(23, 'Visa', '456534565434', '2020-06-30', 23),
(24, 'Access', '4567345676543456', '2016-03-31', 24),
(25, 'Visa', '3454345654323232', '2017-04-30', 25),
(26, 'Visa', '4543454345432345', '2017-04-30', 26),
(27, 'Access', '454343435434354433', '2019-04-30', 27);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `telephone_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `service` varchar(45) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE IF NOT EXISTS `payment_type` (
  `payment_id` int(11) NOT NULL,
  `paymentType` varchar(45) DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `booking_booking_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_payment_type_booking1_idx` (`booking_booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `telephone_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `creation_date`, `name`, `surname`, `gender`, `address`, `telephone_number`, `email`) VALUES
(23, '2015-12-13', 'Brendan', 'Devane', 'Male', 'Apt 5, 49 Dominick Street,\r\nGalway, Co Galway', '0942233333', 'G00016931@GMIT.IE'),
(24, '2015-12-13', 'John', 'Devane', 'Male', 'Woodstock, Ballindine\r\nCO Mayo', '09434343433', 'john@fakemail.com'),
(25, '2015-12-13', 'Anne', 'Dunne', 'Female', '14 Main Street\r\nGalway', '0912345667', 'anne@fakemail.com'),
(26, '2015-12-13', 'Tara', 'Murphy', 'Female', '37 Lower Baggot Street\r\nDublin 4', '013223423322', 'tara@fakemail.com'),
(27, '2015-12-13', 'Tom', 'Byrne', 'Male', '99 Main Street\r\nCastlebar\r\nCo Mayo', '09433545443', 'tomb@fakemail.com');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `no_of_seats` varchar(45) DEFAULT NULL,
  `vehicle_rates_vehicle_rate_id` int(11) NOT NULL,
  `checked_out` tinyint(1) DEFAULT NULL,
  `milage` int(10) unsigned DEFAULT NULL,
  `daily_rate` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_inspection`
--

CREATE TABLE IF NOT EXISTS `vehicle_inspection` (
  `inspection_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_inspected` date DEFAULT NULL,
  `roadworthy` tinyint(1) DEFAULT NULL,
  `vehicle_vehicle_id` int(11) NOT NULL,
  PRIMARY KEY (`inspection_id`,`vehicle_vehicle_id`),
  KEY `fk_vehicle_inspection_vehicle1_idx` (`vehicle_vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `users` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_invoice1` FOREIGN KEY (`invoice_invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `booking_vehicle`
--
ALTER TABLE `booking_vehicle`
  ADD CONSTRAINT `fk_vehicle_booking_booking1` FOREIGN KEY (`booking_booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehicle_booking_employee1` FOREIGN KEY (`employee_employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehicle_booking_vehicle1` FOREIGN KEY (`vehicle_vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `card_info`
--
ALTER TABLE `card_info`
  ADD CONSTRAINT `my_contacts_contact_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`);

--
-- Constraints for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD CONSTRAINT `fk_payment_type_booking1` FOREIGN KEY (`booking_booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle_inspection`
--
ALTER TABLE `vehicle_inspection`
  ADD CONSTRAINT `fk_vehicle_inspection_vehicle1` FOREIGN KEY (`vehicle_vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
