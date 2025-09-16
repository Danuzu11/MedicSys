-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2025 a las 22:31:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medicsysdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliados`
--

CREATE TABLE `afiliados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `idUser` int(11) NOT NULL,
  `cedula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `afiliados`
--

INSERT INTO `afiliados` (`id`, `nombre`, `apellido`, `email`, `fecha_nacimiento`, `idUser`, `cedula`) VALUES
(1, 'augusto', 'virgoliniiii', 'davidalejandrp@gmail.com', '2023-10-19', 2, 'P-123456'),
(2, 'ramon', 'gonzales', 'davidalejandrp@gmail.com', '2023-10-19', 2, 'V-132456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dia_semana` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `idMedico` int(11) NOT NULL,
  `idafiliado` int(11) DEFAULT NULL,
  `bloque_hora` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `user_id`, `dia_semana`, `description`, `fecha`, `created`, `modified`, `idMedico`, `idafiliado`, `bloque_hora`, `status`) VALUES
(10, 2, 'Lunes', 'awewaewae', '2023-10-30', '2023-10-24 18:24:18', '2023-11-02 18:34:08', 32, NULL, 'bloque11', 'Fallida'),
(11, 2, 'Martes', '46456456456', '2023-10-31', '2023-10-30 17:06:43', '2023-10-30 17:06:43', 31, 1, 'bloque2', 'pendiente'),
(12, 2, 'Martes', '46546456', '2023-11-07', '2023-10-30 17:07:03', '2023-10-30 17:07:03', 31, 2, 'bloque2', 'pendiente'),
(13, 2, 'Miercoles', '46464', '2023-11-01', '2023-10-31 23:35:28', '2023-10-31 23:35:28', 31, 2, 'bloque2', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `especialidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `especialidad`) VALUES
(1, 'Cardiología'),
(2, 'Dermatología'),
(3, 'Pediatría'),
(4, 'Alergología'),
(5, 'Angiología y cirugía vascular'),
(6, 'Cirugía cardiotorácica'),
(7, 'Cirugía general'),
(8, 'Cirugía pediátrica'),
(9, 'Cirugía plástica'),
(10, 'Cirugía torácica'),
(11, 'Endocrinología'),
(12, 'Gastroenterología'),
(13, 'Ginecología y obstetricia'),
(14, 'Hematología'),
(15, 'Infectología'),
(16, 'Nefrología'),
(17, 'Neurocirugía'),
(18, 'Neurología'),
(19, 'Oftalmología'),
(20, 'Otorrinolaringología'),
(21, 'Ortopedia y traumatología'),
(22, 'Psiquiatría'),
(23, 'Radiología'),
(24, 'Reumatología'),
(25, 'Urología'),
(26, 'Anestesiología'),
(27, 'Medicina familiar'),
(28, 'Medicina interna'),
(29, 'Medicina intensiva'),
(30, 'Medicina nuclear'),
(31, 'Medicina del trabajo'),
(32, 'Medicina deportiva'),
(33, 'Medicina del sueño'),
(34, 'Medicina preventiva'),
(35, 'Medicina tropical'),
(36, 'Psicofarmacología'),
(37, 'Psicología médica'),
(38, 'Toxicología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `medicoid` int(11) NOT NULL,
  `dia_semana` varchar(255) NOT NULL,
  `hora` text NOT NULL,
  `created` datetime NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `medicoid`, `dia_semana`, `hora`, `created`, `estado`) VALUES
(24, 31, 'Lunes', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Disponible'),
(25, 31, 'Martes', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Disponible'),
(26, 31, 'Miercoles', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Disponible'),
(27, 31, 'Jueves', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Disponible'),
(28, 31, 'Viernes', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Disponible'),
(29, 31, 'Sabado', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Desactivado'),
(30, 31, 'Domingo', '{\"bloque1\":{\"hora_inicio\":\"8am\",\"hora_fin\":\"9am\",\"status\":\"true\"},\"bloque2\":{\"hora_inicio\":\"9am\",\"hora_fin\":\"10am\",\"status\":\"true\"},\"bloque3\":{\"hora_inicio\":\"10am\",\"hora_fin\":\"11am\",\"status\":\"true\"},\"bloque4\":{\"hora_inicio\":\"11am\",\"hora_fin\":\"12pm\",\"status\":\"true\"},\"bloque6\":{\"hora_inicio\":\"1pm\",\"hora_fin\":\"2pm\",\"status\":\"true\"},\"bloque7\":{\"hora_inicio\":\"2pm\",\"hora_fin\":\"3pm\",\"status\":\"true\"},\"bloque8\":{\"hora_inicio\":\"3pm\",\"hora_fin\":\"4pm\",\"status\":\"true\"},\"bloque9\":{\"hora_inicio\":\"4pm\",\"hora_fin\":\"5pm\",\"status\":\"true\"}}', '2023-10-24 18:19:01', 'Desactivado'),
(31, 32, 'Lunes', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Disponible'),
(32, 32, 'Martes', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Desactivado'),
(33, 32, 'Miercoles', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Desactivado'),
(34, 32, 'Jueves', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Desactivado'),
(35, 32, 'Viernes', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Desactivado'),
(36, 32, 'Sabado', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Desactivado'),
(37, 32, 'Domingo', '{\"bloque10\":{\"hora_inicio\":\"5pm\",\"hora_fin\":\"6pm\",\"status\":\"true\"},\"bloque11\":{\"hora_inicio\":\"6pm\",\"hora_fin\":\"7pm\",\"status\":\"true\"},\"bloque12\":{\"hora_inicio\":\"7pm\",\"hora_fin\":\"8pm\",\"status\":\"true\"},\"bloque13\":{\"hora_inicio\":\"8pm\",\"hora_fin\":\"9pm\",\"status\":\"true\"},\"bloque14\":{\"hora_inicio\":\"9pm\",\"hora_fin\":\"10pm\",\"status\":\"true\"},\"bloque15\":{\"hora_inicio\":\"10pm\",\"hora_fin\":\"11pm\",\"status\":\"true\"},\"bloque16\":{\"hora_inicio\":\"11pm\",\"hora_fin\":\"12am\",\"status\":\"true\"},\"bloque17\":{\"hora_inicio\":\"12am\",\"hora_fin\":\"1am\",\"status\":\"true\"},\"bloque18\":{\"hora_inicio\":\"1am\",\"hora_fin\":\"2am\",\"status\":\"true\"}}', '2023-10-24 18:20:51', 'Desactivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `medico_id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `horario` varchar(50) DEFAULT NULL,
  `nombre_doctor` varchar(255) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `codigo_doc` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`medico_id`, `descripcion`, `horario`, `nombre_doctor`, `especialidad_id`, `codigo_doc`, `status`) VALUES
