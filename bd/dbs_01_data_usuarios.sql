-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2022 at 05:00 PM
-- Server version: 5.7.38-log
-- PHP Version: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbs_01`
--

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`correo`, `nombre`, `contrasenia`, `rol`) VALUES
('admin@hotmail.com', 'admin', '$2y$12$wYr50aCJak2jQZRpMpw6WexIwXBHj.HQJWlhCZ2XGFMggdpvxb04W', 'admin'),
('manager@hotmail.com', 'manager', '$2y$12$RauzszMt08a0.NKDlOIGH.Ht2QpsjMbTXklBpfzZN65E66TxSv3k6', 'gestor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
