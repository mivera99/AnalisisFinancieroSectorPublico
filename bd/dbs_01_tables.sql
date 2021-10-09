-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2021 a las 15:18:06
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
  `NOMBREPRESIDENTE` varchar(35) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO1PRESIDENTE` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO2PRESIDENTE` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `VIGENCIA` date DEFAULT NULL,
  `PARTIDO` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CIF` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TIPOVIA` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NOMBREVIA` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NUMVIA` varchar(5) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CODPOSTAL` int(15) DEFAULT NULL,
  `TELEFONO` int(10) DEFAULT NULL,
  `FAX` int(10) DEFAULT NULL,
  `WEB` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `MAIL` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `REFPIB` int(4) NOT NULL,
  `PIB` int(15) NOT NULL,
  `REFPIBC` int(4) NOT NULL,
  `PIBC` int(2) NOT NULL,
  `REFRESULTADO` int(4) NOT NULL,
  `RESULTADO` int(8) NOT NULL,
  `REFDEUDAVIVA` int(6) NOT NULL,
  `DEUDAVIVA` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_general_dip`
--

CREATE TABLE `bloque_general_dip` (
  `CODIGO_DIP` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `DIPUTACION` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `CIF` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TIPOVIA` varchar(6) COLLATE utf8mb4_spanish_ci NOT NULL,
  `NOMBREVIA` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `NUMVIA` varchar(5) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CODPOSTAL` int(5) NOT NULL,
  `PROVINCIA` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `AUTONOMIA` varchar(35) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TELEFONO` int(9) DEFAULT NULL,
  `FAX` int(9) DEFAULT NULL,
  `WEB` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `MAIL` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `INGRESOS_2020` decimal(15,2) DEFAULT NULL,
  `INGRESOS_2019` decimal(15,2) NOT NULL,
  `FONDLIQUIDOS_2020` decimal(15,2) DEFAULT NULL,
  `FONDLIQUIDOS_2019` decimal(15,2) NOT NULL,
  `DERPENDCOBRO_2020` decimal(15,2) DEFAULT NULL,
  `DERPENDCOBRO_2019` decimal(15,2) NOT NULL,
  `DEUDACOM_2020` decimal(15,2) DEFAULT NULL,
  `DEUDACOM_2019` decimal(15,2) NOT NULL,
  `DEUDAFIN_2020` decimal(15,2) DEFAULT NULL,
  `DEUDAFIN_2019` decimal(15,2) NOT NULL,
  `LIQUAJUST_2020` decimal(15,2) DEFAULT NULL,
  `LIQUAJUST_2019` decimal(15,2) NOT NULL,
  `INGRESOSCORR_2020` decimal(15,2) DEFAULT NULL,
  `INGRESOSCORR_2019` decimal(15,2) NOT NULL,
  `GASTOCORR_2020` decimal(15,2) DEFAULT NULL,
  `GASTOCORR_2019` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_general_mun`
--

CREATE TABLE `bloque_general_mun` (
  `CODIGO_MUN` int(5) NOT NULL,
  `CIF_MUNICIPIO` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `MUNICIPIO` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `CODIGO_PROV` int(2) NOT NULL,
  `PROVINCIA` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `AUTONOMIA` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `POBLACION_2020` int(10) NOT NULL,
  `NOMBREALCALDE` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO1ALCALDE` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `APELLIDO2ALCALDE` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `VIGENCIA` date DEFAULT NULL,
  `PARTIDO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TIPOVIA` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NOMBREVIA` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NUMVIA` varchar(5) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CODPOSTAL` int(5) DEFAULT NULL,
  `TELEFONO` int(10) DEFAULT NULL,
  `FAX` int(10) DEFAULT NULL,
  `WEB` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `MAIL` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `PARO_2021` int(10) DEFAULT NULL,
  `TRANSAC_INMOBILIARIAS_2021` int(10) DEFAULT NULL,
  `TRANSAC_INMOBILIARIAS_2020` int(10) DEFAULT NULL,
  `INGRESOS_2020` decimal(16,4) DEFAULT NULL,
  `INGRESOS_2019` decimal(16,4) DEFAULT NULL,
  `FONDLIQUIDOS_2020` decimal(16,4) DEFAULT NULL,
  `FONDLIQUIDOS_2019` decimal(16,4) DEFAULT NULL,
  `DERPENDCOBRO_2020` decimal(16,4) DEFAULT NULL,
  `DERPENDCOBRO_2019` decimal(16,4) DEFAULT NULL,
  `DEUDACOM_2020` decimal(16,4) DEFAULT NULL,
  `DEUDACOM_2019` decimal(16,4) DEFAULT NULL,
  `DEUDAFIN_2020` decimal(16,4) DEFAULT NULL,
  `DEUDAFIN_2019` decimal(16,4) DEFAULT NULL,
  `LIQUAJUST_2020` decimal(16,4) DEFAULT NULL,
  `LIQUAJUST_2019` decimal(16,4) DEFAULT NULL,
  `INGRESOSCORR_2020` decimal(16,4) DEFAULT NULL,
  `INGRESOSCORR_2019` decimal(16,4) DEFAULT NULL,
  `GASTOSCORR_2020` decimal(16,4) DEFAULT NULL,
  `GASTOSCORR_2019` decimal(16,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scoring_ccaa`
--

CREATE TABLE `scoring_ccaa` (
  `CIF` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `CODIGO_CCAA` int(10) NOT NULL,
  `NOMBRE_CCAA` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `RATING_N_1` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA_N_1` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `RATING_N` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA_N` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scoring_dip`
--

CREATE TABLE `scoring_dip` (
  `CODIGO_DIP` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `R1_2020` decimal(10,4) NOT NULL,
  `R2_2020` decimal(10,4) NOT NULL,
  `R3_2020` decimal(10,4) NOT NULL,
  `R4_2020` decimal(10,4) NOT NULL,
  `R5_2020` decimal(10,4) NOT NULL,
  `R6_2020` decimal(10,4) NOT NULL,
  `R7_2020` decimal(10,4) NOT NULL,
  `R8_2020` decimal(10,4) NOT NULL,
  `R9_2020` decimal(10,4) NOT NULL,
  `R10_2020` decimal(10,4) NOT NULL,
  `R11_2020` decimal(10,4) NOT NULL,
  `R12_2020` decimal(10,4) NOT NULL,
  `R13_2020` decimal(10,4) NOT NULL,
  `R1_2019` decimal(10,4) NOT NULL,
  `R2_2019` decimal(10,4) NOT NULL,
  `R3_2019` decimal(10,4) NOT NULL,
  `R4_2019` decimal(10,4) NOT NULL,
  `R5_2019` decimal(10,4) NOT NULL,
  `R6_2019` decimal(10,4) NOT NULL,
  `R7_2019` decimal(10,4) NOT NULL,
  `R8_2019` decimal(10,4) NOT NULL,
  `R9_2019` decimal(10,4) NOT NULL,
  `R10_2019` decimal(10,4) NOT NULL,
  `R11_2019` decimal(10,4) NOT NULL,
  `R12_2019` decimal(10,4) NOT NULL,
  `R13_2019` decimal(10,4) NOT NULL,
  `R1_NAC_2020` decimal(10,4) NOT NULL,
  `R2_NAC_2020` decimal(10,4) NOT NULL,
  `R3_NAC_2020` decimal(10,4) NOT NULL,
  `R4_NAC_2020` decimal(10,4) NOT NULL,
  `R5_NAC_2020` decimal(10,4) NOT NULL,
  `R6_NAC_2020` decimal(10,4) NOT NULL,
  `R7_NAC_2020` decimal(10,4) NOT NULL,
  `R8_NAC_2020` decimal(10,4) NOT NULL,
  `R9_NAC_2020` decimal(10,4) NOT NULL,
  `R10_NAC_2020` decimal(10,4) NOT NULL,
  `R11_NAC_2020` decimal(10,4) NOT NULL,
  `R12_NAC_2020` decimal(10,4) NOT NULL,
  `R13_NAC_2020` decimal(10,4) NOT NULL,
  `R1_NAC_2019` decimal(10,4) NOT NULL,
  `R2_NAC_2019` decimal(10,4) NOT NULL,
  `R3_NAC_2019` decimal(10,4) NOT NULL,
  `R4_NAC_2019` decimal(10,4) NOT NULL,
  `R5_NAC_2019` decimal(10,4) NOT NULL,
  `R6_NAC_2019` decimal(10,4) NOT NULL,
  `R7_NAC_2019` decimal(10,4) NOT NULL,
  `R8_NAC_2019` decimal(10,4) NOT NULL,
  `R9_NAC_2019` decimal(10,4) NOT NULL,
  `R10_NAC_2019` decimal(10,4) NOT NULL,
  `R11_NAC_2019` decimal(10,4) NOT NULL,
  `R12_NAC_2019` decimal(10,4) NOT NULL,
  `R13_NAC_2019` decimal(10,4) NOT NULL,
  `RATING_N_1` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA_N_1` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `RATING_N` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA_N` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scoring_mun`
--

CREATE TABLE `scoring_mun` (
  `CODIGO_MUN` int(5) NOT NULL,
  `CIF_MUNICIPIO` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `MUNICIPIO` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `R1_2020` decimal(10,5) NOT NULL,
  `R2_2020` decimal(10,5) NOT NULL,
  `R3_2020` decimal(10,5) NOT NULL,
  `R4_2020` decimal(10,5) NOT NULL,
  `R5_2020` decimal(10,5) NOT NULL,
  `R6_2020` decimal(10,5) NOT NULL,
  `R7_2020` decimal(10,5) NOT NULL,
  `R8_2020` decimal(10,5) NOT NULL,
  `R9_2020` decimal(10,5) NOT NULL,
  `R10_2020` decimal(10,5) NOT NULL,
  `R11_2020` decimal(10,5) NOT NULL,
  `R12_2020` decimal(10,5) NOT NULL,
  `R13_2020` decimal(10,5) NOT NULL,
  `R1_2019` decimal(10,5) NOT NULL,
  `R2_2019` decimal(10,5) NOT NULL,
  `R3_2019` decimal(10,5) NOT NULL,
  `R4_2019` decimal(10,5) NOT NULL,
  `R5_2019` decimal(10,5) NOT NULL,
  `R6_2019` decimal(10,5) NOT NULL,
  `R7_2019` decimal(10,5) NOT NULL,
  `R8_2019` decimal(10,5) NOT NULL,
  `R9_2019` decimal(10,5) NOT NULL,
  `R10_2019` decimal(10,5) NOT NULL,
  `R11_2019` decimal(10,5) NOT NULL,
  `R12_2019` decimal(10,5) NOT NULL,
  `R13_2019` decimal(10,5) NOT NULL,
  `R1_NAC_2020` decimal(10,5) NOT NULL,
  `R2_NAC_2020` decimal(10,5) NOT NULL,
  `R3_NAC_2020` decimal(10,5) NOT NULL,
  `R4_NAC_2020` decimal(10,5) NOT NULL,
  `R5_NAC_2020` decimal(10,5) NOT NULL,
  `R6_NAC_2020` decimal(10,5) NOT NULL,
  `R7_NAC_2020` decimal(10,5) NOT NULL,
  `R8_NAC_2020` decimal(10,5) NOT NULL,
  `R9_NAC_2020` decimal(10,5) NOT NULL,
  `R10_NAC_2020` decimal(10,5) NOT NULL,
  `R11_NAC_2020` decimal(10,5) NOT NULL,
  `R12_NAC_2020` decimal(10,5) NOT NULL,
  `R13_NAC_2020` decimal(10,5) NOT NULL,
  `R1_NAC_2019` decimal(10,5) NOT NULL,
  `R2_NAC_2019` decimal(10,5) NOT NULL,
  `R3_NAC_2019` decimal(10,5) NOT NULL,
  `R4_NAC_2019` decimal(10,5) NOT NULL,
  `R5_NAC_2019` decimal(10,5) NOT NULL,
  `R6_NAC_2019` decimal(10,5) NOT NULL,
  `R7_NAC_2019` decimal(10,5) NOT NULL,
  `R8_NAC_2019` decimal(10,5) NOT NULL,
  `R9_NAC_2019` decimal(10,5) NOT NULL,
  `R10_NAC_2019` decimal(10,5) NOT NULL,
  `R11_NAC_2019` decimal(10,5) NOT NULL,
  `R12_NAC_2019` decimal(10,5) NOT NULL,
  `R13_NAC_2019` decimal(10,5) NOT NULL,
  `RATING_N_1` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA_N_1` varchar(8) COLLATE utf8mb4_spanish_ci NOT NULL,
  `RATING_N` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA_N` varchar(8) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloque_general_ccaa`
--
ALTER TABLE `bloque_general_ccaa`
  ADD PRIMARY KEY (`CODIGO_CCAA`);

--
-- Indices de la tabla `bloque_general_dip`
--
ALTER TABLE `bloque_general_dip`
  ADD PRIMARY KEY (`CODIGO_DIP`,`DIPUTACION`,`CIF`);

--
-- Indices de la tabla `bloque_general_mun`
--
ALTER TABLE `bloque_general_mun`
  ADD PRIMARY KEY (`CODIGO_MUN`);

--
-- Indices de la tabla `scoring_ccaa`
--
ALTER TABLE `scoring_ccaa`
  ADD PRIMARY KEY (`CIF`);

--
-- Indices de la tabla `scoring_dip`
--
ALTER TABLE `scoring_dip`
  ADD PRIMARY KEY (`CODIGO_DIP`);

--
-- Indices de la tabla `scoring_mun`
--
ALTER TABLE `scoring_mun`
  ADD PRIMARY KEY (`CODIGO_MUN`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