(31, '464646', 'diurno', 'doctor1', 1, 'C0321', 'activo'),
(32, '5464654', 'nocturno', 'doctor2', 1, 'C999151', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'paciente'),
(3, 'carnicero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ultima_conexion` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `rol`, `created`, `modified`, `email`, `ultima_conexion`, `status`) VALUES
(1, 'adminPrincipal', '$2y$10$MzH6IqsazIwHiiT4BjRVgOhauAiZJDPND9Ire1iGBMJAGehYlvh82', 1, '2023-08-21 00:48:19', '2024-04-10 16:02:06', 'adminPrincipal@gmail.com', '04/10/24, 04:02 pm', 'activo'),
(2, 'client', '$2y$10$wRFe9i9bjSfDZTYaKLZEfuNIhTCz3FizX5n27/OKS4YCEk6/V4vse', 2, '2023-08-23 02:25:12', '2024-03-23 20:12:57', 'example23@gmail.com', '03/23/24, 08:12 pm', 'activo'),
(15, 'admin132', '$2y$10$0fWBj4uT6hwqLK7BkgBd6OEGLF1uQWW588jcdty35Az5qmJCdWIem', 1, '2023-10-19 16:42:57', '2023-10-19 17:07:58', 'davidalejandrp@gmail.com', '10/19/23, 05:07 pm', 'activo'),
(20, 'gerente', '$2y$10$upLphK8S0DpMOIz2UeqnPe/C5AD4h9izSGC3K1sdW4zuJJX4tPd/W', 1, '2024-04-10 15:52:49', '2024-04-10 15:52:49', 'davidalejandrp@gmail.com13213', '', 'activo'),
(21, 'cajero', '$2y$10$vmNlYsWAQCNkpiKwidl/D.gmYJnjPix8.IgJQN.gSH6LU.ZJj78si', 2, '2024-04-10 18:49:00', '2025-09-16 20:09:44', 'davidalejandrp@gmail.comqeasd', '09/16/25, 08:09 pm', 'activo'),
(22, 'carnicero', '$2y$10$AxfJDULKUsX2Evd9xbTAteiDpQz3u/DyIVukK72iLDfJD58F16McC', 3, '2024-04-10 18:50:48', '2024-04-10 18:50:48', 'davidalejandrp@gmail.comwqewqe', '', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliados`
--
ALTER TABLE `afiliados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_afiliado_users` (`idUser`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_key` (`user_id`),
  ADD KEY `fk_citas_afiliados` (`idafiliado`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicoid` (`medicoid`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`medico_id`),
  ADD KEY `fk_especialidad_id` (`especialidad_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliados`
--
ALTER TABLE `afiliados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliados`
--
ALTER TABLE `afiliados`
  ADD CONSTRAINT `fk_afiliado_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_citas_afiliados` FOREIGN KEY (`idafiliado`) REFERENCES `afiliados` (`id`),
  ADD CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`medicoid`) REFERENCES `medicos` (`medico_id`);

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `fk_especialidad_id` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
