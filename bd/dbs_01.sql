-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2021 a las 17:27:48
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

--
-- Volcado de datos para la tabla `bloque_general_ccaa`
--

INSERT INTO `bloque_general_ccaa` (`CODIGO_CCAA`, `NOMBRE_CCAA`, `POBLACION_2017`, `NOMBREPRESIDENTE`, `APELLIDO1PRESIDENTE`, `APELLIDO2PRESIDENTE`, `VIGENCIA`, `PARTIDO`, `CIF`, `TIPOVIA`, `NOMBREVIA`, `NUMVIA`, `CODPOSTAL`, `TELEFONO`, `FAX`, `WEB`, `MAIL`, `REFPIB`, `PIB`, `REFPIBC`, `PIBC`, `REFRESULTADO`, `RESULTADO`, `REFDEUDAVIVA`, `DEUDAVIVA`) VALUES
(1, 'Andalucía', 8379820, 'Juan Manuel\n', 'Moreno\n', 'Bonilla\n', '2019-01-18', 'PP\n', 'S4111001F', 'PASEO', 'De Roma', 'S/N', 41071, 955062627, 0, 'www.juntadeandalucia.es/index.html', 'https://correo.andaluciajunta.', 2019, 165865509, 2019, 20, 2020, 138, 202103, '35097997.00'),
(2, 'Aragón', 1308750, 'Francisco Javier\n', 'Lambán\n', 'Montañés\n', '2015-07-05', 'PSOE', 'S5011001D', 'PASEO', 'Maria Agustin', '36', 50071, 976714000, 0, 'www.aragon.es/', '', 2019, 38043571, 2019, 29, 2019, -988, 202103, '8767193.00'),
(3, 'Asturias, Principado', 1034960, 'Adrian\n', 'Barbon\n', 'Rodriguez\n', '2019-07-20', 'PSOE', 'S3333001J', 'CALLE', 'Trece Rosas\n', '2', 33005, 985105500, 0, 'www.asturias.es', '', 2019, 23765248, 2019, 23, 2019, -732, 202103, '4907314.00'),
(4, 'Balears, Illes', 1115999, 'Francesca Lluc\n', 'Armengol\n', 'Socías\n', '2015-07-02', 'PSOE', 'S0711001H', 'CALLE', 'Palau Reial\n', '17', 7001, 971176565, 971176587, 'www.caib.es', 'president@caib.es', 2019, 33799767, 2019, 30, 2019, -573, 202103, '9007744.00'),
(5, 'Canarias', 2108121, 'Angel Victor\n', 'Torres\n', 'Perez\n', '2019-07-16', 'PSOE', 'S3511001D', 'PLAZA', 'Doctor Rafael O\'Shanahan', '1', 35007, 928452100, 928452144, 'www.gobcan.es', '', 2019, 47164165, 2019, 22, 2019, 629, 202103, '6693971.00'),
(6, 'Cantabria', 580295, 'Miguel Ángel\n', 'Revilla', 'Roiz', '2015-07-06', 'PRC', 'S3933002B', 'CALLE', 'Peña Herbosa', '29', 39003, 942207550, 942207565, 'www.cantabria.es', 'intervencion@gobcantabria.es', 2019, 14187412, 2019, 24, 2019, -959, 202103, '3340023.00'),
(7, 'Castilla y León', 2425801, 'Alfonso\n', 'Fernandez', 'Mañueco\n', '2019-07-12', 'PP', 'S4711001J', 'PLAZA', 'Castilla y León', '1', 47008, 983411120, 983411269, 'www.jcyl.es', '', 2019, 59794929, 2019, 25, 2019, -728, 202103, '12983159.00'),
(8, 'Castilla - La Mancha', 2031479, 'Emiliano\n', 'Garciá-Page\n', 'Sanchez\n', '2015-07-04', 'PSOE', 'S1911001D', 'PLAZA', 'Conde (Palacio Fuensalida)', '5', 45071, 925267601, 925213654, 'www.jccm.es', '', 2019, 42820105, 2019, 21, 2019, -1201, 202103, '15658510.00'),
(9, 'Cataluña', 7555830, 'Pere', 'Aragones', 'Gacria', '2020-09-28', 'ERC', 'S0811001G', 'PLAZA', 'San Jaume', '4', 8002, 934024600, 0, 'www.gencat.es', 'gbpresident.presidencia@gencat', 2019, 236813926, 2019, 31, 2019, -616, 202103, '80399182.00'),
(10, 'Comunitat Valenciana', 4941509, 'Joaquín Francisco \'Ximo\'\n', 'Puig\n', 'Ferrer\n', '2015-06-27', 'PSOE', 'S4611001A', 'CALLE', 'Caballeros (Palau de la Generalitat)', '12', 46001, 963866100, 963866163, 'www.gva.es', '', 2019, 116015335, 2019, 23, 2019, -1943, 202103, '51116873.00'),
(11, 'Extremadura', 1079920, 'Guillermo\n', 'Fernández', 'Vara', '2015-07-04', 'PSOE', 'S0611001I', 'PLAZA', 'del Rastro', 'S/N', 6800, 924003438, 924003441, 'www.juntaex.es', 'presidente@prs.juntaex.es', 2019, 20677010, 2019, 19, 2019, -1206, 202103, '5083606.00'),
(12, 'Galicia', 2708339, 'Alberto\n', 'Núñez', 'Feijóo', '2009-04-18', 'PP', 'S1511001H', 'CALLE', 'San Caetano', 'S/N', 15704, 981545922, 981541252, 'www.xunta.es', 'presiden@xunta.es', 2019, 64429878, 2019, 24, 2019, -461, 202103, '11737566.00'),
(13, 'Madrid, Comunidad de', 6507184, 'Isabel ', 'Díaz\n', 'Ayuso\n', '2019-08-19', 'PP', 'S7800001E', 'PLAZA', 'Puerta del Sol', '7', 28013, 915801592, 915802047, 'www.madrid.org', 'atencionalciudadano@madrid.org', 2019, 240129959, 2019, 37, 2019, -242, 202103, '35351901.00'),
(14, 'Murcia, Región de', 1470273, 'Fernando\n', 'López', 'Miras', '2017-05-03', 'PP', 'S3011001I', 'CALLE', 'Acisclo Díaz', 'S/N', 30005, 968298008, 968293477, 'www.carm.es', 'intervencion.general@carm.es', 2019, 32356061, 2019, 22, 2019, -1791, 202103, '10839338.00'),
(15, 'Navarra, Comunidad F', 643234, 'Maria', 'Chivite\n', 'Navascues\n', '2019-08-06', 'PSOE', 'S3100000C', 'AVENIDA', 'San Ignacio', '1', 31002, 848427011, 0, 'www.cfnavarra.es', 'secretarias.presidente@cfnavar', 2019, 20973354, 2019, 33, 2019, 361, 202103, '3751206.00'),
(16, 'País Vasco', 2194158, 'Íñigo\n', 'Urkullu', 'Rentería', '2012-12-15', 'PNV', 'S4833001C', 'CALLE', 'Donostia\n', '1', 1007, 945017900, 945017832, 'www.euskadi.eus', 'comunicacion@ej-gv.es', 2019, 74495916, 2019, 34, 2019, 483, 202103, '10924428.00'),
(17, 'Rioja, La', 315381, 'Concepción\n', 'Andreu\n', 'Rodriguez\n', '2019-08-29', 'PSOE', 'S2633001I', 'CALLE', 'Calle Vara del Rey', '3', 26071, 941291114, 941291223, 'www.larioja.org', 'presidente@larioja.org', 2019, 8867069, 2019, 28, 2019, -444, 202103, '1655875.00'),
(20, 'NACIONAL', 46572132, '', '', '', '0000-00-00', '', '', '', '', '', 0, 0, 0, '', '', 2019, 1244772000, 2019, 27, 2019, -571, 202012, '99999999.99');

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
  `INGRESOS_2020` decimal(10,2) DEFAULT NULL,
  `INGRESOS_2019` decimal(10,2) NOT NULL,
  `FONDLIQUIDOS_2020` decimal(10,2) DEFAULT NULL,
  `FONDLIQUIDOS_2019` decimal(10,2) NOT NULL,
  `DERPENDCOBRO_2020` decimal(10,2) DEFAULT NULL,
  `DERPENDCOBRO_2019` decimal(10,2) NOT NULL,
  `DEUDACOM_2020` decimal(10,2) DEFAULT NULL,
  `DEUDACOM_2019` decimal(10,2) NOT NULL,
  `DEUDAFIN_2020` int(10) DEFAULT NULL,
  `DEUDAFIN_2019` int(10) NOT NULL,
  `LIQUAJUST_2020` decimal(10,2) DEFAULT NULL,
  `LIQUAJUST_2019` decimal(10,2) NOT NULL,
  `INGRESOSCORR_2020` decimal(10,2) DEFAULT NULL,
  `INGRESOSCORR_2019` decimal(10,2) NOT NULL,
  `GASTOCORR_2020` decimal(10,2) DEFAULT NULL,
  `GASTOCORR_2019` decimal(10,2) NOT NULL
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
