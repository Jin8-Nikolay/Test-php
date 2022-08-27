-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 27 2022 г., 20:15
-- Версия сервера: 5.7.38
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `date`, `author`) VALUES
(1, 'Review 1', 'Text', '2022-08-25 00:00:00', 2),
(3, 'Review 3', 'Text 3', '2022-08-27 00:00:00', 6),
(4, 'Review 2', 'Text 2', '2022-08-27 19:08:46', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) DEFAULT '2',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', '7bzEb74P7uBG1FktlJh15qRK_MwDfV_r', '$2y$13$andHTqEjMzeDiyxsLQaSteWJORBN4ZAZGXKgV38v/px7kpCFBIQ1q', NULL, 'admin@example.com', 1, 10, 1661416487, 1661416487, 'D34sHWod8bX4G8iIc-hN4eMmQlKcSwMz_1661416486'),
(2, 'manager', 'clXpAJa21N5X1w3WCRoI_oTrJaz6g8EJ', '$2y$13$a8.x9vbKxLRHm7c6ZkS99.8DxufqBC5hSLWXtFIjAhZ.jRUv2AI3C', NULL, 'manager@example.com', 2, 10, 1661417224, 1661417224, 'sLbZTgsY4QdmI460ZcVGt6Bdk2WMxTF-_1661417224'),
(4, 'manager3', 'bkNncgYup3X7wL0LZDLB4pWCHIMxfr3V', '$2y$13$QORfu13U0DqlT87QO.BAZ.TY1O/ubB2VYWcTZrbjy9pQ8SF8Im466', NULL, 'manager3@example.com', 2, 10, 1661613644, 1661613644, 'NK8WjNemKH2xdHvqcvA_ISdib06SoS_z_1661613644'),
(5, 'manager4', '3_7TaxIcr5IohGpSu1ejg6I0YEpewnNs', '$2y$13$jUmIEs/BKzYt2i4/yn3r/uPfQ7PfjqARUO8G315g7i32Dz18KJgm2', NULL, 'manager4@example.com', 2, 10, 1661613693, 1661613693, '5Mevuc4FRUskXXbCgiEpUixcaYTvFvEq_1661613693'),
(6, 'manager5', '4sOiHB9WtTNOUqzmoJgwFCMpmCg7VAdq', '$2y$13$nhNg21TC67mpwx5KtqWJW.y8YACqldxarZziNw18itoR2K0QBtMEe', NULL, 'manager5@example.com', 2, 10, 1661613776, 1661613776, '7ZEUtIzIKuPdpjkJ01ZJZYOshQilCbQS_1661613776'),
(7, 'manager2', 'SITnJd89IpG70FlbetI0_PIAuJdVtoc8', '$2y$13$LLjrRE3EgjP4B.9uFNM19OaHLCEojQwJkf0KkwIwadLwUBvf6S/Ge', NULL, 'manager2@example.com', 2, 10, 1661613827, 1661613827, '3otl84xYiogeue5aNhAeruvea7JLIqQV_1661613827'),
(8, 'admin2', 'DHQjqqn1ETg84kGvgaPtqLpv6kn0n4YS', '$2y$13$rAVftiuiKFx5uJ5.oMMTGedwr0uEtc96oRwi1x0C0FYyItHx.3MVK', NULL, 'admin2@example.com', 1, 10, 1661614858, 1661614858, 'e9JTP4uDm10j3fEBwOD-OgsR22IqaxRe_1661614858'),
(9, 'admin3', 'Ad_z-WmZOCN_cSrXEa01pNX_44QbSVZa', '$2y$13$sorlKW0Cds4CyUp2zDRVs.j2jPBWHsIbK7ealYJpG/YWyDo.oii2q', NULL, 'admin3@example.com', 1, 10, 1661619620, 1661619620, 'mGce7CWVF8BcAX1ck1LiuuYaiNoFDTFI_1661619620');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reviews-author` (`author`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews-author` FOREIGN KEY (`author`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
