-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-12-2023 a las 13:42:58
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chatbot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatbot`
--

DROP TABLE IF EXISTS `chatbot`;
CREATE TABLE IF NOT EXISTS `chatbot` (
  `id` int NOT NULL AUTO_INCREMENT,
  `queries` text NOT NULL,
  `replies` text NOT NULL,
  `suggestions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_usos`
--

DROP TABLE IF EXISTS `chat_usos`;
CREATE TABLE IF NOT EXISTS `chat_usos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruta_id` int NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ruta_id` (`ruta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `chat_usos`
--

INSERT INTO `chat_usos` (`id`, `ruta_id`, `fecha`) VALUES
(1, 20, '2023-12-19 01:13:27'),
(2, 20, '2023-12-19 01:19:49'),
(3, 20, '2023-12-19 02:23:17'),
(4, 21, '2023-12-19 02:23:30'),
(5, 21, '2023-12-19 02:23:52'),
(6, 21, '2023-12-19 02:25:51'),
(7, 21, '2023-12-19 02:50:53'),
(8, 21, '2023-12-19 03:05:12'),
(9, 21, '2023-12-19 03:13:07'),
(10, 21, '2023-12-19 03:15:25'),
(11, 21, '2023-12-19 03:17:43'),
(12, 21, '2023-12-19 03:19:33'),
(13, 21, '2023-12-19 03:20:43'),
(14, 21, '2023-12-19 03:26:31'),
(15, 21, '2023-12-19 03:41:30'),
(16, 21, '2023-12-19 04:10:09'),
(17, 21, '2023-12-19 04:19:45'),
(18, 21, '2023-12-19 04:28:13'),
(19, 21, '2023-12-19 05:07:20'),
(20, 22, '2023-12-19 05:07:42'),
(21, 23, '2023-12-19 05:07:44'),
(22, 21, '2023-12-19 05:11:52'),
(23, 21, '2023-12-19 05:12:20'),
(24, 21, '2023-12-19 05:12:46'),
(25, 21, '2023-12-19 05:36:58'),
(26, 23, '2023-12-19 05:41:52'),
(27, 21, '2023-12-19 06:02:41'),
(28, 21, '2023-12-19 06:05:25'),
(29, 20, '2023-12-19 06:09:19'),
(30, 22, '2023-12-19 06:09:23'),
(31, 21, '2023-12-19 06:09:32'),
(32, 22, '2023-12-19 06:10:28'),
(33, 22, '2023-12-19 06:10:36'),
(34, 21, '2023-12-19 06:25:18'),
(35, 22, '2023-12-19 06:27:20'),
(36, 22, '2023-12-19 06:28:30'),
(37, 21, '2023-12-19 06:31:06'),
(38, 22, '2023-12-19 06:32:04'),
(39, 21, '2023-12-19 06:34:12'),
(40, 22, '2023-12-19 06:36:44'),
(41, 21, '2023-12-19 06:37:20'),
(42, 22, '2023-12-19 06:40:22'),
(43, 20, '2023-12-19 06:47:42'),
(44, 22, '2023-12-19 06:48:03'),
(45, 22, '2023-12-19 06:49:22'),
(46, 21, '2023-12-19 06:53:35'),
(47, 22, '2023-12-19 07:08:31'),
(48, 22, '2023-12-19 07:12:12'),
(49, 21, '2023-12-19 07:16:03'),
(50, 22, '2023-12-19 07:16:40'),
(51, 22, '2023-12-19 11:51:10'),
(52, 22, '2023-12-19 11:54:11'),
(53, 22, '2023-12-19 12:02:59'),
(54, 22, '2023-12-19 12:11:29'),
(55, 22, '2023-12-19 12:11:51'),
(56, 22, '2023-12-19 12:14:38'),
(57, 22, '2023-12-19 12:17:19'),
(58, 22, '2023-12-19 12:19:02'),
(59, 22, '2023-12-19 12:19:28'),
(60, 22, '2023-12-19 12:19:44'),
(61, 22, '2023-12-19 12:20:16'),
(62, 22, '2023-12-19 12:21:33'),
(63, 22, '2023-12-19 12:22:03'),
(64, 22, '2023-12-19 12:24:56'),
(65, 22, '2023-12-19 12:26:19'),
(66, 22, '2023-12-19 12:28:10'),
(67, 22, '2023-12-19 12:29:38'),
(68, 22, '2023-12-19 12:31:52'),
(69, 22, '2023-12-19 12:33:58'),
(70, 22, '2023-12-19 12:34:33'),
(71, 22, '2023-12-19 12:35:02'),
(72, 22, '2023-12-19 12:35:46'),
(73, 22, '2023-12-19 12:36:01'),
(74, 22, '2023-12-19 12:39:55'),
(75, 21, '2023-12-19 12:40:15'),
(76, 22, '2023-12-19 12:40:19'),
(77, 22, '2023-12-19 12:42:48'),
(78, 22, '2023-12-19 12:47:06'),
(79, 22, '2023-12-19 12:52:05'),
(80, 22, '2023-12-19 12:54:28'),
(81, 22, '2023-12-19 12:57:35'),
(82, 22, '2023-12-19 12:59:24'),
(83, 22, '2023-12-19 12:59:39'),
(84, 21, '2023-12-19 13:00:15'),
(85, 22, '2023-12-19 13:01:09'),
(86, 21, '2023-12-19 13:02:12'),
(87, 22, '2023-12-19 13:02:47'),
(88, 22, '2023-12-19 13:12:04'),
(89, 22, '2023-12-19 13:22:01'),
(90, 22, '2023-12-19 13:25:00'),
(91, 22, '2023-12-19 13:26:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

DROP TABLE IF EXISTS `rutas`;
CREATE TABLE IF NOT EXISTS `rutas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruta` varchar(255) NOT NULL,
  `opcion` varchar(255) NOT NULL,
  `respuesta` text NOT NULL,
  `opcion_count` int NOT NULL DEFAULT '0',
  `uso_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `ruta`, `opcion`, `respuesta`, `opcion_count`, `uso_count`) VALUES
(20, '¿Deseas Ubicarnos?', 'Mira en que dirección nos encontramos.', 'link1234', 0, 0),
(21, '¿Cómo ubico mi Documento? ', 'Para encontrar tu documento, necesitas el número de expediente y su año. Ambos son muy importantes. Si no estás seguro de cuál es tu número de expediente o el año, revisa la información que te dieron o pregunta a alguien que pueda ayudarte.', 'https://xxxxxxx', 0, 0),
(22, '¿Cómo envío un Documento?', 'Regístrate si es la primera vez que ingresas. Una vez en el portal seleccione la opción de nueva solicitud y llene los campos con los datos que se le indique.', 'https://xxxxxxx', 0, 0),
(23, 'Información de Oficina / Contáctanos', 'Mira nuestros locales, en los cuales recibirás la atención que requieras y nuestro numero de contacto. ', 'link785758', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`) VALUES
(1, 'admin', 'xxxxxxx');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat_usos`
--
ALTER TABLE `chat_usos`
  ADD CONSTRAINT `chat_usos_ibfk_1` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
