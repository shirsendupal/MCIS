/*
SQLyog - Free MySQL GUI v5.01
Host - 5.5.5-10.1.10-MariaDB : Database - mcis
*********************************************************************
Server version : 5.5.5-10.1.10-MariaDB
*/


create database if not exists `mcis`;

USE `mcis`;

/*Table structure for table `manufacturer` */

DROP TABLE IF EXISTS `manufacturer`;

CREATE TABLE `manufacturer` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `manufacturer_name_unique` (`manufacturer_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*Table structure for table `models` */

DROP TABLE IF EXISTS `models`;

CREATE TABLE `models` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `manufacturer_fid` bigint(20) NOT NULL,
  `model_name` varchar(250) NOT NULL,
  `model_color` varchar(50) DEFAULT NULL,
  `manufacturing_year` year(4) DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `note` varchar(250) DEFAULT NULL,
  `image1` varchar(250) DEFAULT NULL,
  `image2` varchar(250) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
