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
-- 

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
);
-- TYPE=MyISAM AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `user1`
-- 
