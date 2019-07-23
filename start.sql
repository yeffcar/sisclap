-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2017 a las 07:12:06
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `start`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `tipo` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Categorias del sistema';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datauserstorage`
--

CREATE TABLE `datauserstorage` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `_key` varchar(100) NOT NULL,
  `_value` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datauserstorage`
--

INSERT INTO `datauserstorage` (`id`, `id_user`, `_key`, `_value`) VALUES
(43, 18, 'nombre', 'Gervis'),
(44, 18, 'apellido', 'Mora'),
(45, 18, 'direccion', 'Mara'),
(46, 18, 'telefono', '+584141672173'),
(47, 18, 'create by', 'gerber'),
(112, 18, 'cedula', '20752761'),
(165, 18, 'idcreateby', '18'),
(219, 38, 'nombre', 'Yefferson'),
(220, 38, 'apellido', 'Perez'),
(221, 38, 'direccion', 'Alto Viento 2'),
(222, 38, 'telefono', '+58 416 76 524 43'),
(223, 38, 'cedula', '23456789'),
(224, 38, 'create by', 'yeff'),
(225, 38, 'idcreateby', '18'),
(226, 39, 'nombre', 'Yuleina'),
(227, 39, 'apellido', 'Duran'),
(228, 39, 'direccion', 'Moja'),
(229, 39, 'telefono', '+58 412345126 7'),
(230, 39, 'cedula', '24763847'),
(231, 39, 'create by', 'gerber'),
(232, 39, 'idcreateby', '18'),
(233, 40, 'nombre', 'Pedro'),
(234, 40, 'apellido', 'Hernandez'),
(235, 40, 'direccion', 'Maracaibo'),
(236, 40, 'telefono', '+58 625217237373'),
(237, 40, 'cedula', '243651722'),
(238, 40, 'create by', 'yeff'),
(239, 40, 'idcreateby', '38'),
(240, 41, 'nombre', 'Juan'),
(241, 41, 'apellido', 'Garcia'),
(242, 41, 'direccion', 'Urb. Nueva Miranda'),
(243, 41, 'telefono', '+58 414 28374 38'),
(244, 41, 'cedula', '22847361'),
(245, 41, 'create by', 'yeff'),
(246, 41, 'idcreateby', '38'),
(247, 42, 'nombre', 'Pamela'),
(248, 42, 'apellido', 'Hernandez'),
(249, 42, 'direccion', 'El Mojan Av Principal'),
(250, 42, 'telefono', '0412512521'),
(251, 42, 'cedula', '223457182'),
(252, 42, 'create by', 'yule'),
(253, 42, 'idcreateby', '39'),
(254, 43, 'nombre', 'Isbelis'),
(255, 43, 'apellido', 'Rámirez'),
(256, 43, 'direccion', 'Pueblo Nuevo'),
(257, 43, 'telefono', '04246429023'),
(258, 43, 'cedula', '18122694'),
(259, 43, 'create by', 'yeff'),
(260, 43, 'idcreateby', '38'),
(261, 18, 'avatar', '18_thumb.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_clap`
--

