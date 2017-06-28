-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2017 a las 04:12:23
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel_incidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proyect_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `proyect_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Categoria A1', 1, NULL, '2017-05-12 05:22:22', '2017-05-12 05:22:22'),
(2, 'Categoria A2', 1, NULL, '2017-05-12 05:22:22', '2017-05-12 05:22:22'),
(3, 'Categoria B1', 2, NULL, '2017-05-12 05:22:22', '2017-05-12 05:22:22'),
(4, 'Categoria B2', 2, NULL, '2017-05-12 05:22:22', '2017-05-12 05:22:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidents`
--

CREATE TABLE `incidents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `severity` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `proyect_id` int(10) UNSIGNED DEFAULT NULL,
  `level_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `support_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proyect_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `incident_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyects`
--

CREATE TABLE `proyects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyects`
--

INSERT INTO `proyects` (`id`, `name`, `description`, `start`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Proyecto A', 'Proyecto A sera entorno Web Laravel', NULL, NULL, '2017-05-12 05:22:21', '2017-05-12 05:22:21'),
(2, 'Proyecto B', 'Proyecto B sera entorno de Escritorio en C#', NULL, NULL, '2017-05-12 05:22:21', '2017-05-12 05:22:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyect_user`
--

CREATE TABLE `proyect_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `proyect_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `level_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '2',
  `selected_proyect_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `selected_proyect_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'admin@gmail.com', '$2y$10$Z.vB5Vc3LQXx9qFr7IPOn.JEsgDFrJHGKMl.lkYHUseFFfLpmyH8i', 0, 2, '1LAlOrBw7UOlK9d6YY8B8MOCXRppSioFy6LVdirQKqSkD0llHgyX7w9L5FnO', NULL, '2017-05-12 05:22:21', '2017-06-28 02:12:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_proyect_id_foreign` (`proyect_id`);

--
-- Indices de la tabla `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidents_category_id_foreign` (`category_id`),
  ADD KEY `incidents_proyect_id_foreign` (`proyect_id`),
  ADD KEY `incidents_level_id_foreign` (`level_id`),
  ADD KEY `incidents_client_id_foreign` (`client_id`),
  ADD KEY `incidents_support_id_foreign` (`support_id`);

--
-- Indices de la tabla `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `levels_proyect_id_foreign` (`proyect_id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `proyects`
--
ALTER TABLE `proyects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyect_user`
--
ALTER TABLE `proyect_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyect_user_proyect_id_foreign` (`proyect_id`),
  ADD KEY `proyect_user_user_id_foreign` (`user_id`),
  ADD KEY `proyect_user_level_id_foreign` (`level_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `selected_proyect_id` (`selected_proyect_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyects`
--
ALTER TABLE `proyects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proyect_user`
--
ALTER TABLE `proyect_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_proyect_id_foreign` FOREIGN KEY (`proyect_id`) REFERENCES `proyects` (`id`);

--
-- Filtros para la tabla `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `incidents_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `incidents_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `incidents_proyect_id_foreign` FOREIGN KEY (`proyect_id`) REFERENCES `proyects` (`id`),
  ADD CONSTRAINT `incidents_support_id_foreign` FOREIGN KEY (`support_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `levels`
--
ALTER TABLE `levels`
  ADD CONSTRAINT `levels_proyect_id_foreign` FOREIGN KEY (`proyect_id`) REFERENCES `proyects` (`id`);

--
-- Filtros para la tabla `proyect_user`
--
ALTER TABLE `proyect_user`
  ADD CONSTRAINT `proyect_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `proyect_user_proyect_id_foreign` FOREIGN KEY (`proyect_id`) REFERENCES `proyects` (`id`),
  ADD CONSTRAINT `proyect_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`selected_proyect_id`) REFERENCES `proyects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
