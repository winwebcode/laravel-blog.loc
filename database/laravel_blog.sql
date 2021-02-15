-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2021 г., 19:38
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel_blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, '23january', '23january', '2021-01-23 08:20:28', '2021-01-25 09:38:53'),
(5, 'Категория 1', 'kategoriya-1', '2021-01-29 07:55:28', '2021-01-29 07:55:28'),
(6, 'Категория 2', 'kategoriya-2', '2021-01-29 07:55:33', '2021-01-29 07:55:33'),
(7, 'sunt', 'sunt', '2021-02-01 08:11:47', '2021-02-01 08:11:47'),
(8, 'nobis', 'nobis', '2021-02-01 08:18:22', '2021-02-01 08:18:22'),
(9, 'in', 'in', '2021-02-01 08:18:22', '2021-02-01 08:18:22'),
(10, 'deleniti', 'deleniti', '2021-02-01 08:18:22', '2021-02-01 08:18:22'),
(11, 'omnis', 'omnis', '2021-02-01 08:18:22', '2021-02-01 08:18:22'),
(12, 'aut', 'aut', '2021-02-01 08:18:22', '2021-02-01 08:18:22');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `status`, `created_at`, `updated_at`) VALUES
(5, '<p>NEW 555</p>', 1, 19, 1, '2021-02-05 09:34:45', '2021-02-09 01:01:48'),
(7, '<p>124142 добавка</p>', 1, 20, 1, '2021-02-08 10:31:28', '2021-02-09 00:58:39'),
(8, '5215235', 1, 20, 1, '2021-02-08 10:31:31', '2021-02-09 05:14:23'),
(9, '123', 1, 21, 1, '2021-02-09 05:14:16', '2021-02-09 05:14:24');

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
(25, '2014_10_12_000000_create_users_table', 1),
(26, '2014_10_12_100000_create_password_resets_table', 1),
(27, '2021_01_13_154310_create_categories_table', 1),
(28, '2021_01_13_163257_create_tags_table', 1),
(29, '2021_01_13_164132_create_comments_table', 1),
(30, '2021_01_13_164158_create_posts_table', 1),
(31, '2021_01_13_164229_create_subscriptions_table', 1),
(32, '2021_01_13_165934_create_posts_tags_table', 1),
(33, '2021_01_26_144444_add_avatar_column_to_users', 2),
(34, '2021_01_28_163953_make_password_nullable', 3),
(35, '2021_01_29_153358_add_date_column_to_posts', 4),
(36, '2021_01_29_163635_add_image_column_to_posts', 5),
(37, '2021_02_01_170054_add_description_to_posts', 6),
(38, '2021_02_08_124031_add_keywords_column_to_posts', 7),
(39, '2021_02_08_134912_add_ban_column_to_users', 8),
(40, '2021_02_09_112637_add_sign_column_to_users', 9),
(43, '2021_02_13_164754_create_settings_table', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `category_id`, `user_id`, `status`, `views`, `is_featured`, `created_at`, `updated_at`, `date`, `image`, `description`, `keywords`) VALUES
(19, '555', '555', '<p>123</p>', 1, 1, 1, 0, 0, '2021-01-31 01:18:29', '2021-02-09 00:49:11', '2020-12-30', 'Voznq6gpMo.jpeg', '<p>about 555</p>', NULL),
(20, 'Labore explicabo enim dignissimos saepe.', 'labore-explicabo-enim-dignissimos-saepe', '<p>Et illum in reiciendis.</p>\r\n\r\n<p>Очень редкий случай, когда китайская компания не гонится за трендами и не пытается сделать максимально большой смартфон за свои деньги, а ищет баланс &mdash; и находит его, причем не забывая об эстетике. У vivo в лице V20 (и его младшего брата V20 SE) получился один из самых приятных смартфонов 2020-го &mdash; легкий, с матовой задней крышкой и дисплеем адекватных размеров. Причем прекрасно настроенным AMOLED-дисплеем. Добавим сюда еще Android 11 (и это первый смартфон на российском рынке с последним &laquo;роботом&raquo;) и лучшую как минимум в своем классе фронтальную камеру &mdash; и получим не просто прорывной для vivo смартфон, а одно из лучших предложений в ценовой категории 20-30 тысяч рублей.&nbsp;</p>', 10, 1, 0, 8354, 1, '2021-02-01 08:29:25', '2021-02-02 23:28:51', '2021-02-01', 'photo1.png', NULL, NULL),
(21, 'Quo cumque consequatur quia accusantium qui consequatur velit dolorem.', 'quo-cumque-consequatur-quia-accusantium-qui-consequatur-velit-dolorem', '<p>Quam molestias doloremque quos quos.</p>', 10, 1, 0, 8303, 0, '2021-02-01 08:29:25', '2021-02-02 23:29:05', '2021-02-01', 'photo1.png', NULL, NULL),
(22, 'Doloremque molestiae beatae illum numquam voluptatem sapiente.', 'doloremque-molestiae-beatae-illum-numquam-voluptatem-sapiente', 'Quibusdam cupiditate sequi vel velit esse.', 10, 1, 0, 6062, 0, '2021-02-01 08:29:25', '2021-02-01 08:29:25', '2021-02-01', 'photo1.png', NULL, NULL),
(23, 'Libero nostrum sed voluptatibus facere voluptatibus.', 'libero-nostrum-sed-voluptatibus-facere-voluptatibus', 'Distinctio assumenda et ab quod fugiat.', 10, 1, 0, 3815, 0, '2021-02-01 08:29:25', '2021-02-01 08:29:25', '2021-02-01', 'photo1.png', NULL, NULL),
(24, 'Sed aspernatur eum officia qui magni.', 'sed-aspernatur-eum-officia-qui-magni', 'Omnis totam quos non consequatur corrupti.', 10, 1, 0, 4397, 0, '2021-02-01 08:29:25', '2021-02-01 08:29:25', '2021-02-01', 'photo1.png', NULL, NULL),
(25, 'testkeys', 'testkeys', '<p>full text</p>', 7, 1, 0, 0, 0, '2021-02-09 01:02:40', '2021-02-09 01:10:01', '2021-02-08', NULL, '<p>descr</p>', '<p>keys321</p>'),
(26, 'qwerty', 'qwerty', '<p>Используется процессор Neo Quantum 8K, который, по словам производителя, предлагает оптимизацию ИИ для каждой сцены для улучшения общего качества изображения. Также имеется поддержка HDR10+ и масштабирования до 8K с помощью ИИ, при этом Samsung обещает 100-процентный охват цветового пространства DCI-P3. Всё это заключено в тонкий корпус Infinity Screen с антибликовым покрытием и более широкими углами обзора, чем в прошлом поколении.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>В серии QN900A также применяется технология Object Tracking Sound Pro (OTS Pro) для более точного позиционирования 3D-звука &mdash; она автоматически настраивается в зависимости от акустики помещения и установки устройства. В комплект входит тонкая подставка, или вместо неё дисплей можно разместить на стене. Благодаря функциональности Multi-view на экран можно выводить картинку из нескольких источников одновременно.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Цены начинаются с $4999,99 за 65-дюймовый QN900A, $6999,99 за 75-дюймовый и $8999,99 за 85-дюймовый телевизор. Предварительные заказы уже открыты, а на полки магазинов устройства поступят 13 марта. Что касается семейства Samsung Neo QLED 8K QN800A (более простая подсветка и менее продвинутый звук), то оно также выпускается в размерах 65&quot;, 75&quot; и 85&quot; по цене соответственно $3499,99, $4799,99 и $6499,99. Обе серии оснащены новым эко-пультом дистанционного управления Samsung, работающим от солнечной энергии.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Для тех, кто ещё не готов к 8K, компания ранее представила Neo QLED 4K 2021 года в сериях QN90A и QN85A. Они предлагается в размерах 55&quot;, 65&quot;, 75&quot; и 85&quot;.</p>\r\n\r\n<p>QN85A &mdash; самый доступный по цене телевизор с ценой $1599,99, $2199,99, $2999,99 и $4499,99 соответственно за диагонали 55&quot;, 65&quot;, 75&quot; и 85&quot;. По словам Samsung, все они появятся в свободной продаже к 20 марта. Телевизоры предлагают разрешение 4K и используют те же высокоточные пиксели Mini LED, что и модели 8K, а также предлагают поддержку масштабирования до 4K с помощью ИИ. Что касается QN90A, то стоимость составляет $1799,99, $2599,99, $3499,99 и $4999,99 соответственно за диагонали 55&quot;, 65&quot;, 75&quot; и 85&quot;. Все они появятся на полках магазинов до 6 марта.</p>', 1, 1, 0, 0, 0, '2021-02-09 01:18:26', '2021-02-09 01:21:31', '2021-02-24', NULL, 'Используется процессор Neo Quantum 8K, который, по словам производителя, предлагает оптимизацию ИИ для каждой сцены для улучшения общего качества изображения. Т...', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `post_tags`
--

CREATE TABLE `post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 11, 5, NULL, NULL),
(2, 12, 5, NULL, NULL),
(3, 13, 5, NULL, NULL),
(4, 14, 5, NULL, NULL),
(5, 16, 1, NULL, NULL),
(6, 16, 5, NULL, NULL),
(7, 17, 1, NULL, NULL),
(9, 18, 1, NULL, NULL),
(15, 20, 6, NULL, NULL),
(16, 21, 6, NULL, NULL),
(17, 19, 5, NULL, NULL),
(18, 19, 6, NULL, NULL),
(19, 20, 1, NULL, NULL),
(20, 20, 5, NULL, NULL),
(21, 19, 1, NULL, NULL),
(22, 21, 1, NULL, NULL),
(23, 21, 5, NULL, NULL),
(24, 25, 5, NULL, NULL),
(25, 25, 7, NULL, NULL),
(26, 26, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'comments', 1, NULL, '2021-02-13 12:18:38');

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(13, '25235@mail.de', 'PWKcfsPrxN1moQntc2FQsRtCUeYHLiyQZOj68z6JQcTeMvBTt0L97tMELmHkLifdmO7LRkYJkoV95tzmoNi4jY1UefyFZI1zP26O', '2021-02-06 06:06:56', '2021-02-06 06:06:56'),
(14, '4234@mail.de', NULL, '2021-02-06 06:19:15', '2021-02-06 06:24:16'),
(15, '234@mail.gr', NULL, '2021-02-06 06:24:40', '2021-02-06 06:24:48'),
(16, 'rerere@mail.com', NULL, '2021-02-06 06:25:09', '2021-02-06 06:25:17'),
(21, '1290853509@mail.de', NULL, '2021-02-07 09:57:06', '2021-02-07 09:57:06'),
(22, '00000000@mail.ru', NULL, '2021-02-07 09:57:12', '2021-02-07 09:57:12'),
(23, '42343@mail.de', NULL, '2021-02-07 09:59:00', '2021-02-07 09:59:00'),
(24, '324523@mail.de', NULL, '2021-02-07 09:59:28', '2021-02-07 09:59:28'),
(25, '23535@mail.de', NULL, '2021-02-07 09:59:34', '2021-02-07 09:59:34'),
(26, '23543@mail.de', NULL, '2021-02-07 10:00:18', '2021-02-01 10:00:18');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'top', 'yop', '2021-01-25 23:48:49', '2021-01-26 00:57:59'),
(5, 'auto', 'auto', '2021-01-29 07:56:07', '2021-01-29 07:56:07'),
(6, 'non', 'non', '2021-02-01 08:18:51', '2021-02-01 08:18:51'),
(7, 'quo', 'quo', '2021-02-01 08:18:52', '2021-02-01 08:18:52'),
(8, 'ad', 'ad', '2021-02-01 08:18:52', '2021-02-01 08:18:52'),
(9, 'in', 'in', '2021-02-01 08:18:52', '2021-02-01 08:18:52'),
(10, 'ea', 'ea', '2021-02-01 08:18:52', '2021-02-01 08:18:52');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `status`, `remember_token`, `created_at`, `updated_at`, `avatar`, `ban`, `sign`) VALUES
(1, 'admin', 'admin@mail.ie', '$2y$10$WWidwaoWbcf/E374nRYvN.rjgJEHAYGjRWEdxVO5lZtXb1eZHn8tm', 1, 0, NULL, '2021-02-05 07:25:47', '2021-02-09 04:57:28', '23.png', '0', 'Главный администратор'),
(30, 'user60', 'qw6e@mail.com', '$2y$10$qigO1csAFqGm8RwJ4fYC.u9IMhDE2XbuLop8HAqvEA33d0KNbpQFm', 0, 0, NULL, '2021-02-04 01:58:02', '2021-02-09 04:16:05', 'aFmmgGXpvT.png', '0', NULL),
(31, 'lamer', 'lamertrue@mail.ru', NULL, 0, 0, NULL, NULL, NULL, NULL, '0', NULL),
(32, '123', '235325@mail.de', '$2y$10$T6zImwPCJTwaxtlQPKnbYembiyJgUR24HSUqwLVd8tuWqEMmANWDS', 0, 0, NULL, '2021-02-08 07:53:13', '2021-02-09 04:17:04', NULL, '0', NULL),
(33, 'testuser2337', 'test2515215215213@gmail.com', '$2y$10$GUKOBtKAlrr1nsqLpP9q.OMz0UyUo4.UQyYc2AhfEGbvDSsNtYbRS', 0, 0, NULL, '2021-01-26 07:51:57', '2021-02-08 08:01:43', '23.png', '0', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
