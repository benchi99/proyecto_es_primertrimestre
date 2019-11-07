-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2019 a las 19:06:14
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_1trimestre`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pryt1_tarea`
--

CREATE TABLE `pryt1_tarea` (
  `tsk_id` int(11) NOT NULL,
  `tsk_descripcion` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsk_poblacion` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsk_cp` int(11) DEFAULT NULL,
  `tsk_provincia` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsk_persona_contacto` int(11) DEFAULT NULL,
  `tsk_estado` int(11) DEFAULT NULL,
  `tsk_fecha_creacion` datetime DEFAULT NULL,
  `tsk_persona_encargada` int(11) DEFAULT NULL,
  `tsk_fecha_realizacion` datetime DEFAULT NULL,
  `tsk_anotacion_anterior` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsk_anotacion_posterior` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de tareas';

--
-- Volcado de datos para la tabla `pryt1_tarea`
--

INSERT INTO `pryt1_tarea` (`tsk_id`, `tsk_descripcion`, `tsk_poblacion`, `tsk_cp`, `tsk_provincia`, `tsk_persona_contacto`, `tsk_estado`, `tsk_fecha_creacion`, `tsk_persona_encargada`, `tsk_fecha_realizacion`, `tsk_anotacion_anterior`, `tsk_anotacion_posterior`) VALUES
(1, 'Cortar el Cesped', 'Valverde del Camino', 21600, 'Huelva', 1, 0, '2019-10-29 11:06:38', 2, '2019-10-29 12:06:57', 'Anotacion anterior 1', 'Anotacion posterior 1'),
(2, 'Ir a por EL PAN', 'La Palma del Condado', 21700, 'Huelva', 2, 0, '2019-11-29 12:09:42', 2, '2019-12-25 12:09:58', 'Anotacion anterior 2 ', 'Anotacion posterior 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pryt1_usuarios`
--

CREATE TABLE `pryt1_usuarios` (
  `usr_id` int(11) NOT NULL,
  `usr_nombreusu` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_password` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_nombre` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_apellidos` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_tlf` decimal(10,0) DEFAULT NULL,
  `usr_email` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_direccion` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usr_rol` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de usuarios';

--
-- Volcado de datos para la tabla `pryt1_usuarios`
--

INSERT INTO `pryt1_usuarios` (`usr_id`, `usr_nombreusu`, `usr_password`, `usr_nombre`, `usr_apellidos`, `usr_tlf`, `usr_email`, `usr_direccion`, `usr_rol`) VALUES
(1, 'ruben', ' 1234', ' Rubén', 'Bermejo Romero', '696699669', 'elbencho@rubenbermejoromero.xyz', 'Calle de mi mamá', 1),
(2, 'daniel', '4321', 'Daniel', 'Cepeda Marín', '420420420', 'eldano@ricogluten.com', 'Calle de su casa', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pryt1_tarea`
--
ALTER TABLE `pryt1_tarea`
  ADD PRIMARY KEY (`tsk_id`),
  ADD KEY `pryt1_tarea_pryt1_usuarios_usr_id_fk` (`tsk_persona_contacto`),
  ADD KEY `pryt1_tarea_pryt1_usuarios_usr_id_fk_2` (`tsk_persona_encargada`);

--
-- Indices de la tabla `pryt1_usuarios`
--
ALTER TABLE `pryt1_usuarios`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pryt1_tarea`
--
ALTER TABLE `pryt1_tarea`
  MODIFY `tsk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pryt1_usuarios`
--
ALTER TABLE `pryt1_usuarios`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pryt1_tarea`
--
ALTER TABLE `pryt1_tarea`
  ADD CONSTRAINT `pryt1_tarea_pryt1_usuarios_usr_id_fk` FOREIGN KEY (`tsk_persona_contacto`) REFERENCES `pryt1_usuarios` (`usr_id`),
  ADD CONSTRAINT `pryt1_tarea_pryt1_usuarios_usr_id_fk_2` FOREIGN KEY (`tsk_persona_encargada`) REFERENCES `pryt1_usuarios` (`usr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
