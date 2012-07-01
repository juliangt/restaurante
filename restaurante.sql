-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2012 at 07:52 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurante`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0def4ba60fe2514f0e66298e845feb79', '0.0.0.0', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11', 1341175358, 'a:3:{s:9:"user_data";s:0:"";s:11:"user_online";b:1;s:4:"user";O:8:"stdClass":4:{s:2:"id";s:1:"1";s:4:"Mail";s:15:"julian@mail.com";s:10:"UbicacionX";s:11:"-34.5387198";s:10:"UbicacionY";s:11:"-58.7057159";}}'),
('8ae7d15f90098f64eeef4e3b907a38a0', '0.0.0.0', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11', 1341181510, 'a:3:{s:9:"user_data";s:0:"";s:11:"user_online";b:1;s:4:"user";O:8:"stdClass":4:{s:2:"id";s:1:"1";s:4:"Mail";s:15:"julian@mail.com";s:10:"UbicacionX";s:11:"-34.5386443";s:10:"UbicacionY";s:9:"-58.70588";}}'),
('ee3b11a7f595f36c5900f6b2ef641c35', '0.0.0.0', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11', 1341178471, 'a:3:{s:9:"user_data";s:0:"";s:11:"user_online";b:1;s:4:"user";O:8:"stdClass":4:{s:2:"id";s:1:"1";s:4:"Mail";s:15:"julian@mail.com";s:10:"UbicacionX";s:11:"-34.5388533";s:10:"UbicacionY";s:11:"-58.7060092";}}'),
('f14de60fb6675a8541f87f5d432d069e', '0.0.0.0', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11', 1341181510, 'a:3:{s:9:"user_data";s:0:"";s:11:"user_online";b:1;s:4:"user";O:8:"stdClass":4:{s:2:"id";s:1:"1";s:4:"Mail";s:15:"julian@mail.com";s:10:"UbicacionX";s:10:"-34.538798";s:10:"UbicacionY";s:11:"-58.7058167";}}');

-- --------------------------------------------------------

--
-- Table structure for table `Comensal`
--

CREATE TABLE IF NOT EXISTS `Comensal` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `Mail` varchar(50) NOT NULL,
  `UbicacionX` double NOT NULL,
  `UbicacionY` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Comensal`
--

INSERT INTO `Comensal` (`id`, `Mail`, `UbicacionX`, `UbicacionY`) VALUES
(1, 'julian@mail.com', -34.5386443, -58.70588),
(2, 'pablo@mail.com', 0, 0),
(3, 'celu@mail.com', -34.5387322, -58.7058367);

-- --------------------------------------------------------

--
-- Table structure for table `FamiliasDeCocina`
--

CREATE TABLE IF NOT EXISTS `FamiliasDeCocina` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `FamiliasDeCocina`
--

INSERT INTO `FamiliasDeCocina` (`id`, `nombre`) VALUES
(1, 'Pastas'),
(2, 'Parrilla'),
(3, 'Panqueques'),
(4, 'Pizza'),
(5, 'Empanadas'),
(6, 'Italiana'),
(7, 'Mexicana');

-- --------------------------------------------------------

--
-- Table structure for table `HistorialConsumos`
--

CREATE TABLE IF NOT EXISTS `HistorialConsumos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idComensal` int(5) NOT NULL,
  `idRestaurante` int(5) NOT NULL,
  `idPlato` int(5) NOT NULL,
  `puntajeRestaurante` tinyint(2) NOT NULL,
  `puntajePlato` tinyint(2) NOT NULL,
  `feedback` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `HistorialConsumos`
--

