-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-04-2014 a las 19:29:09
-- Versión del servidor: 5.0.95-community-cll
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bladnet_kgt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dist_app_support`
--

CREATE TABLE IF NOT EXISTS `tbl_dist_app_support` (
  `int_id` bigint(20) unsigned NOT NULL auto_increment,
  `int_errors` tinyint(4) NOT NULL,
  `int_sents` tinyint(4) NOT NULL,
  `int_block` tinyint(4) NOT NULL,
  `dte_block` datetime default NULL,
  `str_code` varchar(32) NOT NULL,
  `str_email` varchar(128) NOT NULL,
  `str_applicant` varchar(64) NOT NULL,
  `str_country` varchar(64) NOT NULL,
  `str_ip_address` varchar(48) NOT NULL,
  `str_telephone` varchar(16) NOT NULL,
  PRIMARY KEY  (`int_id`),
  UNIQUE KEY `str_email` (`str_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=334 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
