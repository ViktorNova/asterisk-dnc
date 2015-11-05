-- phpMyAdmin SQL Dump
-- version 2.6.3-pl1
-- http://www.phpmyadmin.net
-- 
-- Server version: 3.23.58
-- PHP Version: 4.3.2
-- 
-- (c) Ward Mundy, 2005. All rights reserved.
-- 
-- 
-- Database: `asteridex`
-- 
CREATE DATABASE `asteridex`;
USE asteridex;

-- --------------------------------------------------------

-- 
-- Table structure for table `user1`
-- 

CREATE TABLE `user1` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(40) NOT NULL default '',
  `in` varchar(40) NOT NULL default '*',
  `out` varchar(40) NOT NULL default '',
  `dialcode` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`,`in`,`out`)
) TYPE=MyISAM AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `user1`
-- 

INSERT INTO `user1` VALUES (1, 'American Airlines', '*', '8004337300', '');
INSERT INTO `user1` VALUES (2, 'AirTran Airways', '*', '8002478726', '');
INSERT INTO `user1` VALUES (3, 'British Airways', '*', '8002479297', '');
INSERT INTO `user1` VALUES (4, 'Continental Airlines', '*', '8005250280', '');
INSERT INTO `user1` VALUES (5, 'Delta Air Lines', '*', '8002211212', '');
INSERT INTO `user1` VALUES (6, 'Emery Worldwide', '*', '8003673592', '');
INSERT INTO `user1` VALUES (7, 'Frontier Airlines', '*', '8004321359', '');
INSERT INTO `user1` VALUES (8, 'Gulf Air', '*', '8883594853', '');
INSERT INTO `user1` VALUES (9, 'Hooters Air', '*', '8883594668', '');
INSERT INTO `user1` VALUES (10, 'Iberia Air Lines', '*', '8007724642', '');
INSERT INTO `user1` VALUES (11, 'JetBlue Airways', '*', '8005382583', '');
INSERT INTO `user1` VALUES (12, 'KLM Air', '*', '8003747747', '');
INSERT INTO `user1` VALUES (13, 'Lufthansa Air', '*', '8006453880', '');
INSERT INTO `user1` VALUES (14, 'Midway Airlines', '*', '8004464392', '');
INSERT INTO `user1` VALUES (15, 'Northwest Airlines', '*', '8002252525', '');
INSERT INTO `user1` VALUES (16, 'Olympic Airways', '*', '8002231226', '');
INSERT INTO `user1` VALUES (17, 'Pan AM', '*', '8003597262', '');
INSERT INTO `user1` VALUES (18, 'Qantas Airways', '*', '8002274500', '');
INSERT INTO `user1` VALUES (19, 'Ryan Air', '*', '8007270457', '');
INSERT INTO `user1` VALUES (20, 'Southwest Airlines', '*', '8004359792', '');
INSERT INTO `user1` VALUES (21, 'Ted Airlines', '*', '8002255833', '');
INSERT INTO `user1` VALUES (22, 'United Airlines', '*', '8002416522', '');
INSERT INTO `user1` VALUES (23, 'US Airways', '*', '8004284322', '');
INSERT INTO `user1` VALUES (24, 'Virgin Atlantic Air', '*', '8008628621', '');
INSERT INTO `user1` VALUES (25, 'WestJet Airlines', '*', '8005385696', '');
INSERT INTO `user1` VALUES (26, 'Yemen Airlines', '*', '8009368300', '');
INSERT INTO `user1` VALUES (27, 'Zoo Atlanta', '*', '4046245600', '');
