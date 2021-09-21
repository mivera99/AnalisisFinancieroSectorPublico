-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2021 a las 21:06:42
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbs_01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_general_ccaa`
--

CREATE TABLE `bloque_general_ccaa` (
  `CODIGO_CCAA` int(10) NOT NULL,
  `NOMBRE_CCAA` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `POBLACION_2017` int(10) NOT NULL,
  `NOMBREPRESIDENTE` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bloque_general_ccaa`
--

INSERT INTO `bloque_general_ccaa` (`CODIGO_CCAA`, `NOMBRE_CCAA`, `POBLACION_2017`, `NOMBREPRESIDENTE`) VALUES
(1, 'Andalucía', 8379820, 'Juan Manuel\n'),
(2, 'Aragón', 1308750, 'Francisco Javier\n'),
(3, 'Asturias, Principado', 1034960, 'Adrian\n'),
(4, 'Balears, Illes', 1115999, 'Francesca Lluc\n'),
(5, 'Canarias', 2108121, 'Angel Victor\n'),
(6, 'Cantabria', 580295, 'Miguel Ángel\n'),
(7, 'Castilla y León', 2425801, 'Alfonso\n'),
(8, 'Castilla - La Mancha', 2031479, 'Emiliano\n'),
(9, 'Cataluña', 7555830, 'Pere'),
(11, 'Extremadura', 1079920, 'Guillermo\n'),
(12, 'Galicia', 2708339, 'Alberto\n'),
(13, 'Madrid, Comunidad de', 6507184, 'Isabel '),
(14, 'Murcia, Región de', 1470273, 'Fernando\n'),
(15, 'Navarra, Comunidad F', 643234, 'Maria'),
(16, 'País Vasco', 2194158, 'Íñigo\n'),
(17, 'Rioja, La', 315381, 'Concepción\n'),
(20, 'NACIONAL', 46572132, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloque_general_ccaa`
--
ALTER TABLE `bloque_general_ccaa`
  ADD PRIMARY KEY (`CODIGO_CCAA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
