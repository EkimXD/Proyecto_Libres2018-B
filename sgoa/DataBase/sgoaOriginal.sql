-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-03-2018 a las 02:36:49
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `goa_v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(500) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `id_objeto_aprendizaje` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `fk_comentario_usuario1_idx` (`idusuario`),
  KEY `fk_comentario_objeto_aprendizaje1_idx` (`id_objeto_aprendizaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `iddepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `departamento`) VALUES
(1, 'Física (DF)'),
(2, 'Matemática (DM)'),
(3, 'Ciencias Administrativas (DEPCA)'),
(4, 'Estudios Organizacionales Desarrollo Humano ('),
(5, 'Ingeniería Civil y Ambiental (DICA)'),
(6, 'Automatización y Control Industrial (DACI)'),
(7, 'Energía Eléctrica (DEE)'),
(8, 'Electrónica, Telecomunicaciones y Redes de In'),
(9, 'Geología (DG)\r\n'),
(10, 'Petróleos (DP)'),
(11, 'Ingeniería Mecánica (DIM)'),
(12, 'Materiales (DMT)'),
(13, 'Ingeniería Química (DIQ)'),
(14, 'Ciencias de Alimentos y Biotecnología (DECAB)'),
(15, 'Ciencias Nucleares (DCN)'),
(16, 'Metalurgia Extractiva (DEMEX)'),
(17, ' Informática y Ciencias de la Computación (DI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
CREATE TABLE IF NOT EXISTS `estudiante` (
  `idestudiante` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(45) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `carrera` varchar(45) DEFAULT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idestudiante`),
  KEY `fk_estudiante_usuario1_idx` (`id_usuario`),
  KEY `fk_estudiante_facultad1_idx` (`id_facultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

DROP TABLE IF EXISTS `facultad`;
CREATE TABLE IF NOT EXISTS `facultad` (
  `idfacultad` int(11) NOT NULL AUTO_INCREMENT,
  `facultad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idfacultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`idfacultad`, `facultad`) VALUES
(1, 'Ciencias'),
(2, 'Ingeniería en Ciencias Administrativas'),
(3, 'Ingeniería Civil & Ambiental'),
(4, 'Ingeniería Eléctrica y Electrónica'),
(5, 'Ingeniería en Geología y Petróleos'),
(6, 'Ingeniería Mecanica'),
(7, 'Ingeniería Química y Agroindustrial'),
(8, 'Ingeniería en Sistemas'),
(9, 'ESFOT'),
(10, 'Formación Básica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto_aprendizaje`
--

DROP TABLE IF EXISTS `objeto_aprendizaje`;
CREATE TABLE IF NOT EXISTS `objeto_aprendizaje` (
  `idobjeto_aprendizaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `institucion` varchar(45) DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `palabras_clave` varchar(500) DEFAULT NULL,
  `tamanio` varchar(45) DEFAULT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idobjeto_aprendizaje`),
  KEY `fk_objeto_aprendizaje_usuario1_idx` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `idprofesor` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(10) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idprofesor`),
  KEY `fk_profesor_usuario_idx` (`id_usuario`),
  KEY `fk_profesor_departamento1_idx` (`id_departamento`),
  KEY `fk_profesor_facultad1_idx` (`id_facultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) DEFAULT NULL,
  `contrasenia` varchar(45) DEFAULT NULL,
  `tipo_usuario` varchar(3) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `contrasenia`, `tipo_usuario`, `activo`) VALUES
(1, 'admin', 'admin', 'ADM', 'V');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_objeto_aprendizaje1` FOREIGN KEY (`id_objeto_aprendizaje`) REFERENCES `objeto_aprendizaje` (`idobjeto_aprendizaje`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_facultad1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`idfacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `objeto_aprendizaje`
--
ALTER TABLE `objeto_aprendizaje`
  ADD CONSTRAINT `fk_objeto_aprendizaje_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_profesor_departamento1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`iddepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profesor_facultad1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`idfacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profesor_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
