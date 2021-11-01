-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2021 a las 15:17:04
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
-- Estructura de tabla para la tabla `ccaas`
--

CREATE TABLE `ccaas` (
  `CODIGO` int(10) NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `POBLACION` int(10) DEFAULT NULL,
  `NOMBRE_PRESIDENTE` varchar(35) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO1_PRESIDENTE` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO2_PRESIDENTE` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `VIGENCIA` date DEFAULT NULL,
  `PARTIDO` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CIF` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TIPO_VIA` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NOMBRE_VIA` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NUM_VIA` varchar(5) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `COD_POSTAL` int(5) DEFAULT NULL,
  `TELEFONO` int(15) DEFAULT NULL,
  `FAX` int(10) DEFAULT NULL,
  `WEB` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `MAIL` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_ccaa_gastos`
--

CREATE TABLE `cuentas_ccaa_gastos` (
  `CODIGO` int(10) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TIPO` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `CRED_INI` decimal(17,4) DEFAULT NULL,
  `MOD_CRED` decimal(17,4) DEFAULT NULL,
  `CRED_TOT` decimal(17,4) DEFAULT NULL,
  `OBLG_REC` decimal(17,4) DEFAULT NULL,
  `PAGOS_COR` decimal(17,4) DEFAULT NULL,
  `PAGOS_CER` decimal(17,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_ccaa_general`
--

CREATE TABLE `cuentas_ccaa_general` (
  `CODIGO` int(10) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `INCR_PIB` decimal(5,4) NOT NULL,
  `TRANSAC_INMOBILIARIAS` decimal(5,4) NOT NULL,
  `N_EMPRESAS` decimal(5,4) NOT NULL,
  `CCAA_PIB` decimal(7,6) NOT NULL,
  `DEUDA_VIVA` decimal(5,4) NOT NULL,
  `R_SOSTE_FINANCIERA` decimal(5,4) NOT NULL,
  `R_RIGIDEZ` decimal(5,4) NOT NULL,
  `R_SOSTE_ENDEUDA` decimal(5,4) NOT NULL,
  `R_EJE_INGR_CORR` decimal(5,4) NOT NULL,
  `R_EJE_GASTOS_CORR` decimal(5,4) NOT NULL,
  `PAGOS_OBLIGACIONES` decimal(5,4) NOT NULL,
  `R_EFICACIA_REC` decimal(5,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_ccaa_general_mensual`
--

CREATE TABLE `cuentas_ccaa_general_mensual` (
  `CODIGO` int(10) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `MES` int(1) NOT NULL,
  `PARO` decimal(5,4) DEFAULT NULL,
  `PMP` decimal(5,2) DEFAULT NULL,
  `R_DCPP` decimal(5,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_ccaa_ingresos`
--

CREATE TABLE `cuentas_ccaa_ingresos` (
  `CODIGO` int(10) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TIPO` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `PREV_INI` decimal(17,4) DEFAULT NULL,
  `MOD_PREV_INI` decimal(17,4) DEFAULT NULL,
  `PREV_DEF` decimal(17,4) DEFAULT NULL,
  `DER_REC` decimal(17,4) DEFAULT NULL,
  `RECAUDA_COR` decimal(17,4) DEFAULT NULL,
  `RECAUDA_CER` decimal(17,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_dip_gastos`
--

CREATE TABLE `cuentas_dip_gastos` (
  `CODIGO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TIPO` int(2) NOT NULL,
  `PRES` decimal(15,2) DEFAULT NULL,
  `OBLG` decimal(15,2) DEFAULT NULL,
  `PAGOS` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_dip_ingresos`
--

CREATE TABLE `cuentas_dip_ingresos` (
  `CODIGO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TIPO` int(2) NOT NULL,
  `PRES` decimal(15,2) DEFAULT NULL,
  `DERE` decimal(15,2) DEFAULT NULL,
  `RECA` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_dip_pmp`
--

CREATE TABLE `cuentas_dip_pmp` (
  `CODIGO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TRIMESTRE` int(1) NOT NULL,
  `PMP` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_mun_gastos`
--

CREATE TABLE `cuentas_mun_gastos` (
  `CODIGO` int(5) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TIPO` int(2) NOT NULL,
  `PRES` decimal(15,2) DEFAULT NULL,
  `OBLG` decimal(15,2) DEFAULT NULL,
  `PAGOS` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_mun_ingresos`
--

CREATE TABLE `cuentas_mun_ingresos` (
  `CODIGO` int(5) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TIPO` int(2) NOT NULL,
  `PRES` decimal(15,2) DEFAULT NULL,
  `DERE` decimal(15,2) DEFAULT NULL,
  `RECA` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_mun_pmp`
--

CREATE TABLE `cuentas_mun_pmp` (
  `CODIGO` int(5) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `TRIMESTRE` int(1) NOT NULL,
  `PMP` decimal(4,2) DEFAULT NULL,
  `PARO` int(5) DEFAULT NULL,
  `TRANSAC_INMOBILIARIAS` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas_ccaa`
--

CREATE TABLE `deudas_ccaa` (
  `CODIGO` int(10) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `PIB` int(15) DEFAULT NULL,
  `PIBC` int(2) DEFAULT NULL,
  `RESULTADO` int(8) DEFAULT NULL,
  `DEUDAVIVA` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas_dip`
--

CREATE TABLE `deudas_dip` (
  `CODIGO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ANHO` int(4) NOT NULL,
  `INGRESOS` decimal(15,2) DEFAULT NULL,
  `FONDLIQUIDOS` decimal(15,2) DEFAULT NULL,
  `DERPENDCOBRO` decimal(15,2) DEFAULT NULL,
  `DEUDACOM` decimal(15,2) DEFAULT NULL,
  `DEUDAFIN` decimal(15,2) DEFAULT NULL,
  `LIQUAJUST` decimal(15,2) DEFAULT NULL,
  `INGRESOSCORR` decimal(15,2) DEFAULT NULL,
  `GASTOSCORR` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas_mun`
--

CREATE TABLE `deudas_mun` (
  `CODIGO` int(5) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `INGRESOS` decimal(15,2) DEFAULT NULL,
  `FONDLIQUIDOS` decimal(15,2) DEFAULT NULL,
  `DERPENDCOBRO` decimal(15,2) DEFAULT NULL,
  `DEUDACOM` decimal(15,2) DEFAULT NULL,
  `DEUDAFIN` decimal(15,2) DEFAULT NULL,
  `LIQUAJUST` decimal(15,2) DEFAULT NULL,
  `INGRESOSCORR` decimal(15,2) DEFAULT NULL,
  `GASTOSCORR` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diputaciones`
--

CREATE TABLE `diputaciones` (
  `CODIGO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `NOMBRE` varchar(60) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CIF` varchar(9) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TIPOVIA` varchar(6) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NOMBREVIA` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NUMVIA` varchar(5) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CODPOSTAL` int(5) DEFAULT NULL,
  `PROVINCIA` int(2) NOT NULL,
  `AUTONOMIA` int(10) NOT NULL,
  `TELEFONO` int(9) DEFAULT NULL,
  `FAX` int(9) DEFAULT NULL,
  `WEB` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `MAIL` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `CODIGO` int(5) NOT NULL,
  `CIF` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `PROVINCIA` int(2) NOT NULL,
  `AUTONOMIA` int(10) NOT NULL,
  `POBLACION` int(10) DEFAULT NULL,
  `NOMBREALCALDE` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO1ALCALDE` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `APELLIDO2ALCALDE` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `VIGENCIA` date DEFAULT NULL,
  `PARTIDO` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TIPOVIA` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NOMBREVIA` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NUMVIA` varchar(5) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `CODPOSTAL` int(5) DEFAULT NULL,
  `TELEFONO` int(10) DEFAULT NULL,
  `FAX` int(10) DEFAULT NULL,
  `WEB` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `MAIL` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `CODIGO` int(2) NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scoring_ccaa`
--

CREATE TABLE `scoring_ccaa` (
  `CODIGO` int(10) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `SCORING` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TENDENCIA` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scoring_dip`
--

CREATE TABLE `scoring_dip` (
  `CODIGO` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ANHO` int(4) NOT NULL,
  `R1` decimal(10,2) DEFAULT NULL,
  `R2` decimal(10,2) DEFAULT NULL,
  `R3` decimal(10,2) DEFAULT NULL,
  `R4` decimal(10,2) DEFAULT NULL,
  `R5` decimal(10,2) DEFAULT NULL,
  `R6` decimal(10,2) DEFAULT NULL,
  `R7` decimal(10,2) DEFAULT NULL,
  `R8` decimal(10,2) DEFAULT NULL,
  `R9` decimal(10,2) DEFAULT NULL,
  `R10` decimal(10,2) DEFAULT NULL,
  `R11` decimal(10,2) DEFAULT NULL,
  `R12` decimal(10,2) DEFAULT NULL,
  `R13` decimal(10,2) DEFAULT NULL,
  `R1_NAC` decimal(10,2) DEFAULT NULL,
  `R2_NAC` decimal(10,2) DEFAULT NULL,
  `R3_NAC` decimal(10,2) DEFAULT NULL,
  `R4_NAC` decimal(10,2) DEFAULT NULL,
  `R5_NAC` decimal(10,2) DEFAULT NULL,
  `R6_NAC` decimal(10,2) DEFAULT NULL,
  `R7_NAC` decimal(10,2) DEFAULT NULL,
  `R8_NAC` decimal(10,2) DEFAULT NULL,
  `R9_NAC` decimal(10,2) DEFAULT NULL,
  `R10_NAC` decimal(10,2) DEFAULT NULL,
  `R11_NAC` decimal(10,2) DEFAULT NULL,
  `R12_NAC` decimal(10,2) DEFAULT NULL,
  `R13_NAC` decimal(10,2) DEFAULT NULL,
  `RATING` varchar(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TENDENCIA` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scoring_mun`
--

CREATE TABLE `scoring_mun` (
  `CODIGO` int(5) NOT NULL,
  `ANHO` int(4) NOT NULL,
  `R1` decimal(10,5) DEFAULT NULL,
  `R2` decimal(10,5) DEFAULT NULL,
  `R3` decimal(10,5) DEFAULT NULL,
  `R4` decimal(10,5) DEFAULT NULL,
  `R5` decimal(10,5) DEFAULT NULL,
  `R6` decimal(10,5) DEFAULT NULL,
  `R7` decimal(10,5) DEFAULT NULL,
  `R8` decimal(10,5) DEFAULT NULL,
  `R9` decimal(10,5) DEFAULT NULL,
  `R10` decimal(10,5) DEFAULT NULL,
  `R11` decimal(10,5) DEFAULT NULL,
  `R12` decimal(10,5) DEFAULT NULL,
  `R13` decimal(10,5) DEFAULT NULL,
  `R1_NAC` decimal(10,5) DEFAULT NULL,
  `R2_NAC` decimal(10,5) DEFAULT NULL,
  `R3_NAC` decimal(10,5) DEFAULT NULL,
  `R4_NAC` decimal(10,5) DEFAULT NULL,
  `R5_NAC` decimal(10,5) DEFAULT NULL,
  `R6_NAC` decimal(10,5) DEFAULT NULL,
  `R7_NAC` decimal(10,5) DEFAULT NULL,
  `R8_NAC` decimal(10,5) DEFAULT NULL,
  `R9_NAC` decimal(10,5) DEFAULT NULL,
  `R10_NAC` decimal(10,5) DEFAULT NULL,
  `R11_NAC` decimal(10,5) DEFAULT NULL,
  `R12_NAC` decimal(10,5) DEFAULT NULL,
  `R13_NAC` decimal(10,5) DEFAULT NULL,
  `RATING` varchar(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TENDENCIA` varchar(8) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ccaas`
--
ALTER TABLE `ccaas`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indices de la tabla `cuentas_ccaa_gastos`
--
ALTER TABLE `cuentas_ccaa_gastos`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TIPO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_ccaa_general`
--
ALTER TABLE `cuentas_ccaa_general`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_ccaa_general_mensual`
--
ALTER TABLE `cuentas_ccaa_general_mensual`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`MES`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_ccaa_ingresos`
--
ALTER TABLE `cuentas_ccaa_ingresos`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TIPO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_dip_gastos`
--
ALTER TABLE `cuentas_dip_gastos`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TIPO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_dip_ingresos`
--
ALTER TABLE `cuentas_dip_ingresos`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TIPO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_dip_pmp`
--
ALTER TABLE `cuentas_dip_pmp`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TRIMESTRE`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_mun_gastos`
--
ALTER TABLE `cuentas_mun_gastos`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TIPO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_mun_ingresos`
--
ALTER TABLE `cuentas_mun_ingresos`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TIPO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `cuentas_mun_pmp`
--
ALTER TABLE `cuentas_mun_pmp`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`,`TRIMESTRE`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `deudas_ccaa`
--
ALTER TABLE `deudas_ccaa`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `deudas_dip`
--
ALTER TABLE `deudas_dip`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `deudas_mun`
--
ALTER TABLE `deudas_mun`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `diputaciones`
--
ALTER TABLE `diputaciones`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `PROVINCIA` (`PROVINCIA`),
  ADD KEY `AUTONOMIA` (`AUTONOMIA`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `PROVINCIA` (`PROVINCIA`),
  ADD KEY `AUTONOMIA` (`AUTONOMIA`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indices de la tabla `scoring_ccaa`
--
ALTER TABLE `scoring_ccaa`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `scoring_dip`
--
ALTER TABLE `scoring_dip`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- Indices de la tabla `scoring_mun`
--
ALTER TABLE `scoring_mun`
  ADD PRIMARY KEY (`CODIGO`,`ANHO`),
  ADD KEY `CODIGO` (`CODIGO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ccaas`
--
ALTER TABLE `ccaas`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_ccaa_gastos`
--
ALTER TABLE `cuentas_ccaa_gastos`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_ccaa_general`
--
ALTER TABLE `cuentas_ccaa_general`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_ccaa_general_mensual`
--
ALTER TABLE `cuentas_ccaa_general_mensual`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_ccaa_ingresos`
--
ALTER TABLE `cuentas_ccaa_ingresos`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deudas_ccaa`
--
ALTER TABLE `deudas_ccaa`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `scoring_ccaa`
--
ALTER TABLE `scoring_ccaa`
  MODIFY `CODIGO` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas_ccaa_gastos`
--
ALTER TABLE `cuentas_ccaa_gastos`
  ADD CONSTRAINT `cuentas_ccaa_gastos_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_ccaa_general`
--
ALTER TABLE `cuentas_ccaa_general`
  ADD CONSTRAINT `cuentas_ccaa_general_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_ccaa_general_mensual`
--
ALTER TABLE `cuentas_ccaa_general_mensual`
  ADD CONSTRAINT `cuentas_ccaa_general_mensual_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_ccaa_ingresos`
--
ALTER TABLE `cuentas_ccaa_ingresos`
  ADD CONSTRAINT `cuentas_ccaa_ingresos_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_dip_gastos`
--
ALTER TABLE `cuentas_dip_gastos`
  ADD CONSTRAINT `cuentas_dip_gastos_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `diputaciones` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_dip_ingresos`
--
ALTER TABLE `cuentas_dip_ingresos`
  ADD CONSTRAINT `cuentas_dip_ingresos_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `diputaciones` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_dip_pmp`
--
ALTER TABLE `cuentas_dip_pmp`
  ADD CONSTRAINT `cuentas_dip_pmp_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `diputaciones` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_mun_gastos`
--
ALTER TABLE `cuentas_mun_gastos`
  ADD CONSTRAINT `cuentas_mun_gastos_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `municipios` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_mun_ingresos`
--
ALTER TABLE `cuentas_mun_ingresos`
  ADD CONSTRAINT `cuentas_mun_ingresos_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `municipios` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas_mun_pmp`
--
ALTER TABLE `cuentas_mun_pmp`
  ADD CONSTRAINT `cuentas_mun_pmp_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `municipios` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deudas_ccaa`
--
ALTER TABLE `deudas_ccaa`
  ADD CONSTRAINT `deudas_ccaa_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deudas_dip`
--
ALTER TABLE `deudas_dip`
  ADD CONSTRAINT `deudas_dip_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `diputaciones` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deudas_mun`
--
ALTER TABLE `deudas_mun`
  ADD CONSTRAINT `deudas_mun_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `municipios` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diputaciones`
--
ALTER TABLE `diputaciones`
  ADD CONSTRAINT `diputaciones_ibfk_1` FOREIGN KEY (`PROVINCIA`) REFERENCES `provincias` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diputaciones_ibfk_2` FOREIGN KEY (`AUTONOMIA`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`PROVINCIA`) REFERENCES `provincias` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `municipios_ibfk_2` FOREIGN KEY (`AUTONOMIA`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `scoring_ccaa`
--
ALTER TABLE `scoring_ccaa`
  ADD CONSTRAINT `scoring_ccaa_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `ccaas` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `scoring_dip`
--
ALTER TABLE `scoring_dip`
  ADD CONSTRAINT `scoring_dip_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `diputaciones` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `scoring_mun`
--
ALTER TABLE `scoring_mun`
  ADD CONSTRAINT `scoring_mun_ibfk_1` FOREIGN KEY (`CODIGO`) REFERENCES `municipios` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
