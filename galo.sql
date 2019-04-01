-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2019 a las 02:52:14
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `galo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_desc` varchar(100) NOT NULL,
  `cat_nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_desc`, `cat_nombre`) VALUES
(1, 'Polizas de importaciones y documentos relacionados ', 'Importaciones'),
(3, 'documentaciÃ³n relacionada a las exportaciones ', 'exportaciones'),
(4, '', 'Re-exportacion'),
(5, '', 'Compras Locales'),
(6, '', 'PÃ³lizas Definitivas'),
(7, 'documentos de archivo galo y asociados ', 'Archivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nombre` varchar(100) NOT NULL,
  `cliente_mail` varchar(50) NOT NULL,
  `cliente_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_nombre`, `cliente_mail`, `cliente_info`) VALUES
(1, 'Galo y Asociados s,a', 'vmorales@galoyasociados.com', 'Agencia aduanera galo y asociados ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `doc_id` int(11) NOT NULL,
  `doc_numliq` varchar(50) NOT NULL,
  `doc_ruta` varchar(100) NOT NULL,
  `doc_cat` int(11) NOT NULL,
  `doc_cliente` int(11) NOT NULL,
  `doc_usuario` int(11) NOT NULL,
  `doc_anio` int(11) NOT NULL,
  `doc_papelera` tinyint(4) NOT NULL,
  `doc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`doc_id`, `doc_numliq`, `doc_ruta`, `doc_cat`, `doc_cliente`, `doc_usuario`, `doc_anio`, `doc_papelera`, `doc_timestamp`) VALUES
(12, 'l-8532', 'UPLOADS/l-8532.pdf', 1, 1, 1, 2018, 1, '2019-03-25 02:20:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permisos_id` int(11) NOT NULL,
  `permisos_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`permisos_id`, `permisos_desc`) VALUES
(1, 'SUBIR, BUSCAR Y CREAR USUARIOS'),
(2, 'BUSCAR Y CREAR USUARIOS'),
(3, 'SUBIR Y BUSCAR'),
(4, 'TOTAL'),
(5, 'BUSCAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(100) NOT NULL,
  `user_monbre` varchar(100) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_tipo` varchar(20) NOT NULL,
  `user_cliente` int(11) NOT NULL,
  `user_permiso` int(2) NOT NULL,
  `user_buscar` tinyint(1) NOT NULL,
  `user_subir` tinyint(1) NOT NULL,
  `user_crear_u` tinyint(1) NOT NULL,
  `user_crear_c` tinyint(1) NOT NULL,
  `user_crear_ct` tinyint(1) NOT NULL,
  `user_estado` tinyint(4) NOT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_monbre`, `user_mail`, `user_pass`, `user_tipo`, `user_cliente`, `user_permiso`, `user_buscar`, `user_subir`, `user_crear_u`, `user_crear_c`, `user_crear_ct`, `user_estado`, `user_timestamp`) VALUES
(1, 'Carlos perez', 'administrador@mail.com', 'administrador', 'Administrador', 1, 4, 1, 1, 1, 1, 1, 0, '2019-03-31 04:05:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `doc_cat` (`doc_cat`),
  ADD KEY `doc_cliente` (`doc_cliente`,`doc_usuario`),
  ADD KEY `doc_usuario` (`doc_usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`permisos_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_cliente` (`user_cliente`),
  ADD KEY `user_permiso` (`user_permiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permisos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`doc_cliente`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`doc_usuario`) REFERENCES `usuarios` (`user_id`),
  ADD CONSTRAINT `documentos_ibfk_3` FOREIGN KEY (`doc_cat`) REFERENCES `categoria` (`cat_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`user_permiso`) REFERENCES `permisos` (`permisos_id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`user_cliente`) REFERENCES `cliente` (`cliente_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
