-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2016 at 02:09 PM
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
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `BB_user_ID` int(8) DEFAULT NULL,
  `is_bulk` tinyint(1) NOT NULL DEFAULT '0',
  `is_affiliate2bd` int(1) NOT NULL,
  `category` varchar(21) NOT NULL DEFAULT '0',
  `temp` int(1) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `approved` varchar(25) NOT NULL DEFAULT 'false',
  `non_detectable` int(1) NOT NULL DEFAULT '0',
  `is_a_modified` tinyint(1) NOT NULL DEFAULT '0',
  `street` varchar(66) DEFAULT NULL,
  `zip` varchar(66) DEFAULT NULL,
  `phone` varchar(66) DEFAULT NULL,
  `freebie` tinyint(1) DEFAULT NULL,
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` int(20) NOT NULL DEFAULT '0',
  `peer_rating` int(11) DEFAULT '0',
  `peer_vote_count` int(11) NOT NULL DEFAULT '0',
  `public_rating` int(11) DEFAULT '0',
  `public_vote_count` int(11) NOT NULL DEFAULT '0',
  `price_slot_amnt` decimal(16,8) NOT NULL DEFAULT '0.00000000',
  `ps_seniority_date` int(10) NOT NULL DEFAULT '0',
  `nofollow` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `category` (`category`),
  KEY `approved` (`approved`),
  KEY `price_slot_amnt` (`price_slot_amnt`,`ps_seniority_date`),
  KEY `freebie` (`freebie`),
  KEY `BB_user_ID` (`BB_user_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7585 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
