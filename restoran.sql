-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 13 2020 г., 20:05
-- Версия сервера: 5.7.28-0ubuntu0.18.04.4
-- Версия PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `restoran`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Мясо'),
(2, 'Пиво'),
(5, 'Пицца'),
(4, 'Роллы'),
(3, 'Салаты'),
(6, 'Суп');

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE `dishes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `measure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `photo_link` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `is_stop_list` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `description`, `price`, `measure`, `weight`, `photo_link`, `category_id`, `is_stop_list`) VALUES
(1, 'Стейк', 'Очень вкусный стейк', 230, 'г', 400, '/img/Стейк.jpg', 1, 0),
(2, 'Австрийский рецепт', 'Мягкое светлое пиво', 100, 'мл', 300, '/img/Австрийский рецепт.png', 2, 0),
(3, 'Ирландский рецепт', 'Вкусное темное пиво', 110, 'мл', 300, '/img/Ирландский рецепт.jpg', 2, 0),
(4, 'Цезарь', 'Всеми любимый салат', 230, 'г', 250, '/img/Цезарь.jpg', 3, 0),
(5, 'Лёгкий', 'Салат для тех, кто считает калории', 160, 'г', 200, '/img/Лёгкий.jpg', 3, 0),
(6, 'Калифорния', 'Популярные роллы', 170, 'г', 300, '/img/Калифорния.jpg', 4, 0),
(7, 'Маргарита', 'Простая пицца', 220, 'г', 500, '/img/Маргарита.jpg', 5, 0),
(8, 'Сицилийская', 'Почувствуйте себя на острове', 300, 'г', 500, '/img/Сицилийская.jpg', 5, 0),
(9, 'Дьябло', 'Uhh, that\'s hot!', 300, 'г', 500, '/img/Дьябло.jpg', 5, 0),
(10, 'Неаполитанская', 'Опять Италия', 300, 'г', 500, '/img/Неаполитанская.jpg', 5, 0),
(11, 'Рожок', 'Вкус детсва', 100, 'г', 120, 'https://st.depositphotos.com/1801791/1412/i/450/depositphotos_14128085-stock-photo-ice-cream-scoops-in-waffle.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes_event`
--

CREATE TABLE `dishes_event` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED DEFAULT NULL,
  `reservation_id` int(11) UNSIGNED DEFAULT NULL,
  `dish_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dishes_event`
--

INSERT INTO `dishes_event` (`id`, `event_id`, `reservation_id`, `dish_id`, `count`) VALUES
(1, NULL, NULL, 1, 2),
(2, NULL, NULL, 3, 5),
(3, 1, NULL, 11, 2),
(4, 1, NULL, 11, 6),
(5, 1, NULL, 11, 1),
(6, 1, NULL, 4, 5),
(7, 3, NULL, 9, 8),
(8, 3, NULL, 2, 3),
(9, 3, NULL, 2, 2),
(10, 3, NULL, 3, 2),
(11, 3, NULL, 6, 4),
(12, 3, NULL, 1, 4),
(13, 3, NULL, 6, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `dish_ingredients`
--

CREATE TABLE `dish_ingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `ingredient_id` int(10) UNSIGNED DEFAULT NULL,
  `dish_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dish_ingredients`
--

INSERT INTO `dish_ingredients` (`id`, `ingredient_id`, `dish_id`) VALUES
(1, 12, 1),
(2, 1, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4),
(6, 8, 4),
(7, 3, 5),
(8, 4, 5),
(9, 16, 5),
(10, 8, 5),
(11, 2, 6),
(12, 6, 7),
(13, 7, 7),
(14, 1, 7),
(15, 5, 8),
(16, 6, 8),
(17, 7, 8),
(18, 13, 8),
(19, 14, 8),
(20, 5, 9),
(21, 6, 9),
(22, 7, 9),
(23, 13, 9),
(24, 14, 9),
(25, 16, 8),
(26, 15, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_type_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `hall_id` int(10) UNSIGNED DEFAULT NULL,
  `date_time_event` datetime NOT NULL,
  `count_peoples` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `event_type_id`, `user_id`, `hall_id`, `date_time_event`, `count_peoples`) VALUES
(1, 2, 2, 1, '2020-01-30 14:00:00', 10),
(2, 2, 1, 1, '2020-01-31 12:00:00', 10),
(3, 2, 1, 1, '2020-01-30 12:00:00', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `event_types`
--

CREATE TABLE `event_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `event_types`
--

INSERT INTO `event_types` (`id`, `name`) VALUES
(2, 'День рождения'),
(4, 'Корпоратив'),
(3, 'Поминки'),
(1, 'Свадьба');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `halls`
--

CREATE TABLE `halls` (
  `id` int(10) UNSIGNED NOT NULL,
  `hall_type_id` int(10) UNSIGNED DEFAULT NULL,
  `photo_link` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `halls`
--

INSERT INTO `halls` (`id`, `hall_type_id`, `photo_link`) VALUES
(1, 1, '/img/зал 1.jpg'),
(2, 2, '/img/зал 2.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `hall_types`
--

CREATE TABLE `hall_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hall_types`
--

INSERT INTO `hall_types` (`id`, `name`) VALUES
(2, 'Для куряищх'),
(1, 'Обычный');

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`) VALUES
(13, 'Балык'),
(11, 'Грибы'),
(1, 'Курица'),
(3, 'Листья салата'),
(16, 'Лук'),
(10, 'Маслины'),
(7, 'Моцарелла'),
(9, 'Оливки'),
(8, 'Помидор черри'),
(2, 'Рис'),
(14, 'Салями'),
(12, 'Свинина'),
(15, 'Сухари'),
(5, 'Сыр пармезан'),
(6, 'Сыр чеддер'),
(4, 'Яйцо');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_19_235156_create_categories_table', 1),
(5, '2020_01_20_000040_create_event_types_table', 1),
(6, '2020_01_20_000109_create_hall_types_table', 1),
(7, '2020_01_20_000119_create_halls_table', 1),
(8, '2020_01_20_000220_create_tables_table', 1),
(9, '2020_01_20_000222_create_reservations_table', 1),
(10, '2020_01_20_000236_create_events_table', 1),
(11, '2020_01_20_000238_create_dishes_table', 1),
(12, '2020_01_20_000308_create_ingredients_table', 1),
(13, '2020_01_20_000329_create_dish_ingredients_table', 1),
(14, '2020_01_20_000348_create_dishes_reservation_table', 1),
(15, '2020_01_20_000357_create_dishes_event_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `table_id` int(10) UNSIGNED DEFAULT NULL,
  `date_time_reservation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `table_id`, `date_time_reservation`) VALUES
(1, NULL, 1, '2020-01-23 12:00:00'),
(2, NULL, 2, '2020-01-23 14:00:00'),
(3, NULL, 3, '2020-01-23 16:00:00'),
(4, NULL, 4, '2020-01-23 17:00:00'),
(5, NULL, 5, '2020-01-23 18:00:00'),
(6, NULL, 6, '2020-01-23 19:00:00'),
(7, NULL, 7, '2020-01-23 20:00:00'),
(8, NULL, 8, '2020-01-23 17:00:00'),
(9, NULL, 9, '2020-01-23 18:00:00'),
(10, NULL, 10, '2020-01-23 19:00:00'),
(11, NULL, 2, '2020-01-23 14:00:00'),
(12, NULL, 1, '2020-01-23 14:00:00'),
(13, 1, 3, '2020-01-24 14:00:00'),
(14, 1, 2, '2020-01-24 18:00:00'),
(15, 1, 1, '2020-01-24 14:00:00'),
(16, 1, 1, '2020-01-25 18:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE `tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_num` int(11) NOT NULL,
  `hall_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`id`, `table_num`, `hall_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 1, 2),
(12, 2, 2),
(13, 3, 2),
(14, 4, 2),
(15, 5, 2),
(16, 6, 2),
(17, 7, 2),
(18, 8, 2),
(19, 9, 2),
(20, 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`) VALUES
(1, '0711488228', 'pavel@jopa.com', NULL, '$2y$10$7LQ3HN0dLiCeiF3CUNi6auxPQ10KiwoY5jTBWYq9jli1t5Syz16W.', 1, NULL),
(2, '0711488322', 'golovin@yandex.ru', NULL, '$2y$10$T29K3OAGnm9tuGcD.yPIluehr.SEDF7Qb0D4b3nMZWRl1.ukfpp0G', 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Индексы таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dishes_name_unique` (`name`),
  ADD KEY `dishes_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `dishes_event`
--
ALTER TABLE `dishes_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dishes_event_dish_id_foreign` (`dish_id`),
  ADD KEY `dishes_event_event_id_foreigin` (`event_id`),
  ADD KEY `dishes_event_reservation_id_foreign` (`reservation_id`);

--
-- Индексы таблицы `dish_ingredients`
--
ALTER TABLE `dish_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_ingredients_dish_id_foreign` (`dish_id`),
  ADD KEY `dish_ingredients_ingredient_id_foreign` (`ingredient_id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_event_type_id_foreign` (`event_type_id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_hall_id_foreign` (`hall_id`);

--
-- Индексы таблицы `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_types_name_unique` (`name`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `halls_hall_type_id_foreign` (`hall_type_id`);

--
-- Индексы таблицы `hall_types`
--
ALTER TABLE `hall_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hall_types_name_unique` (`name`);

--
-- Индексы таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ingredients_name_unique` (`name`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`),
  ADD KEY `reservations_table_id_foreign` (`table_id`);

--
-- Индексы таблицы `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_hall_id_foreign` (`hall_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `dishes_event`
--
ALTER TABLE `dishes_event`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `dish_ingredients`
--
ALTER TABLE `dish_ingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `hall_types`
--
ALTER TABLE `hall_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `dishes_event`
--
ALTER TABLE `dishes_event`
  ADD CONSTRAINT `dishes_event_dish_id_foreign` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`),
  ADD CONSTRAINT `dishes_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `dishes_event_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Ограничения внешнего ключа таблицы `dish_ingredients`
--
ALTER TABLE `dish_ingredients`
  ADD CONSTRAINT `dish_ingredients_dish_id_foreign` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`),
  ADD CONSTRAINT `dish_ingredients_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);

--
-- Ограничения внешнего ключа таблицы `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_event_type_id_foreign` FOREIGN KEY (`event_type_id`) REFERENCES `event_types` (`id`),
  ADD CONSTRAINT `events_hall_id_foreign` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`),
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `halls`
--
ALTER TABLE `halls`
  ADD CONSTRAINT `halls_hall_type_id_foreign` FOREIGN KEY (`hall_type_id`) REFERENCES `hall_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`),
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_hall_id_foreign` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
