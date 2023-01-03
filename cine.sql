-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2022 a las 11:18:54
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `username`, `password`, `correo`) VALUES
(2, 'Leo', 'zul', '123', 'lzcplay72@gmail.com'),
(3, 'Frey Robles', 'frey', '123', 'frey@gmail.com'),
(4, 'prueba2', 'prueba2', '123', 'prueba2@gmail.com'),
(5, 'usuario1', 'usuario1', '123', 'u@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id_clasificacion` int(11) NOT NULL,
  `nombre_clasificacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id_clasificacion`, `nombre_clasificacion`) VALUES
(1, 'TP'),
(2, '7'),
(3, '12'),
(4, '15'),
(5, '18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcion`
--

CREATE TABLE `funcion` (
  `codigo` varchar(50) NOT NULL,
  `fechayhora` datetime NOT NULL,
  `codigopelicula` varchar(30) NOT NULL,
  `codigosala` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `funcion`
--

INSERT INTO `funcion` (`codigo`, `fechayhora`, `codigopelicula`, `codigosala`) VALUES
('funcion1', '2022-10-20 22:26:00', 'Enanos1', 'sala1'),
('funcion2', '2022-10-21 04:17:00', 'batman01', 'salabasica'),
('Mañana', '2022-10-21 03:29:00', 'policias100', 'sala1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `nombre` varchar(30) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `id_clasificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`nombre`, `codigo`, `id_clasificacion`) VALUES
('Batman', 'batman01', 4),
('ENANOS', 'Enanos1', 2),
('Pinocho', 'pinocho1', 1),
('Policias', 'policias100', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `nombre` varchar(30) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `capacidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`nombre`, `codigo`, `capacidad`) VALUES
('SALA VIP', 'sala1', 40),
('Sala normal', 'sala2', 30),
('Sala basica', 'salabasica', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `uq_Funcion_codigo` (`codigo`),
  ADD KEY `fk_Funcion_codigopelicula` (`codigopelicula`),
  ADD KEY `fk_Funcion_codigosala` (`codigosala`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `uq_Pelicula_nombre` (`nombre`),
  ADD KEY `fk_Pelicula_clasificacion` (`id_clasificacion`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `uq_Sala_codigo` (`nombre`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD CONSTRAINT `fk_Funcion_codigopelicula` FOREIGN KEY (`codigopelicula`) REFERENCES `pelicula` (`codigo`),
  ADD CONSTRAINT `fk_Funcion_codigosala` FOREIGN KEY (`codigosala`) REFERENCES `sala` (`codigo`);

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `fk_Pelicula_clasificacion` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id_clasificacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
