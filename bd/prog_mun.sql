-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2022 a las 18:51:43
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
-- Estructura de tabla para la tabla `prog_mun`
--

CREATE TABLE `prog_mun` (
  `CODIGO` int(5) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `AGSPC` decimal(15,2) DEFAULT NULL,
  `SOP` decimal(15,2) DEFAULT NULL,
  `OTE` decimal(15,2) DEFAULT NULL,
  `MU` decimal(15,2) DEFAULT NULL,
  `PC` decimal(15,2) DEFAULT NULL,
  `SPEI` decimal(15,2) DEFAULT NULL,
  `PGVPP` decimal(15,2) DEFAULT NULL,
  `CRE` decimal(15,2) DEFAULT NULL,
  `PVP` decimal(15,2) DEFAULT NULL,
  `A` decimal(15,2) DEFAULT NULL,
  `RGTR` decimal(15,2) DEFAULT NULL,
  `RR` decimal(15,2) DEFAULT NULL,
  `GRSU` decimal(15,2) DEFAULT NULL,
  `TR` decimal(15,2) DEFAULT NULL,
  `LV` decimal(15,2) DEFAULT NULL,
  `CSF` decimal(15,2) DEFAULT NULL,
  `AP` decimal(15,2) DEFAULT NULL,
  `PJ` decimal(15,2) DEFAULT NULL,
  `P` decimal(15,2) DEFAULT NULL,
  `SSPS` decimal(15,2) DEFAULT NULL,
  `FE` decimal(15,2) DEFAULT NULL,
  `S` decimal(15,2) DEFAULT NULL,
  `E` decimal(15,2) DEFAULT NULL,
  `C` decimal(15,2) DEFAULT NULL,
  `D` decimal(15,2) DEFAULT NULL,
  `AGP` decimal(15,2) DEFAULT NULL,
  `IE` decimal(15,2) DEFAULT NULL,
  `COM` decimal(15,2) DEFAULT NULL,
  `TP` decimal(15,2) DEFAULT NULL,
  `IT` decimal(15,2) DEFAULT NULL,
  `IDI` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `prog_mun`
--
ALTER TABLE `prog_mun`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`) USING BTREE;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prog_mun`
--
ALTER TABLE `prog_mun`
  ADD CONSTRAINT `prog_mun_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `municipios` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
