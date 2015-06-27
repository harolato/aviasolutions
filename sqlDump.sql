-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 m. Bir 27 d. 17:02
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `address` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `phone_no` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Sukurta duomenų kopija lentelei `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `email`, `phone_no`) VALUES
(2, 'maXima Ltd.', '24 Pajurio gatve, Vilnius, Lietuva', 'max@ima.lt', '+37068942156'),
(3, 'Volvo Ltd.', '512 Kokianors gatve, Klaipeda, Lietuva', 'volvo@v.lt', '+5213513242'),
(4, 'Lame Corp. Ltd.', '4 Summer Road, London, United Kingdom', 'super@lame.co.uk', '+4412354646');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company_id` int(10) NOT NULL,
  `employment_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Sukurta duomenų kopija lentelei `employees`
--

INSERT INTO `employees` (`id`, `name`, `surname`, `email`, `company_id`, `employment_date`) VALUES
(2, 'Vardas', 'Pavarde', 'vards@pavarde.one.lt', 2, '2013-04-01'),
(3, 'Tomas', 'Pavardenas', 'tomuxs@pavardens.com', 2, '2012-05-02'),
(4, 'John', 'Guy', 'John@guy.com', 4, '2010-11-16'),
(5, 'Lewis', 'Mcmcinson', 'mc@d.com', 4, '2011-09-03'),
(6, 'Oliver', 'Dude', 'dude@dot.com', 4, '2014-05-05');

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_companies_employees` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
