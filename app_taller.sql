-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2023 a las 19:03:03
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app_taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `primerapellido` varchar(255) NOT NULL,
  `segundoapellido` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facturas`
--

CREATE TABLE `tbl_facturas` (
  `id` int(11) NOT NULL,
  `factura` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `monto` int(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mantenimiento`
--

CREATE TABLE `tbl_mantenimiento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `costo` int(255) NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_presupuestos`
--

CREATE TABLE `tbl_presupuestos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `factura` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedor`
--

CREATE TABLE `tbl_proveedor` (
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------


-- Estructura de tabla para la tabla `tbl_reparaciones`
--

CREATE TABLE `tbl_reparaciones` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idvehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_repuestos_mant`
--

CREATE TABLE `tbl_repuestos_mant` (
  `id` int(11) NOT NULL,
  `repuesto` varchar(255) NOT NULL,
  `costo` int(11) NOT NULL,
  `idreparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios_cot`
--

CREATE TABLE `tbl_servicios_cot` (
  `id` int(11) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `costo` int(11) NOT NULL,
  `idpresupuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios_mant`
--

CREATE TABLE `tbl_servicios_mant` (
  `id` int(11) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `costo` int(11) NOT NULL,
  `idreparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `primerapellido` varchar(255) NOT NULL,
  `segundoapellido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `usuario`, `password`, `correo`, `nombre`, `primerapellido`, `segundoapellido`) VALUES
(1, 'admin', 'Soporte1', 'admin@correo.com', 'Geiner', 'Sanchez', 'Barboza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_vehiculos`
--

CREATE TABLE `tbl_vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `combustible` varchar(255) NOT NULL,
  `km` int(255) NOT NULL,
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_facturas`
--
ALTER TABLE `tbl_facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_mantenimiento`
--
ALTER TABLE `tbl_mantenimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculo` (`idvehiculo`);

--
-- Indices de la tabla `tbl_presupuestos`
--
ALTER TABLE `tbl_presupuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`idcliente`);

--
-- Indices de la tabla `tbl_proveedor`
--
ALTER TABLE `tbl_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_reparaciones`
--
ALTER TABLE `tbl_reparaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculo` (`idvehiculo`);

--
-- Indices de la tabla `tbl_repuestos_mant`
--
ALTER TABLE `tbl_repuestos_mant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idreparacion` (`idreparacion`);

--
-- Indices de la tabla `tbl_servicios_cot`
--
ALTER TABLE `tbl_servicios_cot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpresupuesto` (`idpresupuesto`);

--
-- Indices de la tabla `tbl_servicios_mant`
--
ALTER TABLE `tbl_servicios_mant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idmantenimiento` (`idreparacion`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_vehiculos`
--
ALTER TABLE `tbl_vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcliente` (`idcliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_facturas`
--
ALTER TABLE `tbl_facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_mantenimiento`
--
ALTER TABLE `tbl_mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_presupuestos`
--
ALTER TABLE `tbl_presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedor`
--
ALTER TABLE `tbl_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_reparaciones`
--
ALTER TABLE `tbl_reparaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_repuestos_mant`
--
ALTER TABLE `tbl_repuestos_mant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_servicios_cot`
--
ALTER TABLE `tbl_servicios_cot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_servicios_mant`
--
ALTER TABLE `tbl_servicios_mant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `tbl_vehiculos`
--
ALTER TABLE `tbl_vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_facturas`
--
ALTER TABLE `tbl_facturas`
  ADD CONSTRAINT `tbl_facturas_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_mantenimiento`
--
ALTER TABLE `tbl_mantenimiento`
  ADD CONSTRAINT `tbl_mantenimiento_ibfk_1` FOREIGN KEY (`idvehiculo`) REFERENCES `tbl_vehiculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_presupuestos`
--
ALTER TABLE `tbl_presupuestos`
  ADD CONSTRAINT `tbl_presupuestos_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `tbl_clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_reparaciones`
--
ALTER TABLE `tbl_reparaciones`
  ADD CONSTRAINT `tbl_reparaciones_ibfk_1` FOREIGN KEY (`idvehiculo`) REFERENCES `tbl_vehiculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_repuestos_mant`
--
ALTER TABLE `tbl_repuestos_mant`
  ADD CONSTRAINT `tbl_repuestos_mant_ibfk_1` FOREIGN KEY (`idreparacion`) REFERENCES `tbl_reparaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_servicios_cot`
--
ALTER TABLE `tbl_servicios_cot`
  ADD CONSTRAINT `tbl_servicios_cot_ibfk_1` FOREIGN KEY (`idpresupuesto`) REFERENCES `tbl_presupuestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_servicios_mant`
--
ALTER TABLE `tbl_servicios_mant`
  ADD CONSTRAINT `tbl_servicios_mant_ibfk_1` FOREIGN KEY (`idreparacion`) REFERENCES `tbl_reparaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_vehiculos`
--
ALTER TABLE `tbl_vehiculos`
  ADD CONSTRAINT `tbl_vehiculos_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `tbl_clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


