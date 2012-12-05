-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2012 a las 05:13:26
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `onlinestore`
--
CREATE DATABASE `onlinestore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `onlinestore`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Clasifica cada uno de los articulos que existen en la tienda' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `descripcion`) VALUES
(1, 'ACCESORIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `iddato_usuario` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL COMMENT 'Almacena la fecha y hora en que se registro la compra',
  PRIMARY KEY (`idcompra`),
  KEY `fk_producto` (`idproducto`),
  KEY `fk_usuario` (`iddato_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Almacena las compras que ha realizado el cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dato_usuario`
--

CREATE TABLE IF NOT EXISTS `dato_usuario` (
  `iddato_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` char(10) NOT NULL,
  `email` varchar(75) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  PRIMARY KEY (`iddato_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Registra la marca que pertenece cada producto vendido en la ' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `descripcion`) VALUES
(1, 'MARKVISION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(25) NOT NULL COMMENT 'Titulo corto mostrado en la pagina web',
  `descripcion` text NOT NULL COMMENT 'Guarda las caracteristicas del producto',
  `existencias` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `url_image` text COMMENT 'Guarda la direccion donde se aloja la imagen del producto',
  `idmarca` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `fk_marca` (`idmarca`),
  KEY `fk_categoria` (`idcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `titulo`, `descripcion`, `existencias`, `costo`, `url_image`, `idmarca`, `idcategoria`) VALUES
(3, 'PRUEBA DE RAM', 'CARACTERISTICAS DE RAM:2 GB DDR3', 10, '25.50', 'images/1/adaptadorsata(05-12-2012_05-09-32-am).jpg', 1, 1),
(4, 'PRUEBA DOS', 'ESTA ES UNA <BR />PRUEBA', 21, '25.23', 'images/1/fuenteatx(05-12-2012_02-12-25-am).jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `user` varchar(25) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '0=Administrador; 1=Cliente',
  `estado` int(11) NOT NULL COMMENT '0=Inactivo; 1=Activo',
  `iddato_usuario` int(11) NOT NULL,
  PRIMARY KEY (`iddato_usuario`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  KEY `fk_dato_usuario` (`iddato_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`iddato_usuario`) REFERENCES `usuario` (`iddato_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_dato_usuario` FOREIGN KEY (`iddato_usuario`) REFERENCES `dato_usuario` (`iddato_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
