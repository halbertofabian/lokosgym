-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-09-2021 a las 21:50:34
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_lokosgym_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras_cps`
--

CREATE TABLE `tbl_compras_cps` (
  `cps_id` int(11) NOT NULL,
  `cps_suc_nombre` varchar(250) NOT NULL,
  `cps_id_proveedor` int(11) NOT NULL,
  `cps_folio` varchar(100) NOT NULL,
  `cps_productos` text NOT NULL,
  `cps_fecha_compra` datetime NOT NULL,
  `cps_num_articulos` int(11) NOT NULL,
  `cps_total` double(10,2) NOT NULL,
  `cps_costo_envio` double(10,2) NOT NULL,
  `cps_gran_total` double(10,2) NOT NULL,
  `cps_tipo_pago` varchar(50) NOT NULL,
  `cps_metodo_pago` varchar(50) NOT NULL,
  `cps_monto` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_compras_cps`
--
ALTER TABLE `tbl_compras_cps`
  ADD PRIMARY KEY (`cps_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_compras_cps`
--
ALTER TABLE `tbl_compras_cps`
  MODIFY `cps_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
