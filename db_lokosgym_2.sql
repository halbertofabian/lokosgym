-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-05-2021 a las 23:19:47
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
-- Estructura de tabla para la tabla `tbl_asistencia_ast`
--

CREATE TABLE `tbl_asistencia_ast` (
  `ast_id` int(11) NOT NULL,
  `ast_socio` int(11) NOT NULL,
  `ast_fecha_inicio` datetime NOT NULL,
  `ast_fecha_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_caja_cja`
--

CREATE TABLE `tbl_caja_cja` (
  `cja_id_caja` int(11) NOT NULL,
  `cja_nombre` varchar(100) NOT NULL,
  `cja_id_sucursal` varchar(100) NOT NULL,
  `cja_usuario_registro` text NOT NULL,
  `cja_fecha_registro` datetime NOT NULL,
  `cja_uso` char(1) NOT NULL DEFAULT '0',
  `cja_copn_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_caja_cja`
--

INSERT INTO `tbl_caja_cja` (`cja_id_caja`, `cja_nombre`, `cja_id_sucursal`, `cja_usuario_registro`, `cja_fecha_registro`, `cja_uso`, `cja_copn_id`) VALUES
(1, 'CAJA 1', '', '', '0000-00-00 00:00:00', '0', 0),
(2, 'CAJA 2', '', '', '0000-00-00 00:00:00', '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_caja_open_copn`
--

CREATE TABLE `tbl_caja_open_copn` (
  `copn_id` int(11) NOT NULL,
  `copn_ingreso_inicio` double(10,2) DEFAULT NULL,
  `copn_usuario_abrio` int(11) DEFAULT NULL,
  `copn_usuario_cerro` varchar(50) DEFAULT NULL,
  `copn_ingreso_efectivo` double(10,2) DEFAULT NULL,
  `copn_ingreso_banco` double(10,2) DEFAULT NULL,
  `copn_efectivo_real` double(10,2) NOT NULL,
  `copn_banco_real` double(10,2) NOT NULL,
  `copn_fecha_abrio` datetime DEFAULT NULL,
  `copn_fecha_cierre` datetime DEFAULT NULL,
  `copn_usuario_autorizo` text NOT NULL,
  `copn_autorizo` char(1) NOT NULL,
  `copn_id_caja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `caracteristicas_categoria` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id`, `categoria`, `caracteristicas_categoria`) VALUES
(1, 'BEBIDA HIDRATANTE', ''),
(2, 'AGUAS', ''),
(3, 'SUPLEMENTOS', ''),
(4, 'ROPA DEPORTIVA', ''),
(5, 'ACCESORIOS PARA ENTRENAR', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo_cliente` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_cliente` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `wsp_cliente` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion_cliente` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `credito_cliente` double(10,2) DEFAULT NULL,
  `porcentaje_cliente` int(11) DEFAULT NULL,
  `observaciones` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vigencia` date DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_registro` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_ventas`
--

CREATE TABLE `tbl_detalle_ventas` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `neto` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_membresias_mbs`
--

CREATE TABLE `tbl_membresias_mbs` (
  `mbs_id` int(11) NOT NULL,
  `mbs_tipo` varchar(100) NOT NULL,
  `mbs_costo` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pagos_pmbs`
--

CREATE TABLE `tbl_pagos_pmbs` (
  `pmbs_id` int(11) NOT NULL,
  `pmbs_fecha_pago` datetime NOT NULL,
  `pmbs_mp` varchar(100) NOT NULL,
  `pmbs_monto` double(10,2) NOT NULL,
  `pmbs_ref` text NOT NULL,
  `pmbs_corte` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `producto` text COLLATE utf8_spanish_ci NOT NULL,
  `marca` text COLLATE utf8_spanish_ci NOT NULL,
  `categoria` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `caracteristicas_producto` text COLLATE utf8_spanish_ci NOT NULL,
  `existencia` int(11) NOT NULL,
  `existencia_min` int(11) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_publico` decimal(10,2) NOT NULL,
  `precio_mayoreo` decimal(10,2) NOT NULL,
  `precio_especial` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_registro_membresias_rmbs`
--

CREATE TABLE `tbl_registro_membresias_rmbs` (
  `rmbs_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `rmbs_fecha_inicio` date NOT NULL,
  `rmbs_fecha_termino` date NOT NULL,
  `mbs_id` int(11) NOT NULL,
  `rmbs_status` char(1) NOT NULL DEFAULT '1',
  `rmbs_costo_renovacion` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `lectura` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `modificacion` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `eliminacion` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `modulos` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `usr_caja` int(11) NOT NULL,
  `usr_perfil` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Administrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `usuario`, `correo`, `clave`, `rol`, `nombre`, `apellido`, `domicilio`, `telefono`, `usr_caja`, `usr_perfil`) VALUES
(1, 'albert97', 'lf_alberto@outlook.com', '$2a$07$asxx54ahjppf45sd87a5aunuAMP.qSo.ndCErjCFA9CsbmWbSMPmu', 0, 'Hector Alberto', 'López Fabián', '', '7341006945', 0, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas`
--

CREATE TABLE `tbl_ventas` (
  `id_venta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `forma_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `neto` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `descuento` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_corte` int(11) NOT NULL,
  `venta_mp` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_asistencia_ast`
--
ALTER TABLE `tbl_asistencia_ast`
  ADD PRIMARY KEY (`ast_id`),
  ADD KEY `ast_socio` (`ast_socio`);

--
-- Indices de la tabla `tbl_caja_cja`
--
ALTER TABLE `tbl_caja_cja`
  ADD PRIMARY KEY (`cja_id_caja`),
  ADD UNIQUE KEY `cja_nombre` (`cja_nombre`);

--
-- Indices de la tabla `tbl_caja_open_copn`
--
ALTER TABLE `tbl_caja_open_copn`
  ADD PRIMARY KEY (`copn_id`),
  ADD KEY `copn_usr_fk` (`copn_usuario_abrio`),
  ADD KEY `copn_cja_fk` (`copn_id_caja`);

--
-- Indices de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tbl_detalle_ventas`
--
ALTER TABLE `tbl_detalle_ventas`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_venta` (`id_venta`),
  ADD KEY `fk_detalle_producto` (`id_producto`);

--
-- Indices de la tabla `tbl_membresias_mbs`
--
ALTER TABLE `tbl_membresias_mbs`
  ADD PRIMARY KEY (`mbs_id`);

--
-- Indices de la tabla `tbl_pagos_pmbs`
--
ALTER TABLE `tbl_pagos_pmbs`
  ADD PRIMARY KEY (`pmbs_id`),
  ADD KEY `usr_pagos_fk` (`id_vendedor`),
  ADD KEY `cts_pago_fk` (`id_cliente`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categoria` (`categoria`);

--
-- Indices de la tabla `tbl_registro_membresias_rmbs`
--
ALTER TABLE `tbl_registro_membresias_rmbs`
  ADD PRIMARY KEY (`rmbs_id`),
  ADD KEY `rmbs_clientes_fk` (`cliente_id`),
  ADD KEY `rmbs_membresias_fk` (`mbs_id`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_ventas_vendedor` (`id_vendedor`),
  ADD KEY `fk_ventas_clientes` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_asistencia_ast`
--
ALTER TABLE `tbl_asistencia_ast`
  MODIFY `ast_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_caja_cja`
--
ALTER TABLE `tbl_caja_cja`
  MODIFY `cja_id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_caja_open_copn`
--
ALTER TABLE `tbl_caja_open_copn`
  MODIFY `copn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_ventas`
--
ALTER TABLE `tbl_detalle_ventas`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_membresias_mbs`
--
ALTER TABLE `tbl_membresias_mbs`
  MODIFY `mbs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pagos_pmbs`
--
ALTER TABLE `tbl_pagos_pmbs`
  MODIFY `pmbs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_registro_membresias_rmbs`
--
ALTER TABLE `tbl_registro_membresias_rmbs`
  MODIFY `rmbs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_asistencia_ast`
--
ALTER TABLE `tbl_asistencia_ast`
  ADD CONSTRAINT `ast_socio` FOREIGN KEY (`ast_socio`) REFERENCES `tbl_clientes` (`id_cliente`);

--
-- Filtros para la tabla `tbl_caja_open_copn`
--
ALTER TABLE `tbl_caja_open_copn`
  ADD CONSTRAINT `copn_cja_fk` FOREIGN KEY (`copn_id_caja`) REFERENCES `tbl_caja_cja` (`cja_id_caja`),
  ADD CONSTRAINT `copn_usr_fk` FOREIGN KEY (`copn_usuario_abrio`) REFERENCES `tbl_usuarios` (`id`);

--
-- Filtros para la tabla `tbl_detalle_ventas`
--
ALTER TABLE `tbl_detalle_ventas`
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`id_venta`) REFERENCES `tbl_ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_pagos_pmbs`
--
ALTER TABLE `tbl_pagos_pmbs`
  ADD CONSTRAINT `cts_pago_fk` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `usr_pagos_fk` FOREIGN KEY (`id_vendedor`) REFERENCES `tbl_usuarios` (`id`);

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`categoria`) REFERENCES `tbl_categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_registro_membresias_rmbs`
--
ALTER TABLE `tbl_registro_membresias_rmbs`
  ADD CONSTRAINT `rmbs_clientes_fk` FOREIGN KEY (`cliente_id`) REFERENCES `tbl_clientes` (`id_cliente`),
  ADD CONSTRAINT `rmbs_membresias_fk` FOREIGN KEY (`mbs_id`) REFERENCES `tbl_membresias_mbs` (`mbs_id`);

--
-- Filtros para la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD CONSTRAINT `fk_ventas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ventas_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `tbl_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
