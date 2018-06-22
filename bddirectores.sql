-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2018 a las 03:47:09
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bddirectores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE `director` (
  `idDirector` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `edad` int(11) NOT NULL,
  `productora` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `director`
--

INSERT INTO `director` (`idDirector`, `nombre`, `apellido`, `pais`, `edad`, `productora`) VALUES
(1, 'Christopher ', 'Nolan', 'Inglaterra', 47, 'Syncopy '),
(2, 'Sebastian', 'Lelio', 'Chile', 44, 'Fabula'),
(3, 'David', 'Fincher', 'EEUU', 55, 'Phoenix Pictures');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `idPelicula` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `duracion` int(11) NOT NULL,
  `idioma` varchar(45) NOT NULL,
  `estreno` int(11) NOT NULL,
  `Director_idDirector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`idPelicula`, `titulo`, `duracion`, `idioma`, `estreno`, `Director_idDirector`) VALUES
(1, 'Dunkirk ', 106, 'Ingles', 2017, 1),
(2, 'Interstellar', 169, 'Ingles', 2014, 1),
(3, 'The Dark Knight', 152, 'Ingles', 2008, 1),
(4, 'A Fantastic Woman', 104, 'EspaÃ±ol', 2017, 2),
(5, 'Zodiac', 158, 'Ingles', 2007, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`idDirector`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`idPelicula`,`Director_idDirector`),
  ADD KEY `fk_Pelicula_Director_idx` (`Director_idDirector`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `fk_Pelicula_Director` FOREIGN KEY (`Director_idDirector`) REFERENCES `director` (`idDirector`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
