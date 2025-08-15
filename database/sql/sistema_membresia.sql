-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-07-2025 a las 05:31:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_membresia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_1574bddb75c78a6fd2251d61e2993b5146201319', 'i:1;', 1752009215),
('laravel_cache_1574bddb75c78a6fd2251d61e2993b5146201319:timer', 'i:1752009215;', 1752009215),
('laravel_cache_7b52009b64fd0a2a49e6d8a939753077792b0554', 'i:1;', 1751599094),
('laravel_cache_7b52009b64fd0a2a49e6d8a939753077792b0554:timer', 'i:1751599094;', 1751599094),
('laravel_cache_f1abd670358e036c31296e66b3b66c382ac00812', 'i:1;', 1751649515),
('laravel_cache_f1abd670358e036c31296e66b3b66c382ac00812:timer', 'i:1751649515;', 1751649515);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_movimientos`
--

CREATE TABLE `caja_movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `concepto` varchar(255) NOT NULL,
  `forma_pago` enum('efectivo','tarjeta','transferencia','online','otro') NOT NULL,
  `estado_pago` enum('pendiente','confirmado','rechazado') NOT NULL DEFAULT 'pendiente',
  `confirmado_por` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_confirmacion` timestamp NULL DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `caja_movimientos`
--

INSERT INTO `caja_movimientos` (`id`, `member_id`, `user_id`, `monto`, `concepto`, `forma_pago`, `estado_pago`, `confirmado_por`, `fecha_confirmacion`, `referencia`, `created_at`, `updated_at`, `estado`) VALUES
(1, 9, 1, 3000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-05-31 07:58:30', '2025-05-31 10:10:48', 'confirmado'),
(2, 10, 1, 2000.00, 'Pago de membresía', 'tarjeta', 'pendiente', NULL, NULL, NULL, '2025-05-31 08:40:34', '2025-05-31 10:08:56', 'confirmado'),
(3, 11, 1, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-05-31 09:30:14', '2025-05-31 10:06:47', 'confirmado'),
(4, 12, 1, 2000.00, 'Pago de membresía', 'online', 'pendiente', 1, '2025-05-31 10:18:27', NULL, '2025-05-31 10:17:59', '2025-05-31 10:18:27', 'confirmado'),
(5, 13, 1, 2000.00, 'Pago de membresía', 'tarjeta', 'pendiente', 1, '2025-06-01 08:00:52', 'R10015', '2025-06-01 05:44:42', '2025-06-01 08:00:52', 'confirmado'),
(6, 14, 1, 2000.00, 'Pago de membresía', 'tarjeta', 'pendiente', NULL, '2025-06-01 05:58:31', 'R10015', '2025-06-01 05:53:21', '2025-06-01 05:58:31', 'confirmado'),
(7, 15, 1, 3000.00, 'Pago de membresía', 'transferencia', 'pendiente', 1, '2025-06-01 06:07:07', 'EF-020707', '2025-06-01 06:06:48', '2025-06-01 06:07:07', 'confirmado'),
(8, 16, 1, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', 1, '2025-06-01 06:13:21', 'EF-021321', '2025-06-01 06:13:09', '2025-06-01 06:13:21', 'confirmado'),
(9, 17, 1, 2000.00, 'Pago de membresía', 'tarjeta', 'pendiente', 1, '2025-06-01 06:15:05', 'R10015', '2025-06-01 06:14:44', '2025-06-01 06:15:05', 'confirmado'),
(13, 21, 1, 2000.00, 'Pago de membresía', 'online', 'pendiente', NULL, NULL, NULL, '2025-06-03 22:27:10', '2025-06-03 22:27:10', 'pendiente'),
(14, 22, 1, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-06-10 22:18:45', '2025-06-10 22:18:45', 'pendiente'),
(15, 23, 1, 2000.00, 'Pago de membresía', 'online', 'pendiente', NULL, NULL, NULL, '2025-06-10 23:17:31', '2025-06-10 23:17:31', 'pendiente'),
(16, 24, 1, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-06-10 23:27:42', '2025-06-10 23:27:42', 'pendiente'),
(17, 25, 1, 5000.00, 'Pago de membresía', 'online', 'pendiente', NULL, NULL, NULL, '2025-06-11 00:32:44', '2025-06-11 00:32:44', 'pendiente'),
(18, 26, 1, 5000.00, 'Pago de membresía', 'online', 'pendiente', NULL, NULL, NULL, '2025-06-11 01:20:13', '2025-06-11 01:20:13', 'pendiente'),
(20, 26, 1, 300.00, 'Reposición de carnet', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-03 09:24:07', '2025-07-03 09:24:07', 'pendiente'),
(21, 29, 8, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 05:35:13', '2025-07-04 05:35:13', 'pendiente'),
(22, 31, 8, 3000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 05:55:21', '2025-07-04 05:55:21', 'pendiente'),
(23, 32, 8, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 05:56:56', '2025-07-04 05:56:56', 'pendiente'),
(24, 33, 8, 2000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 06:04:01', '2025-07-04 06:04:01', 'pendiente'),
(25, 34, 8, 3000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 06:12:49', '2025-07-04 06:12:49', 'pendiente'),
(26, 35, 8, 5000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 06:34:40', '2025-07-04 06:34:40', 'pendiente'),
(27, 36, 8, 2000.00, 'Pago de membresía', 'online', 'pendiente', NULL, NULL, NULL, '2025-07-04 06:38:13', '2025-07-04 06:38:13', 'pendiente'),
(28, 37, 8, 3000.00, 'Pago de membresía', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 07:13:07', '2025-07-04 07:13:07', 'pendiente'),
(29, 26, 10, 0.00, 'Reposición de carnet', 'efectivo', 'pendiente', NULL, NULL, NULL, '2025-07-04 21:59:19', '2025-07-04 21:59:19', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_aplicacion` varchar(255) NOT NULL DEFAULT 'global',
  `porcentaje` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `discounts`