INSERT INTO `HistorialConsumos` (`id`, `idComensal`, `idRestaurante`, `idPlato`, `puntajeRestaurante`, `puntajePlato`, `feedback`) VALUES
(1, 1, 2, 6, 5, 10, 1),
(2, 1, 2, 5, 10, 10, 1),
(6, 1, 4, 5, 10, 0, 1),
(7, 1, 4, 7, 7, 2, 1),
(8, 1, 2, 4, 5, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `HistorialSugerencias`
--

CREATE TABLE IF NOT EXISTS `HistorialSugerencias` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idComensal` int(5) NOT NULL,
  `idRestaurante` int(5) NOT NULL,
  `idPlato` int(5) NOT NULL,
  `acepto` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idComensal` (`idComensal`,`idRestaurante`,`idPlato`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `HistorialSugerencias`
--

INSERT INTO `HistorialSugerencias` (`id`, `idComensal`, `idRestaurante`, `idPlato`, `acepto`) VALUES
(1, 1, 2, 6, 0),
(2, 1, 2, 6, 0),
(3, 1, 2, 7, 0),
(4, 1, 2, 8, 0),
(5, 1, 2, 9, 0),
(6, 1, 2, 7, 0),
(7, 1, 2, 8, 0),
(8, 1, 2, 9, 0),
(9, 1, 2, 13, 0),
(10, 1, 2, 14, 0),
(11, 1, 2, 15, 0),
(12, 1, 2, 5, 0),
(13, 1, 2, 12, 0),
(14, 1, 2, 1, 0),
(15, 1, 2, 2, 0),
(16, 1, 2, 3, 0),
(17, 1, 2, 4, 0),
(18, 1, 2, 5, 0),
(19, 1, 2, 6, 0),
(20, 1, 2, 10, 0),
(21, 1, 2, 11, 0),
(22, 1, 2, 6, 1),
(23, 1, 4, 6, 0),
(24, 1, 4, 7, 0),
(25, 1, 4, 8, 0),
(26, 1, 4, 9, 0),
(27, 1, 4, 7, 0),
(28, 1, 4, 8, 0),
(29, 1, 4, 9, 0),
(30, 1, 2, 4, 0),
(31, 1, 4, 5, 0),
(32, 1, 4, 6, 0),
(33, 1, 3, 13, 0),
(34, 1, 2, 3, 0),
(35, 1, 3, 14, 0),
(36, 1, 3, 15, 0),
(37, 1, 4, 5, 0),
(38, 1, 1, 12, 0),
(39, 1, 2, 1, 0),
(40, 1, 2, 2, 0),
(41, 1, 1, 10, 0),
(42, 1, 1, 11, 0),
(43, 1, 4, 9, 0),
(44, 1, 4, 7, 0),
(45, 1, 4, 8, 0),
(46, 1, 4, 5, 0),
(47, 1, 4, 6, 0),
(48, 1, 2, 3, 0),
(49, 1, 4, 9, 0),
(50, 1, 2, 7, 0),
(51, 1, 4, 6, 0),
(52, 1, 2, 1, 0),
(53, 1, 2, 2, 0),
(54, 1, 4, 5, 0),
(55, 1, 1, 10, 0),
(56, 1, 4, 6, 0),
(57, 1, 2, 7, 0),
(58, 1, 2, 8, 0),
(59, 1, 2, 9, 0),
(60, 1, 1, 12, 0),
(61, 1, 3, 13, 0),
(62, 1, 3, 14, 0),
(63, 1, 3, 15, 0),
(64, 1, 1, 10, 0),
(65, 1, 4, 9, 0),
(66, 1, 4, 7, 0),
(67, 1, 4, 8, 0),
(68, 1, 2, 5, 1),
(69, 1, 2, 3, 0),
(70, 1, 2, 4, 1),
(71, 1, 2, 4, 0),
(72, 1, 2, 1, 1),
(73, 1, 2, 1, 0),
(74, 1, 2, 5, 1),
(75, 1, 2, 4, 0),
(76, 1, 2, 1, 0),
(77, 1, 2, 5, 0),
(78, 1, 4, 5, 1),
(79, 1, 2, 5, 0),
(80, 1, 2, 6, 0),
(81, 1, 2, 9, 0),
(82, 1, 2, 7, 0),
(83, 1, 4, 7, 1),
(84, 1, 2, 5, 0),
(85, 1, 2, 4, 1),
(86, 1, 2, 5, 0),
(87, 1, 2, 4, 0),
(88, 1, 2, 1, 0),
(89, 1, 4, 7, 0),
(90, 1, 4, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Ingrediente`
--

CREATE TABLE IF NOT EXISTS `Ingrediente` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `Ingrediente`
--

INSERT INTO `Ingrediente` (`id`, `nombre`) VALUES
(1, 'Harina'),
(2, 'Aceite'),
(3, 'Sal'),
(4, 'Pimienta'),
(5, 'Pimenton'),
(6, 'Ajo'),
(7, 'Tomate'),
(8, 'Papa'),
(9, 'Batata'),
(10, 'Carne de Res'),
(11, 'Carne de pescado'),
(12, 'Carne de cerdo'),
(13, 'Rucula'),
(14, 'Agua'),
(15, 'Manteca'),
(16, 'Albaca'),
(17, 'Nuez'),
(18, 'Leche'),
(19, 'Azucar'),
(20, 'Queso cremoso'),
(21, 'Queso Muzzarella'),
(22, 'Ricota'),
(23, 'Acelga');

-- --------------------------------------------------------

--
-- Table structure for table `IngredientePlato`
--

CREATE TABLE IF NOT EXISTS `IngredientePlato` (
  `idIngrediente` int(5) NOT NULL,
  `idPlato` int(5) NOT NULL,
  KEY `idIngrediente` (`idIngrediente`,`idPlato`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `IngredientePlato`
--

INSERT INTO `IngredientePlato` (`idIngrediente`, `idPlato`) VALUES
(1, 1),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(4, 3),
(4, 8),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(5, 3),
(5, 7),
(5, 8),
(6, 3),
(6, 4),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(7, 3),
(7, 13),
(7, 14),
(7, 15),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(10, 9),
(12, 7),
(12, 8),
(12, 15),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 10),
(15, 11),
(15, 12),
(16, 4),
(17, 4),
(18, 11),
(19, 11),
(21, 13),
(21, 14),
(21, 15),
(22, 10),
(22, 12),
(23, 12);

-- --------------------------------------------------------

--
-- Table structure for table `IngredienteRestriccion`
--

CREATE TABLE IF NOT EXISTS `IngredienteRestriccion` (
  `idIngrediente` int(5) NOT NULL,
  `idRestriccion` int(5) NOT NULL,
  KEY `idIngrediente` (`idIngrediente`,`idRestriccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `IngredienteRestriccion`
--

INSERT INTO `IngredienteRestriccion` (`idIngrediente`, `idRestriccion`) VALUES
(1, 2),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PlatoDeComida`
--

CREATE TABLE IF NOT EXISTS `PlatoDeComida` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `idFamilia` int(5) NOT NULL,
  `puntaje` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFamilia` (`idFamilia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `PlatoDeComida`
--

INSERT INTO `PlatoDeComida` (`id`, `nombre`, `idFamilia`, `puntaje`) VALUES
(1, 'Gnochis', 1, 102),
(2, 'Ravioles a la manteca', 1, 100),
(3, 'Ravioles a la pomarola', 1, 99),
(4, 'Tallarines al pesto', 1, 116),
(5, 'Bife de chorizo', 2, 121),
(6, 'Chichulines', 2, 114),
(7, 'Morcilla', 2, 104),
(8, 'Chorizo', 2, 99),
(9, 'Asado', 2, 98),
(10, 'Panqueques de ricota', 3, 100),
(11, 'Panqueques de dulce de leche', 3, 100),
(12, 'Panqueque de ricota y verdura', 3, 100),
(13, 'Pizza de muzzarella', 4, 100),
(14, 'Pizza napolitana', 4, 100),
(15, 'Pizza calabresa', 4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `PlatosRecomendacion`
--

CREATE TABLE IF NOT EXISTS `PlatosRecomendacion` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idRecomendacion` int(5) NOT NULL,
  `idRestaurante` int(5) NOT NULL,
  `idPlato` int(5) NOT NULL,
  `puntaje` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRecomendacion` (`idRecomendacion`,`idRestaurante`,`idPlato`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Recomendacion`
--

CREATE TABLE IF NOT EXISTS `Recomendacion` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idComensal` int(5) NOT NULL,
  `idRestriccion` int(5) NOT NULL,
  `idFamilia` int(5) NOT NULL,
  `radio` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idComensal` (`idComensal`,`idRestriccion`,`idFamilia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Restaurante`
--

CREATE TABLE IF NOT EXISTS `Restaurante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `habilitado` int(11) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `coordenadaX` double NOT NULL,
  `coordenadaY` double NOT NULL,
  `puntaje` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Restaurante`
--

INSERT INTO `Restaurante` (`id`, `nombre`, `habilitado`, `domicilio`, `localidad`, `provincia`, `coordenadaX`, `coordenadaY`, `puntaje`) VALUES
(1, 'Carlitos', 1, 'Paunero 1400', 'San Miguel', 'Buenos Aires', -34.542921, -58.709092, 100),
(2, 'Parrilla el 22', 1, 'San Jose 10', 'San Miguel', 'Buenos Aires', -34.538962, -58.693278, 135),
(3, 'Pizza Paco', 1, 'Entre Rios 600', 'Bella Vista', 'Buenos Aires', -34.560541, -58.695359, 100),
(4, 'La posta', 1, 'Av. Juan Domingo Peron 850', 'San Miguel', 'Buenos Aires', -34.548029, -58.703942, 131);

-- --------------------------------------------------------

--
-- Table structure for table `RestauranteFamilia`
--

CREATE TABLE IF NOT EXISTS `RestauranteFamilia` (
  `idRestaurante` int(5) NOT NULL,
  `idFamilia` int(5) NOT NULL,
  KEY `idRestaurante` (`idRestaurante`,`idFamilia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RestauranteFamilia`
--

INSERT INTO `RestauranteFamilia` (`idRestaurante`, `idFamilia`) VALUES
(1, 3),
(2, 1),
(2, 2),
(3, 3),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `RestaurantePlato`
--

CREATE TABLE IF NOT EXISTS `RestaurantePlato` (
  `idRestaurante` int(5) NOT NULL,
  `idPlato` int(5) NOT NULL,
  KEY `idRestaurante` (`idRestaurante`,`idPlato`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RestaurantePlato`
--

INSERT INTO `RestaurantePlato` (`idRestaurante`, `idPlato`) VALUES
(1, 10),
(1, 11),
(1, 12),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 13),
(3, 14),
(3, 15),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `RestaurantesRecomendacion`
--

CREATE TABLE IF NOT EXISTS `RestaurantesRecomendacion` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idRecomendacion` int(5) NOT NULL,
  `idRestaurante` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Restriccion`
--

CREATE TABLE IF NOT EXISTS `Restriccion` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Restriccion`
--

INSERT INTO `Restriccion` (`id`, `nombre`) VALUES
(1, 'Comidas picantes'),
(2, 'Enfermedad Celiaco');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
