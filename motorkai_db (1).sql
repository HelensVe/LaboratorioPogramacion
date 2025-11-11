-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2025 a las 22:04:37
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
-- Base de datos: `motorkai_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `logo`, `created_at`) VALUES
(1, 'PistonPro', NULL, NULL, '2025-11-05 17:59:42'),
(2, 'LuzMax', NULL, NULL, '2025-11-05 17:59:42'),
(3, 'MotoShock', NULL, NULL, '2025-11-05 17:59:42'),
(4, 'RiderGear', NULL, NULL, '2025-11-05 17:59:42'),
(5, 'FrenoSeguro', NULL, NULL, '2025-11-05 17:59:42'),
(6, 'Showa', 'Shocks and suspension systems', 'Shocks and suspension systems', '2025-09-25 13:45:09'),
(7, 'NGK', 'Spark plugs and electrical parts', 'Spark plugs and electrical parts', '2025-09-25 13:45:09'),
(8, 'Suzuki', NULL, NULL, '2025-10-03 20:05:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'ID del usuario dueño del carrito (Clave foránea a la tabla de users)',
  `product_id` int(11) NOT NULL COMMENT 'ID del producto en el carrito (Clave foránea a la tabla products)',
  `qty` int(11) NOT NULL DEFAULT 1 COMMENT 'Cantidad de este producto en el carrito',
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Artículos en el carrito de compras de los usuarios';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp() COMMENT 'Añadido para conservar la fecha de creación del volcado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `visible`, `created_at`) VALUES
(1, 'Motor y Transmisión', 'Componentes internos y de fuerza, como pistones, cadenas y piñones.', 1, NULL),
(2, 'Electricidad e Iluminación', 'Repuestos relacionados con la batería, luces, bobinas y encendido.', 1, NULL),
(3, 'Chasis y Suspensión', 'Partes estructurales, amortiguadores, horquillas y manubrios.', 1, NULL),
(4, 'Accesorios y Equipamiento', 'Artículos adicionales para la moto y el motociclista, como cascos y maletas.', 1, NULL),
(5, 'Frenos', 'Discos, pastillas, zapatas y sistemas hidráulicos de frenado.', 0, NULL),
(7, 'prueba1', 'prueba', 1, NULL),
(8, 'Oils', 'Oils and lubricants', 1, '2025-09-25 13:47:59'),
(9, 'Shock Absorbers', 'Suspension and damping systems', 1, '2025-09-25 13:47:59'),
(10, 'Spark Plugs', 'Ignition and spark plugs', 1, '2025-09-25 13:47:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sale_id` int(11) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `sale_id`, `payment_method`, `payment_status`) VALUES
(1, NULL, 0, 'Efectivo', 'Completada'),
(2, NULL, 0, 'Tarjeta', 'Pendiente'),
(3, NULL, 0, 'Transferencia', 'Completada'),
(4, NULL, 1, 'Efectivo', 'Completada'),
(5, NULL, 2, 'Transferencia', 'Completada'),
(6, NULL, 3, 'Efectivo', 'Pendiente'),
(7, NULL, 4, 'Transferencia', 'Cancelada'),
(8, NULL, 5, 'Efectivo', 'Completada'),
(9, NULL, 6, 'Transferencia', 'Cancelada'),
(10, NULL, 9, 'Efectivo', 'Completada'),
(11, NULL, 10, 'Tarjeta', 'Pendiente'),
(12, NULL, 11, 'Efectivo', 'Completada'),
(13, NULL, 12, 'Efectivo', 'Completada'),
(14, NULL, 13, 'Transferencia', 'Completada'),
(15, NULL, 14, 'Tarjeta', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_options`
--

CREATE TABLE `payment_options` (
  `id` int(11) NOT NULL,
  `method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_options`
--

INSERT INTO `payment_options` (`id`, `method`, `status`) VALUES
(1, 'Efectivo', 'Completada'),
(2, 'Tarjeta', 'Pendiente'),
(3, 'Transferencia', 'Completada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_status`
--

CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `brand_id`, `photo`, `created_at`) VALUES
(1, 'Kit de Cilindro y Pistón 150cc', NULL, 85.50, 45, 1, 1, 'url/motopartes/kit_cilindro_150.jpg', NULL),
(2, 'Cadena de Transmisión Reforzada 428H', NULL, 32.99, 110, 1, 1, 'url/motopartes/cadena_428h.jpg', NULL),
(3, 'Filtro de Aceite Sintético', NULL, 9.75, 250, 1, 1, 'url/motopartes/filtro_aceite.jpg', NULL),
(4, 'Batería de Gel 12V 7AH', NULL, 55.00, 70, 2, 2, 'url/motopartes/bateria_gel_7ah.jpg', NULL),
(5, 'Faro LED Delantero Universal', NULL, 45.90, 90, 2, 2, 'url/motopartes/faro_led.jpg', NULL),
(6, 'Amortiguadores Traseros Regulables (Par)', NULL, 120.00, 30, 3, 3, 'url/motopartes/amortiguadores_par.jpg', NULL),
(7, 'Manubrio Deportivo de Aluminio', NULL, 28.50, 65, 3, 3, 'url/motopartes/manubrio_aluminio.jpg', NULL),
(8, 'Casco Integral Certificado Talla L', NULL, 150.00, 50, 4, 4, 'url/motopartes/casco_integral_l.jpg', NULL),
(9, 'Juego de Maletas Laterales Rígidas', NULL, 280.00, 20, 4, 4, 'url/motopartes/maletas_rigidas.jpg', NULL),
(10, 'Pastillas de Freno Sinterizadas (Juego)', NULL, 18.25, 180, 5, 5, 'url/motopartes/pastillas_sinterizadas.jpg', NULL),
(11, 'Disco de Freno Delantero Flotante', NULL, 65.00, 40, 5, 5, 'url/motopartes/disco_flotante.jpg', NULL),
(12, 'Clavos', '1\"', 2000.00, 1500, NULL, NULL, 'uploads/68c8225d76629.jpg', '2025-09-15 17:25:42'),
(13, 'Motul 7100 Oil', 'Synthetic oil for 4T motorcycles', 12000.00, 20, 8, NULL, NULL, '2025-09-25 13:49:05'),
(14, 'Showa Pro Shock', 'High resistance rear shock absorber', 45000.00, 10, 9, 6, NULL, '2025-09-25 13:49:05'),
(15, 'NGK CR8E Spark Plug', 'Standard ignition spark plug', 3500.00, 50, 10, 7, NULL, '2025-09-25 13:49:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'ID del usuario que realizó la venta',
  `total` decimal(10,2) NOT NULL,
  `payment_method_id` int(11) DEFAULT NULL COMMENT 'Clave foránea a payment_methods',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `total`, `payment_method_id`, `created_at`) VALUES
