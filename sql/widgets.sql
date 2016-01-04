-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2016 at 03:59 PM
-- Server version: 5.5.46-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bungeebo_peerreviewdirectory`
--

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `link_id` int(6) NOT NULL DEFAULT '0',
  `wp_domain` varchar(40) DEFAULT NULL,
  `is_parked` tinyint(1) DEFAULT '0',
  `comm_junction` varchar(5) DEFAULT NULL,
  `parent` int(10) DEFAULT '0',
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `time_period` tinyint(1) NOT NULL DEFAULT '8',
  `version` varchar(50) NOT NULL,
  `start_clone_date` int(10) DEFAULT NULL,
  `last_update` int(20) NOT NULL,
  `end_clone_date` datetime NOT NULL,
  `is_recip` tinyint(1) NOT NULL DEFAULT '0',
  `is_niche` tinyint(6) DEFAULT '0',
  `wp_permalink_name` varchar(255) NOT NULL,
  `folder_name` varchar(45) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `bitcoin_wallet` varchar(58) NOT NULL,
  `brand` varchar(3) DEFAULT NULL,
  `display_freebies` varchar(16) DEFAULT NULL,
  `plugin` varchar(12) DEFAULT NULL,
  `custom_title1` varchar(50) DEFAULT NULL,
  `custom_title2` varchar(50) DEFAULT NULL,
  `meta_descrip` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `click_tally` int(10) DEFAULT NULL,
  `donate` varchar(255) DEFAULT NULL,
  `leaving_page` varchar(255) DEFAULT NULL,
  `cust_add_a_link` varchar(255) NOT NULL,
  `cust_add_a_link_mo` varchar(255) NOT NULL,
  `cust_add_a_link_ret` varchar(255) NOT NULL,
  `fontsize` int(2) NOT NULL,
  `titlecolor` varchar(10) NOT NULL,
  `linktextcolor` varchar(10) NOT NULL,
  `catcolor` varchar(10) NOT NULL,
  `new_button_color` varchar(7) DEFAULT NULL,
  `button_font_color` varchar(7) DEFAULT NULL,
  `button_font_size` varchar(10) DEFAULT NULL,
  `modal_message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link_id` (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1500 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
