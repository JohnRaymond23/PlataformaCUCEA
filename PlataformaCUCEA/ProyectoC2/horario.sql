-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-05-2023 a las 02:02:46
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `horario`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_consultaHorarioCurso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultaHorarioCurso` (IN `_dia` INT(100), IN `_hora` INT(100))  BEGIN
	SELECT 
		h.idhorariocurso,
		c.nombre
	FROM horario_curso AS h
	INNER JOIN curso AS c ON h.idcurso=c.idcurso
	WHERE h.idhora = _hora AND h.dia = _dia;
    END$$

DROP PROCEDURE IF EXISTS `sp_mantenimientoHorario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mantenimientoHorario` (IN `_flag` INT(100), IN `_idhorario` VARCHAR(100), IN `_idhora` VARCHAR(100), IN `_idcurso` VARCHAR(100), IN `_dia` VARCHAR(100))  BEGIN
	if _flag = 1 then
		INSERT INTO horario_curso (
			idhora,
			idcurso,
			dia
		)VALUES(
			_idhora,
			_idcurso,
			_dia
		) ;
		
		SET @idregistro  = LAST_INSERT_ID();
		
		select 'Se guardó correctamente' as msj, 'info' as icon,@idregistro  as horario; 
	end if;
	if _flag = 2 then
		delete from horario_curso where idhorariocurso = _idhorario;
		
		select 'Se eliminó correctamente' as msj, 'info' as icon; 
	end if;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `nombre`, `descripcion`) VALUES
(1, 'Seguridad en TI', 'NRC: 101503\r\nProfesor: Luis Alberto Catalan\r\nLunes y Miercoles - 7 a 9h - N-102'),
(2, 'Fundamentos de redes', 'NRC: 69401	\r\nProfesor: Jorge Luis Huizar\r\nLunes y Miercoles - 11 a 13h - L-208'),
(3, 'Software especializado', 'NRC: 82387	\r\nProfesor: Ann Ivonne Gomez\r\nViernes - 7 a 11h - L-103'),
(4, 'Estructura de datos', 'NRC: 43113	\r\nProfesor: Irma Rebeca Andalon\r\nMartes y Jueves - 11 a 13h - L-303'),
(5, 'Programacion web', 'NRC: 111212		\r\nProfesor: Victor Manuel Larios\r\nMartes y Jueves - 9 a 11h - L-303'),
(6, 'Plataformas operativas', 'NRC: 43105			\r\nProfesor: Hebert Osvaldo \r\nLunes y Miercoles - 7 a 9h - L-301'),
(7, 'Inteligencia de negocios', 'NRC: 199886				\r\nProfesor: Roberto Mendoza Sanchez \r\nMartes y Jueves - 14 a 16h - L-202'),
(8, 'Auditoria de sistemas', 'NRC: 101500			\r\nProfesor: Luis Alberto Catalan \r\nMartes y Jueves - 7 a 9h - I-203'),
(9, 'Matematicas discretas', 'NRC: 42920			\r\nProfesor: Enrique Ochoa Bonilla\r\nMartes y Jueves - 11 a 13h - B-302'),
(10, 'Estadistica I', 'NRC: 42933			\r\nProfesor: Angel Ernesto Jimenez\r\nMartes y Jueves - 11 a 13h - F-208');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

DROP TABLE IF EXISTS `hora`;
CREATE TABLE IF NOT EXISTS `hora` (
  `idhora` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` time NOT NULL,
  `fin` time NOT NULL,
  PRIMARY KEY (`idhora`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `hora`
--

INSERT INTO `hora` (`idhora`, `inicio`, `fin`) VALUES
(1, '07:00:00', '09:00:00'),
(2, '09:00:00', '11:00:00'),
(3, '11:00:00', '13:00:00'),
(4, '14:00:00', '16:00:00'),
(5, '16:00:00', '18:00:00'),
(6, '18:00:00', '20:00:00'),
(7, '20:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_curso`
--

DROP TABLE IF EXISTS `horario_curso`;
CREATE TABLE IF NOT EXISTS `horario_curso` (
  `idhorariocurso` int(11) NOT NULL AUTO_INCREMENT,
  `idhora` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  PRIMARY KEY (`idhorariocurso`),
  KEY `dia` (`dia`),
  KEY `idhora` (`idhora`),
  KEY `idcurso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario_curso`
--
ALTER TABLE `horario_curso`
  ADD CONSTRAINT `horario_curso_ibfk_1` FOREIGN KEY (`idhora`) REFERENCES `hora` (`idhora`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `horario_curso_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