(1, 1, 0.00, NULL, '2025-10-29 20:33:51'),
(2, 1, 0.00, NULL, '2025-10-29 20:35:10'),
(3, 1, 0.00, NULL, '2025-10-29 22:45:10'),
(4, 1, 0.00, NULL, '2025-10-29 22:48:35'),
(5, 1, 0.00, NULL, '2025-10-30 02:15:09'),
(6, 1, 0.00, NULL, '2025-11-01 02:45:22'),
(9, 2, 0.00, NULL, '2025-11-07 19:48:17'),
(10, 2, 0.00, NULL, '2025-11-07 19:56:22'),
(11, 2, 0.00, NULL, '2025-11-07 20:18:47'),
(12, 2, 0.00, NULL, '2025-11-07 20:23:54'),
(13, 2, 0.00, NULL, '2025-11-07 21:05:43'),
(14, 2, 120.00, NULL, '2025-11-07 21:07:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `note`, `created_at`) VALUES
(1, 1, 6, 1, 120.00, NULL, '2025-10-29 20:33:51'),
(2, 2, 6, 1, 120.00, NULL, '2025-10-29 20:35:10'),
(3, 2, 4, 1, 55.00, NULL, '2025-10-29 20:35:10'),
(4, 2, 11, 1, 65.00, NULL, '2025-10-29 20:35:10'),
(5, 3, 6, 1, 120.00, NULL, '2025-10-29 22:45:10'),
(6, 3, 4, 1, 55.00, NULL, '2025-10-29 22:45:10'),
(7, 4, 6, 1, 120.00, NULL, '2025-10-29 22:48:35'),
(8, 4, 11, 1, 65.00, NULL, '2025-10-29 22:48:35'),
(9, 4, 5, 1, 45.90, NULL, '2025-10-29 22:48:35'),
(10, 4, 3, 1, 9.75, NULL, '2025-10-29 22:48:35'),
(11, 4, 9, 1, 280.00, NULL, '2025-10-29 22:48:35'),
(12, 5, 11, 1, 65.00, NULL, '2025-10-30 02:15:09'),
(13, 5, 9, 1, 280.00, NULL, '2025-10-30 02:15:09'),
(14, 5, 10, 1, 18.25, NULL, '2025-10-30 02:15:09'),
(15, 6, 6, 1, 120.00, NULL, '2025-11-01 02:45:22'),
(16, 6, 4, 1, 55.00, NULL, '2025-11-01 02:45:22'),
(17, 6, 2, 1, 32.99, NULL, '2025-11-01 02:45:22'),
(18, 9, 5, 1, 45.90, NULL, '2025-11-07 19:48:17'),
(19, 10, 9, 2, 280.00, NULL, '2025-11-07 19:56:22'),
(20, 11, 12, 1, 2000.00, NULL, '2025-11-07 20:18:47'),
(21, 12, 12, 1, 2000.00, NULL, '2025-11-07 20:23:54'),
(22, 13, 6, 1, 120.00, NULL, '2025-11-07 21:05:43'),
(23, 13, 10, 1, 18.25, NULL, '2025-11-07 21:05:43'),
(24, 14, 6, 1, 120.00, NULL, '2025-11-07 21:07:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`, `email`, `avatar`, `created_at`) VALUES
(1, 'Facundo', 'facundo', '$2y$10$m4//NEfe7kRxcKEG4fMO5ecGWd.Ezn4A1X2SXYhjrYHxvkDnlHJpq', 'admin', 'facundo@motorkai.com', NULL, NULL),
(2, 'Angie', 'angeles', '$2y$10$m4//NEfe7kRxcKEG4fMO5ecGWd.Ezn4A1X2SXYhjrYHxvkDnlHJpq', 'admin', 'angie@motorkai.com', NULL, NULL),
(4, 'Angie (Volcado)', 'Angie_v', '$2y$10$pofgtUK.uepZsqXLC/fdo. 4e2JpatmbzTIHY3cWCLzDBL7vmBO.4S', 'client', 'angie_v@motorkai.com', NULL, '2025-09-25 13:43:06'),
(5, 'Patricio Tassano', 'Pato', '81dc9bdb52d04dc20036dbd8313ed055', 'client', 'pato@motorkai.com', NULL, '2025-09-25 13:43:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_unique` (`user_id`,`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_options`
--
ALTER TABLE `payment_options`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Indices de la tabla `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sale_items_sale` (`sale_id`),
  ADD KEY `fk_sale_items_product` (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `payment_options`
--
ALTER TABLE `payment_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_item_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `fk_sale_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sale_items_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