CREATE TABLE `datos_clap` (
  `id` int(11) NOT NULL,
  `codigo` varchar(75) NOT NULL,
  `nombre` varchar(175) NOT NULL,
  `n_consejosc` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_clap`
--

INSERT INTO `datos_clap` (`id`, `codigo`, `nombre`, `n_consejosc`, `id_responsable`, `fecha`, `status`) VALUES
(15, '#213452', 'Alto Viento 2', 1, 38, '2017-11-25 20:59:29', 1),
(16, '#23234234', 'Mojansito', 3, 39, '2017-11-25 21:12:30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_lideres`
--

CREATE TABLE `datos_lideres` (
  `id` int(11) NOT NULL,
  `id_lider` int(11) NOT NULL,
  `id_clap` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_lideres`
--

INSERT INTO `datos_lideres` (`id`, `id_lider`, `id_clap`, `status`) VALUES
(9, 40, 15, 1),
(10, 41, 15, 1),
(11, 42, 16, 1),
(12, 43, 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_planilla`
--

CREATE TABLE `datos_planilla` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_clap` int(11) NOT NULL,
  `id_jefecalle` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefe_hogar`
--

CREATE TABLE `jefe_hogar` (
  `id` int(11) NOT NULL,
  `cedula` varchar(30) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `apellido` varchar(75) NOT NULL,
  `email` varchar(125) NOT NULL,
  `telefono` varchar(75) NOT NULL,
  `n_miembros` int(11) NOT NULL,
  `direccion` varchar(175) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `id_lider` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Almacena los Jefes de Hogar de cada planilla';

--
-- Volcado de datos para la tabla `jefe_hogar`
--

INSERT INTO `jefe_hogar` (`id`, `cedula`, `nombre`, `apellido`, `email`, `telefono`, `n_miembros`, `direccion`, `status`, `id_lider`) VALUES
(5, '2634429', 'ymalay', 'garcia', 'ymalay.garcia@outlook.com', '04262126864', 4, 'municipio miranda. parroquia altagracia. sector las playitas', 0, 40),
(6, '2208482', 'yefferson', 'cardenas', 'yeffcar@gmail.com', '04241601369', 5, 'Los puertos', 0, 40),
(7, '12468394', 'Eslinda', 'Diaz', 'esldiaz@gmail.com', '04164605737', 8, 'Los puertos', 0, 40),
(8, '10904876', 'Margarita', 'Mora', 'mmora@yahoo.com', '+58 426 7836452', 4, 'Haticos del Norte', 0, 41),
(9, '23424553', 'Maria', 'Perez', 'mperez@gmail.com', '026187372632', 5, 'El Mojan sector tierra seca 2', 0, 42),
(10, '19075393', 'Leonardo', 'Sanchez', 'ingleonardosanchez@gmail.com', '04146573812', 5, 'Av. Principal, Sector Pueblo Nuevo', 0, 43),
(11, '22084982', 'Yefferson', 'Cardenas', 'yeffcar@gmail.com', '04241601369', 5, 'Los Puertos de Altagracia', 0, 43),
(12, '9777114', 'Tamara', 'Cardenas', 'tamarach.c@gmail.com', '04146758723', 6, 'Amparo', 0, 43),
(13, '8505931', 'Irasema', 'Cardenas', 'sema.cardenas@hotmail.com', '04141646170', 5, 'La Curva de Molina', 0, 43),
(14, '8410062', 'Carmela ', 'Flores', 'Carmelaflores@hotmail.com', '04268886622', 2, 'Guarico', 0, 43),
(15, '124638394', 'Eslinda', 'Diaz', 'esldiazf@gmail.com', '04164605737', 3, 'Pueblo Nuevo', 0, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_hogar`
--

CREATE TABLE `planilla_hogar` (
  `id` int(11) NOT NULL,
  `id_jefehogar` int(11) NOT NULL,
  `id_planilla` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relations`
--

CREATE TABLE `relations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tablename` tinytext NOT NULL,
  `id_row` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `action` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relations`
--

INSERT INTO `relations` (`id`, `id_user`, `tablename`, `id_row`, `date`, `action`) VALUES
(38, 18, 'user', 38, '2017-11-25 20:59:29', 'crear'),
(39, 18, 'datos_clap', 15, '2017-11-25 20:59:29', 'crear'),
(40, 18, 'user', 39, '2017-11-25 21:12:30', 'crear'),
(41, 18, 'datos_clap', 16, '2017-11-25 21:12:31', 'crear'),
(42, 38, 'user', 40, '2017-11-25 22:03:57', 'crear'),
(46, 40, 'jefe_hogar', 5, '2017-11-26 00:53:54', 'crear'),
(47, 40, 'jefe_hogar', 6, '2017-11-26 01:14:37', 'crear'),
(48, 40, 'jefe_hogar', 7, '2017-11-26 01:22:24', 'crear'),
(49, 38, 'user', 41, '2017-11-26 14:43:09', 'crear'),
(50, 41, 'jefe_hogar', 8, '2017-11-26 15:48:18', 'crear'),
(51, 39, 'user', 42, '2017-11-26 18:58:35', 'crear'),
(52, 42, 'jefe_hogar', 9, '2017-11-26 19:02:11', 'crear'),
(53, 38, 'user', 43, '2017-11-26 22:37:18', 'crear'),
(54, 43, 'jefe_hogar', 10, '2017-11-26 22:38:43', 'crear'),
(55, 43, 'jefe_hogar', 11, '2017-11-26 22:46:18', 'crear'),
(56, 43, 'jefe_hogar', 12, '2017-11-26 22:46:58', 'crear'),
(57, 43, 'jefe_hogar', 13, '2017-11-26 22:47:51', 'crear'),
(58, 43, 'jefe_hogar', 14, '2017-11-26 22:48:58', 'crear'),
(59, 43, 'jefe_hogar', 15, '2017-11-26 22:49:43', 'crear');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion_clap`
--

CREATE TABLE `ubicacion_clap` (
  `id` int(11) NOT NULL,
  `id_clap` int(11) NOT NULL,
  `_key` varchar(75) NOT NULL,
  `_value` varchar(175) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla con campos personalizables para las ubicaciones-calps';

--
-- Volcado de datos para la tabla `ubicacion_clap`
--

INSERT INTO `ubicacion_clap` (`id`, `id_clap`, `_key`, `_value`, `status`) VALUES
(89, 15, 'estado', 'zulia', 1),
(90, 15, 'municipio', 'Miranda', 1),
(91, 15, 'parroquia', 'Altagracia', 1),
(92, 15, 'direccion', 'Alto Viento II', 1),
(93, 16, 'estado', 'Zulia', 1),
(94, 16, 'municipio', 'Mojan', 1),
(95, 16, 'parroquia', 'Santa Cruz', 1),
(96, 16, 'direccion', 'El mojan Av. principal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL DEFAULT '1234',
  `email` varchar(255) NOT NULL,
  `lastseen` datetime NOT NULL,
  `usergroup` int(11) NOT NULL DEFAULT '3',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Usuarios del Sistema';

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `lastseen`, `usergroup`, `status`) VALUES
(18, 'gerber', '1234', 'gerber@gmail.com', '2016-09-03 03:22:31', 1, 1),
(38, 'yeff', '1234', 'yeff@gmail.com', '2017-11-25 20:59:29', 2, 1),
(39, 'yule', '1234', 'yule@gmail.com', '2017-11-25 21:12:30', 2, 1),
(40, 'pedro1', '1234', 'pedro@gmail.com', '2017-11-25 22:03:57', 3, 1),
(41, 'juan', '1234', 'juan@gmail.com', '2017-11-26 14:43:08', 3, 1),
(42, 'pam', '1234', 'pam1@cantv.net', '2017-11-26 18:58:35', 3, 1),
(43, 'isbelisram', '1234', 'inv.isbelisram@gmail.com', '2017-11-26 22:37:18', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdatapermisions`
--

CREATE TABLE `userdatapermisions` (
  `id` int(11) NOT NULL,
  `id_usergroup` int(11) NOT NULL,
  `permision` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usergroup`
--

CREATE TABLE `usergroup` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `level` int(11) NOT NULL,
  `description` tinytext NOT NULL,
  `createdate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`, `level`, `description`, `createdate`, `status`) VALUES
(1, 'Administrador', 1, 'All permisions allowed', '2016-08-27 09:22:22', 1),
(2, 'Responsable de Clap', 2, 'All configurations allowed', '2016-08-27 09:22:22', 1),
(3, 'Líder de calle', 3, 'Not delete permisions allowed', '2016-08-27 08:32:49', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datauserstorage`
--
ALTER TABLE `datauserstorage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_user`);

--
-- Indices de la tabla `datos_clap`
--
ALTER TABLE `datos_clap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_responsable` (`id_responsable`),
  ADD KEY `f_user` (`id_responsable`);

--
-- Indices de la tabla `datos_lideres`
--
ALTER TABLE `datos_lideres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_lider` (`id_lider`),
  ADD KEY `f_user` (`id_lider`),
  ADD KEY `f_datos_clap` (`id_clap`);

--
-- Indices de la tabla `datos_planilla`
--
ALTER TABLE `datos_planilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_datos_clap` (`id_clap`),
  ADD KEY `f_user` (`id_jefecalle`);

--
-- Indices de la tabla `jefe_hogar`
--
ALTER TABLE `jefe_hogar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_cedula` (`cedula`),
  ADD KEY `id_lider` (`id_lider`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_user`);

--
-- Indices de la tabla `planilla_hogar`
--
ALTER TABLE `planilla_hogar`
  ADD KEY `f_jefe_hogar` (`id_jefehogar`),
  ADD KEY `f_datos_planilla` (`id_planilla`);

--
-- Indices de la tabla `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion_clap`
--
ALTER TABLE `ubicacion_clap`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usergroup` (`usergroup`);

--
-- Indices de la tabla `userdatapermisions`
--
ALTER TABLE `userdatapermisions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `datauserstorage`
--
ALTER TABLE `datauserstorage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;
--
-- AUTO_INCREMENT de la tabla `datos_clap`
--
ALTER TABLE `datos_clap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `datos_lideres`
--
ALTER TABLE `datos_lideres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `datos_planilla`
--
ALTER TABLE `datos_planilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jefe_hogar`
--
ALTER TABLE `jefe_hogar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `relations`
--
ALTER TABLE `relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT de la tabla `ubicacion_clap`
--
ALTER TABLE `ubicacion_clap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `userdatapermisions`
--
ALTER TABLE `userdatapermisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jefe_hogar`
--
ALTER TABLE `jefe_hogar`
  ADD CONSTRAINT `jefe_hogar_ibfk_1` FOREIGN KEY (`id_lider`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`usergroup`) REFERENCES `usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