--

INSERT INTO `discounts` (`id`, `nombre`, `tipo_aplicacion`, `porcentaje`, `created_at`, `updated_at`) VALUES
(1, 'NINGUNO', 'GLOBAL', 0.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39'),
(2, 'EMPLEADOS COOPBUENO', 'SOCIO', 20.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39'),
(3, 'DIRECTIVO COOPBUENO', 'SOCIO', 20.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39'),
(4, 'DIRECTIVO CLUB VISTA A LAS MONTAÑAS', 'SOCIO', 20.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39'),
(5, 'EMPLEADO CLUB VISTA A LAS MONTAÑAS', 'SOCIO', 20.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39'),
(6, 'DELEGADOS ASAMBLEA GENERAL COOPBUENO', 'SOCIO', 20.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39'),
(7, 'EMPLEADO O DIRECTIVO FUNDACIÓN COOPBUENO', 'SOCIO', 20.00, '2025-05-30 06:11:39', '2025-05-30 06:11:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exportaciones`
--

CREATE TABLE `exportaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exportaciones`
--

INSERT INTO `exportaciones` (`id`, `tipo`, `fecha_inicio`, `fecha_fin`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'socios', NULL, NULL, 1, '2025-05-22 08:16:28', '2025-05-22 08:16:28'),
(2, 'socios', NULL, NULL, 1, '2025-05-23 01:29:00', '2025-05-23 01:29:00'),
(3, 'socios', NULL, NULL, 1, '2025-05-23 01:57:13', '2025-05-23 01:57:13'),
(4, 'socios', NULL, NULL, 1, '2025-05-30 05:56:03', '2025-05-30 05:56:03'),
(5, 'socios', NULL, NULL, 1, '2025-06-10 18:10:12', '2025-06-10 18:10:12'),
(6, 'socios', NULL, NULL, 1, '2025-06-11 01:48:01', '2025-06-11 01:48:01'),
(7, 'socios', NULL, NULL, 1, '2025-07-09 00:58:28', '2025-07-09 00:58:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacions`
--

CREATE TABLE `habitacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `capacidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `es_compartida` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `habitacions`
--

INSERT INTO `habitacions` (`id`, `nombre`, `descripcion`, `capacidad`, `precio`, `imagen`, `estado`, `created_at`, `updated_at`, `es_compartida`) VALUES
(2, 'Habitacion 1', 'dasdasdadasdad', 10, 1000.00, 'imagenes/habitaciones/1752457353.png', 1, '2025-07-09 08:48:12', '2025-07-14 05:42:33', 0),
(3, 'Habitacion 2', 'Villa Grande', 5, 500.00, 'imagenes/habitaciones/1752036961.png', 1, '2025-07-09 08:56:01', '2025-07-11 03:57:30', 0),
(4, 'Habitacion 3', 'Villa Presidencial', 15, 5000.00, 'imagenes/habitaciones/1752190681.png', 1, '2025-07-11 03:38:01', '2025-07-11 03:38:18', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_imagens`
--

CREATE TABLE `habitacion_imagens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `habitacion_id` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `habitacion_imagens`
--

INSERT INTO `habitacion_imagens` (`id`, `habitacion_id`, `ruta`, `created_at`, `updated_at`) VALUES
(10, 2, 'imagenes/habitaciones/1752458680_PrVmKnHF.jpg', '2025-07-14 06:04:40', '2025-07-14 06:04:40'),
(13, 2, 'imagenes/habitaciones/1752460689_CmgM6sre.png', '2025-07-14 06:38:09', '2025-07-14 06:38:09'),
(15, 2, 'imagenes/habitaciones/1752460815_x1jM4wmP.png', '2025-07-14 06:40:15', '2025-07-14 06:40:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hero_settings`
--

CREATE TABLE `hero_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `boton_texto` varchar(255) DEFAULT NULL,
  `boton_url` varchar(255) DEFAULT NULL,
  `mostrar_boton` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hero_settings`
--

INSERT INTO `hero_settings` (`id`, `titulo`, `subtitulo`, `imagen`, `boton_texto`, `boton_url`, `mostrar_boton`, `created_at`, `updated_at`) VALUES
(2, 'Bienvenido al Club Vista a las Montañas', 'Disfruta la naturaleza, la tranquilidad y la conexión con lo esencial', 'MONTANAS.png', 'Hazte Miembro', '#registro', 1, '2025-07-15 03:43:32', '2025-07-15 03:43:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"da0328ef-84aa-4571-abee-c3e7ce2241cc\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:29;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:29;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"c45f6575-c85b-410a-a274-2597e0c538c0\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751592913, 1751592913),
(2, 'default', '{\"uuid\":\"9797d9bb-ce3a-401a-ab9f-3ae2e763c211\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:31;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:31;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"e9963de4-eeec-4079-ab49-ba91fc23bb16\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751594121, 1751594121),
(3, 'default', '{\"uuid\":\"a0fed20d-bbc0-4ddb-8de7-bb660f04e1e7\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:32;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:32;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"ab626901-7c9b-4e94-a127-66b7d43aeb40\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751594216, 1751594216),
(4, 'default', '{\"uuid\":\"c91d430b-4393-4ad2-b110-f367d46fa32e\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:33;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"ebf0e4c6-294e-44eb-a8f1-8dca4694875b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751594641, 1751594641),
(5, 'default', '{\"uuid\":\"63c1b162-5b81-4a7b-a6ed-d0ad56ca83c3\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:34;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:34;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"c6c38216-36d8-4368-8fc1-9f43cdb816eb\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751595169, 1751595169),
(6, 'default', '{\"uuid\":\"8228c3e5-6a29-466b-a9bb-5eb959852393\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:35;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:35;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"303e3c7c-4db5-4762-bbba-7024a75be499\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596480, 1751596480),
(7, 'default', '{\"uuid\":\"44f48f99-b914-462d-8da0-49373f6f6850\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:35;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:35;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"eef9f9fb-b2e0-4a65-8164-a763fb44edd6\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596485, 1751596485),
(8, 'default', '{\"uuid\":\"2a2f25e8-f5ae-49cc-9bf9-f8ef1c1d21b5\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:35;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:35;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"e20cbf2b-b8a2-4c0a-8b8e-6465c3ae256d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596617, 1751596617),
(9, 'default', '{\"uuid\":\"bb76aa2b-d761-46ef-8ec2-11ed34f741b1\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:35;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:35;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"5d1469d9-4ceb-487c-86a2-30f67b7c9ec6\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596621, 1751596621),
(10, 'default', '{\"uuid\":\"c04884ff-4680-4859-a2f2-e9580203e149\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:36;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"7715981a-64d2-4467-ac1c-26524a80fd8d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596693, 1751596693),
(11, 'default', '{\"uuid\":\"553f88a0-36ee-429b-a973-3811842606f1\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:36;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"4a3305d3-699c-4828-8679-12179d57ace2\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596705, 1751596705),
(12, 'default', '{\"uuid\":\"30d62243-4f3e-4219-b3cc-05dc68ef66bb\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:36;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"919df0aa-fa29-42ff-96ae-759bcebbe3bb\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596747, 1751596747),
(13, 'default', '{\"uuid\":\"25c64327-6b15-4da2-b64f-86b84ab37391\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:36;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"04e23e20-8091-4482-9b95-4b7b360d47bc\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751596955, 1751596955),
(14, 'default', '{\"uuid\":\"891a920d-067b-49e1-bc84-405cba25a73f\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:36;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"26417bdf-fd35-46e5-af29-174522e8b7a0\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751597045, 1751597045),
(15, 'default', '{\"uuid\":\"64399f80-03c0-4e76-b9a2-40878ce2b7a1\",\"displayName\":\"App\\\\Notifications\\\\BienvenidaSocio\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";a:1:{i:0;i:36;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:33:\\\"App\\\\Notifications\\\\BienvenidaSocio\\\":2:{s:9:\\\"\\u0000*\\u0000member\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:17:\\\"App\\\\Models\\\\Member\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"100352b7-1656-4450-b7dd-32343b69bc4d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1751598336, 1751598336);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_sistema` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `membership_number` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `telefono_secundario` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `preferencia_alimenticia` text DEFAULT NULL,
  `fecha_membresia` date DEFAULT NULL,
  `descuento_membresia` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_membresia` decimal(10,2) DEFAULT NULL,
  `forma_pago` enum('efectivo','tarjeta','transferencia','online','otro') DEFAULT NULL,
  `enlace_pago` varchar(255) DEFAULT NULL,
  `costo_membresia` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_vencimiento_membresia` date DEFAULT NULL,
  `total_visitas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `membership_type_id` bigint(20) NOT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `imagen_cedula` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`id`, `codigo_sistema`, `name`, `membership_number`, `email`, `phone`, `telefono_secundario`, `photo`, `created_at`, `updated_at`, `membership_type`, `cedula`, `preferencia_alimenticia`, `fecha_membresia`, `descuento_membresia`, `total_membresia`, `forma_pago`, `enlace_pago`, `costo_membresia`, `fecha_nacimiento`, `fecha_vencimiento_membresia`, `total_visitas`, `membership_type_id`, `discount_id`, `imagen_cedula`, `user_id`) VALUES
(26, 'MBR-00001', 'Wilkin Abreu', '33962', 'wilkinabreu23@gmail.com', '8098487445', '8098754698', NULL, '2025-06-11 01:20:10', '2025-07-04 06:46:49', NULL, '223-0092356-5', 'COMIDA SANCOCHO', '2025-06-10', 3000.00, 12000.00, 'online', 'http://127.0.0.1:8001/pago/carnet/33962', 15000.00, '2025-06-18', '2026-06-10', 0, 4, 2, 'cedulas/sBmgIAnOwtTFmHC7lJubmpCnmed1Ve73D2rHGX3s.jpg', 10),
(27, 'MBR-00027', 'LUCIO', '89555', 'abelrodriguezac@gmail.com', '8296944444', '8296944444', NULL, '2025-06-11 01:53:54', '2025-06-11 01:53:54', NULL, '223-0092356-5', 'PESCADO AL AJILLO', '2025-06-10', 0.00, 15000.00, 'online', 'http://127.0.0.1:8001/pago/carnet/89555', 15000.00, '1972-12-13', '2026-06-10', 0, 4, 2, 'cedulas/QJOFhQJccLTpEsWq93Nc6fJoChPDxBExd5JKjMo6.jpg', 10),
(36, 'MBR-00036', 'Manuel Guzman - NUEVO 9', '3396256', 'mguzman686@gmail.com', '8098754698', '5455445444', NULL, '2025-07-04 06:38:13', '2025-07-04 06:38:13', NULL, '223-0084664-5', 'comida2', '2025-07-04', 0.00, 2000.00, 'online', 'http://127.0.0.1:8001/pago/carnet/3396256', 2000.00, '1988-07-19', '2026-07-04', 0, 1, 2, 'cedulas/Vvw9p40hLYIqtwYhqI8RiU7qhr20bxfOUCMNBOMe.jpg', 8),
(37, 'MBR-00037', 'Brayan oconel', '33962568', 'contacto@todovirtual.cloud', '8098754698', '8888888888', NULL, '2025-07-04 07:13:04', '2025-07-04 07:13:05', NULL, '889-9999999-9', 'COMIDA SANCOCHO', '2025-07-04', 0.00, 3000.00, 'efectivo', 'http://127.0.0.1:8001/pago/carnet/33962568', 3000.00, '1988-08-03', '2026-07-04', 0, 2, 3, 'cedulas/1a192SEOOAtug2AD16DLpFqKdhA0aGMAtfwKnTM7.png', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_types`
--

CREATE TABLE `membership_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `costo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `descripcion` text DEFAULT NULL,
  `cantidad_invitados` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `costo_perdida` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `membership_types`
--

INSERT INTO `membership_types` (`id`, `nombre`, `costo`, `descuento`, `descripcion`, `cantidad_invitados`, `created_at`, `updated_at`, `color`, `background_image`, `costo_perdida`) VALUES
(1, 'Plan Morey - Eco Básico', 2000.00, 5.00, 'i)	Entrada y uso de la piscina gratis, con tres (3) acompañantes.\nii)	5 % de descuento en consumo.\niii)	5 % de descuento en alquiler de los salones o áreas del club para fines de cumpleaños, reuniones, celebraciones.\niv)	5 %  en descuento en boletos o entradas a fiestas para sus acompañantes.\n', 3, '2025-05-22 03:18:51', '2025-06-11 01:34:07', '#1cc438', 'storage/fondos_carnet/35rLLcLwpzc4comNylA0xg9NpYsQMmEvNn2MQWtO.jpg', 0.00),
(2, 'Plan Juan Tomás  - Eco Plus', 3000.00, 10.00, 'i)	Entrada y uso de la piscina gratis con sus cinco (5) acompañantes.\r\nii)	10 % de descuento en consumo para el titular y sus cinco acompañantes.\r\niii)	10 % de descuento en alquiler de los salones o áreas del club para fines de cumpleaños, reuniones, celebraciones.\r\niv)	10 %  en descuento en boletos o entradas a fiestas para sus acompañantes.', 5, '2025-05-22 03:18:51', '2025-07-04 21:23:25', '#bf0d0d', 'storage/fondos_carnet/zGUuCnSOEvUFh16i2Z9g81AbxMdWlyJF6PzJXLIi.png', 100.00),
(3, 'Plan la Catana- Eco Elite', 5000.00, 15.00, 'i)	Entrada y uso de la piscina gratis con sus diez (10) acompañantes.\r\nii)	10% de descuento en consumo para el titular y sus diez acompañantes.', 10, '2025-05-22 03:18:51', '2025-07-04 22:07:36', '#59918b', 'storage/fondos_carnet/pC7POtjMEFMLQt2ri9sSlQqR6PqTqbWsqlbc7Gvt.jpg', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `url`, `icono`, `orden`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Actividades', '#actividades', 'fa-leaf', 1, 1, '2025-07-15 03:31:21', '2025-07-15 03:31:21'),
(2, 'Revista', '#revista', 'fa-newspaper', 2, 1, '2025-07-15 03:31:21', '2025-07-15 03:31:21'),
(3, 'Políticas', '#politicas', 'fa-scale-balanced', 3, 1, '2025-07-15 03:31:21', '2025-07-15 03:31:21'),
(4, 'Contacto', '#contacto', 'fa-envelope', 4, 1, '2025-07-15 03:31:21', '2025-07-15 03:31:21'),
(5, 'Reserva', '#reserva', NULL, 5, 1, '2025-07-15 03:31:21', '2025-07-15 07:39:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_24_014907_create_members_table', 1),
(5, '2025_04_24_141122_add_membership_type_to_members_table', 1),
(6, '2025_05_10_212856_update_members_table', 1),
(7, '2025_05_12_013017_create_membership_types_table', 1),
(8, '2025_05_12_051433_add_total_membresia_to_members_table', 1),
(9, '2025_05_14_152237_add_fecha_nacimiento_to_members_table', 1),
(10, '2025_05_14_213233_add_fecha_vencimiento_membresia_to_members_table', 1),
(11, '2025_05_15_031353_add_total_visitas_to_members_table', 1),
(12, '2025_05_17_221035_create_movimientos_table', 1),
(13, '2025_05_17_232910_add_role_to_users_table', 1),
(14, '2025_05_18_024523_add_cantidad_invitados_to_membership_types_table', 1),
(15, '2025_05_18_031734_create_exportaciones_table', 1),
(16, '2025_05_18_051654_add_membership_type_id_to_members_table', 1),
(17, '2025_05_19_013329_create_permission_tables', 1),
(18, '2025_05_30_001742_add_codigo_sistema_to_members_table', 2),
(19, '2025_05_30_015941_add_telefono_secundario_to_members_table', 3),
(20, '2025_05_30_031500_add_color_to_membership_types_table', 4),
(21, '2025_05_30_053344_create_discounts_table', 5),
(22, '2025_05_30_053617_add_discount_id_to_members_table', 5),
(23, '2025_05_31_024552_add_forma_pago_to_members_table', 6),
(24, '2025_05_31_025846_create_caja_movimientos_table', 7),
(25, '2025_05_31_055011_add_estado_pago_to_caja_movimientos_table', 8),
(26, '2025_05_31_055727_add_estado_to_caja_movimientos_table', 9),
(27, '2025_06_01_022307_add_idsucursal_to_users_table', 10),
(28, '2025_06_01_024725_create_sucursals_table', 11),
(29, '2025_06_10_184410_add_imagen_cedula_to_members_table', 12),
(30, '2025_06_10_193328_add_background_to_membership_types_table', 13),
(31, '2025_06_29_024041_add_cedula_to_users_table', 14),
(32, '2025_07_02_035055_add_debe_cambiar_clave_to_users_table', 15),
(33, '2025_07_03_040253_add_costo_perdida_to_membership_types_table', 16),
(34, '2025_07_03_183601_add_es_usuario_club_to_users_table', 17),
(35, '2025_07_03_190922_add_user_id_to_members_table', 18),
(36, '2025_07_04_043450_create_reservas_table', 19),
(37, '2025_07_08_030408_create_reservas_table', 20),
(38, '2025_07_08_042633_create_promociones_table', 21),
(39, '2025_07_08_042859_create_promocions_table', 22),
(40, '2025_07_08_043945_create_promociones_table', 23),
(41, '2025_07_08_044111_create_promotions_table', 24),
(42, '2025_07_08_062334_add_user_id_to_reservas_table', 25),
(43, '2025_07_09_034658_create_habitacions_table', 26),
(44, '2025_07_10_023417_add_habitacion_id_to_reservas_table', 27),
(45, '2025_07_10_232101_add_es_compartida_to_habitacions_table', 28),
(46, '2025_07_11_022527_create_habitacion_imagenes_table', 29),
(47, '2025_07_15_013103_create_web_pages_table', 30),
(48, '2025_07_15_020930_create_hero_settings_table', 31),
(49, '2025_07_15_025105_create_menus_table', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `membership_number` varchar(255) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocions`
--

CREATE TABLE `promocions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promocions`
--

INSERT INTO `promocions` (`id`, `fecha`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, '2025-07-20', 'Promo de julio', '2025-07-08 04:45:14', '2025-07-08 04:45:14'),
(2, '2025-08-01', 'Oferta especial agosto', '2025-07-08 04:45:14', '2025-07-08 04:45:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `rooms` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `guests` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  `habitacion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'reservado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `user_id`, `check_in`, `check_out`, `rooms`, `guests`, `habitacion_id`, `estado`, `created_at`, `updated_at`) VALUES
(43, 16, '2025-07-10', '2025-07-12', 1, 1, 2, 'reservado', '2025-07-11 01:34:02', '2025-07-11 01:34:02'),
(75, 16, '2025-07-15', '2025-07-18', 1, 1, 2, 'reservado', '2025-07-14 07:32:26', '2025-07-14 07:32:26'),
(76, 16, '2025-07-24', '2025-07-25', 1, 1, 2, 'reservado', '2025-07-14 07:54:03', '2025-07-14 07:54:03'),
(77, 16, '2025-07-31', '2025-08-01', 10, 11, 2, 'reservado', '2025-07-14 07:55:01', '2025-07-14 07:55:01'),
(78, 16, '2025-07-19', '2025-07-22', 1, 1, 2, 'reservado', '2025-07-14 07:55:57', '2025-07-14 07:55:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-05-22 02:45:02', '2025-05-22 02:45:02'),
(2, 'user', 'web', '2025-05-22 02:47:43', '2025-05-22 02:47:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fn877nDOfX6FXex8cBv8wr4KelhE0CcylAXEpyiv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWZ5MUg0cE9IaUdBN243TTNlRTJ2QTZsaWtkbkRGMFhwNngxQ3NSSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752719954),
('kjzEuy9FIp8NNRrHGAjRmBuDMic3pNlDK8OMQ9CD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSDNaZWhKZXJNVU9qNE9WajVlM3F0aGlMQVhQZmlIUHdTeEEyUkNGRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9oZXJvL2VkaXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752554804),
('lXK8AMc8QeAw3bsjzn5COy4FgAhHQCbiZD79ag5T', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiakc0UUZPaVNLTnBjMTN5NVdvcnNYa1F0eWtQU3BVUnFBVjBqbkRWVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2FkbWluL21lbnVzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752623471);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursals`
--

CREATE TABLE `sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursals`
--

INSERT INTO `sucursals` (`id`, `nombre`, `direccion`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'Partido Dajabón', 'Calle Andrés Medina No. 118', '809-226-4012', NULL, NULL),
(2, 'Dajabón', 'Calle Beller No. 46, Centro Ciudad', '809-579-8535', NULL, '2025-06-01 08:41:25'),
(3, 'Santo Domingo Este', 'Plaza City Centre, Autopista Coronel Rafael Tomás Fernández Domínguez, Santo Domingo Este 11506, República Dominicana', '809-793-7669', NULL, NULL),
(4, 'Santo Domingo', 'Av. Jhon F. Kennedy, Esq. José López Km 7 1/2, Local No.105.', '809-548-8444', NULL, NULL),
(5, 'Villa Vásquez', 'Avenida Libertad esquina Duarte. No. 01', '809-579-6357', NULL, NULL),
(6, 'Santiago', 'Calle Germán Soriano, Esq. Bartolomé Colón. Plaza Jorge II. Santiago, R.D. (Frente al Multicentro La Sirena)', '809-241-6661', NULL, NULL),
(7, 'El Pino', 'C/ Duarte, Edif. Nicolás Valerio, El Pino.', '809-579-4010', NULL, NULL),
(8, 'Villa Isabela', 'Calle Cristóbal Colón, No. 16', '809-589-5394', NULL, NULL),
(9, 'Guayubín', 'Calle Rodrigo Lozada, Esq. Mella No. 1.', '809-572-0577', NULL, NULL),
(10, 'La Rotonda', 'Av. 27 de Febrero, Aut. Joaquín Balaguer', '809-575-0003', NULL, NULL),
(11, 'Villa Los Almácigos', 'Calle Libertad, Esq. Sánchez. No. 24 Villa los Almácigos, Santiago Rodríguez', '809-579-0401', NULL, NULL),
(12, 'Manzanillo', 'Calle 27 de Febrero, Frente al Liceo Lourdes Morel, Pepillo Salcedo, Monte Cristi.', '809-579-405', NULL, NULL),
(13, 'La Fuente', 'Av. Circunvalación, Plaza Fernández', '809-581-660', NULL, NULL),
(14, 'Castañuelas', 'Calle 30 de Mayo No. 63', '809-584-8845', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `idsucursal` bigint(20) UNSIGNED DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `debe_cambiar_clave` tinyint(1) NOT NULL DEFAULT 0,
  `es_usuario_club` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `idsucursal`, `cedula`, `debe_cambiar_clave`, `es_usuario_club`) VALUES
(1, 'Rol Admin', 'mguzman686@gmail.com', '2025-05-22 02:41:14', '$2y$12$dP.k0f/9KPAQsuU4A3.Cpe29untNmQi8I03hl/qF2P5fG42h1xZAi', NULL, '2025-05-22 02:41:14', '2025-06-01 08:01:51', 'admin', 0, NULL, 0, 0),
(8, 'Brayan oconel', 'mguzman688@gmail.com', NULL, '$2y$12$fSwNgCiCDwAxgdAfzJAlzujM1nN3A3sy1Km7dVCIIaSNw4XXs/BTm', NULL, '2025-07-03 07:51:47', '2025-07-03 07:52:23', 'admin', 13, NULL, 0, 0),
(10, 'Juan', 'mguzman687@gmail.com', NULL, '$2y$12$2OxAux4..O4IMegM3ugFyui/qOf3s9LYFVEHvMTzv037e7eRcq2zS', NULL, '2025-07-03 22:46:09', '2025-07-03 23:26:43', 'admin', 1, NULL, 0, 1),
(16, 'Brayan oconel', 'contacto@todovirtual.cloud', '2025-07-09 01:12:35', '$2y$12$F5CyRwO1067R9NA/fVtjCuArzlr4t5ayJ5FiV87bqoQnqa24QEHi6', NULL, '2025-07-09 01:10:18', '2025-07-09 01:12:35', 'user', 9999, '223-0092347-5', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_pages`
--

CREATE TABLE `web_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `imagen_destacada` varchar(255) DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `tipo` varchar(255) NOT NULL DEFAULT 'pagina',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `caja_movimientos`
--
ALTER TABLE `caja_movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caja_movimientos_member_id_foreign` (`member_id`),
  ADD KEY `caja_movimientos_user_id_foreign` (`user_id`),
  ADD KEY `caja_movimientos_confirmado_por_foreign` (`confirmado_por`);

--
-- Indices de la tabla `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exportaciones`
--
ALTER TABLE `exportaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `habitacions`
--
ALTER TABLE `habitacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitacion_imagens`
--
ALTER TABLE `habitacion_imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `habitacion_imagenes_habitacion_id_foreign` (`habitacion_id`);

--
-- Indices de la tabla `hero_settings`
--
ALTER TABLE `hero_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_membership_number_unique` (`membership_number`),
  ADD UNIQUE KEY `members_codigo_sistema_unique` (`codigo_sistema`),
  ADD KEY `members_discount_id_foreign` (`discount_id`),
  ADD KEY `members_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `membership_types`
--
ALTER TABLE `membership_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_membership_number_foreign` (`membership_number`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `promocions`
--
ALTER TABLE `promocions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservas_user_id_foreign` (`user_id`),
  ADD KEY `reservas_habitacion_id_foreign` (`habitacion_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_cedula_unique` (`cedula`);

--
-- Indices de la tabla `web_pages`
--
ALTER TABLE `web_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `web_pages_slug_unique` (`slug`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_movimientos`
--
ALTER TABLE `caja_movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `exportaciones`
--
ALTER TABLE `exportaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitacions`
--
ALTER TABLE `habitacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `habitacion_imagens`
--
ALTER TABLE `habitacion_imagens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `hero_settings`
--
ALTER TABLE `hero_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `membership_types`
--
ALTER TABLE `membership_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promocions`
--
ALTER TABLE `promocions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `web_pages`
--
ALTER TABLE `web_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja_movimientos`
--
ALTER TABLE `caja_movimientos`
  ADD CONSTRAINT `caja_movimientos_confirmado_por_foreign` FOREIGN KEY (`confirmado_por`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `caja_movimientos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `habitacion_imagens`
--
ALTER TABLE `habitacion_imagens`
  ADD CONSTRAINT `habitacion_imagenes_habitacion_id_foreign` FOREIGN KEY (`habitacion_id`) REFERENCES `habitacions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_membership_number_foreign` FOREIGN KEY (`membership_number`) REFERENCES `members` (`membership_number`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_habitacion_id_foreign` FOREIGN KEY (`habitacion_id`) REFERENCES `habitacions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
