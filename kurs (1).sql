-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Июн 18 2024 г., 01:56
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kurs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basketball_courts`
--

CREATE TABLE `basketball_courts` (
  `id` int NOT NULL,
  `court_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `opening_hours` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `basketball_courts`
--

INSERT INTO `basketball_courts` (`id`, `court_name`, `address`, `phone`, `opening_hours`, `latitude`, `longitude`, `image_path`, `user_id`) VALUES
(18, 'Нижняя Дружба', ' Ростов-на-Дону, микрорайон Северный', 'не указано', 'не указано', '47.27851500', '39.71043900', '1718073730_1716133229_druzhbaniz.png', NULL),
(19, 'Гимназия 76', 'улица Волкова, 5/6', 'не указано', 'Пн-Сб: 7.50-19.20', '47.28548500', '39.71092500', NULL, NULL),
(20, '-', 'ул. Пацаева, 18, микрорайон Северный', 'не указан ', 'Пн-Вс: 9.00-21.00', '47.28172600', '39.70196800', NULL, NULL),
(21, 'Дружба', 'Ростов-на-Дону, парк Дружба', 'не указан', 'не указан', '47.28918400', '39.71763200', NULL, NULL),
(22, '-', ' Ростов-на-Дону, микрорайон Новое Поселение', 'не указано ', 'не указано ', '47.23610900', '39.69241400', NULL, NULL),
(23, 'Гребной канал Дон', 'Пойменная ул., 2А, микрорайон Заречная, Ростов-на-Дону', 'не указан ', 'Пн-Вс: 6.00-23.00', '47.20423500', '39.73371600', 'grebnoy.jpg', NULL),
(24, 'Вертолетное поле', 'ул. Труженников 33а', 'не указан', 'не указано', '47.20124200', '39.65142100', NULL, NULL),
(25, 'I. S. Basketball Academy', 'Ахтарский пер., 1', '+7 (919) 878-17-98', 'Вт,Чт,Сб: 9.00-18.00', '47.23816600', '39.71785300', NULL, NULL),
(26, 'Красный Аксай ', 'Ростов-на-Дону, жилой комплекс Красный Аксай', 'не указан ', 'Пн-Вс: 8.00-23.00', '47.22592200', '39.77798400', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `basketball_courts_temporary`
--

CREATE TABLE `basketball_courts_temporary` (
  `id` int NOT NULL,
  `court_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `opening_hours` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `basketball_courts_temporary`
--

INSERT INTO `basketball_courts_temporary` (`id`, `court_name`, `address`, `phone`, `opening_hours`, `latitude`, `longitude`, `image_path`, `user_id`) VALUES
(34, 'Звездный', 'ул. Пацаева, 18, микрорайон Северный', 'не указан', 'Пн-Вс: 9:00-21:00', '47.20124200', '39.71043900', NULL, NULL),
(35, 'ДГТУ', 'Гагарина, 1', '8 888 888-88-88', 'Пн-Пт: 10:00-20:00; Сб-Вс: 9:00-18:00', NULL, NULL, NULL, NULL),
(36, 'ДГТУ', 'Гагарина, 1', 'ц', 'йу', NULL, NULL, NULL, 8),
(37, 'ц', 'ул. Пацаева, 18, микрорайон Северный', '8 888 888-88-88', 'fsa', '47.20124200', '39.71092500', NULL, 8),
(38, 'ц', 'ул. Пацаева, 18, микрорайон Северный', '8 888 888-88-88', 'Пн-Пт: 10:00-20:00; Сб-Вс: 9:00-18:00', '47.20124200', '39.71043900', NULL, 8),
(39, 'ДГТУ', 'ц', 'ццй', 'йу', '47.20124200', '39.71092500', 'uploads/66a385bfe0e26c2b41b5f5702a759773.JPG', 8),
(40, 'ДГТУ', 'Гагарина, 1', 'не указан', 'Пн-Пт: 10:00-20:00; Сб-Вс: 9:00-18:00', NULL, NULL, NULL, 11),
(41, 'ц', 'Гагарина, 1', '8 888 888-88-88', 'АВ', NULL, NULL, NULL, 11),
(42, 'ДГТУ', 'ц', 'ц', 'fsa', NULL, NULL, NULL, 11),
(44, 'ДГТУ', 'Гагарина, 1', '8 888 888-88-88', 'ц', NULL, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `registration_date`) VALUES
(6, 'alexey', '$2y$10$1Z8kIjJEb7JxR2qeBPIeQOdlevItmwXqgWgn4bqnTY4AWoxF1cRZO', 'lll@test.com', NULL),
(7, 'vova', '$2y$10$eDcYM7RQENVRzDi9dzU2beh9au9jL9Gb1RwvhIdZC6mtfVwW2juD.', 'lll@test.com', NULL),
(8, 'admin', '$2y$10$VQ6wNOhqOwB95ffYJLKr4Ory3a.OFPWfNj1PjAZsuC1DPpKHwHRiy', 'admin@test.ru', NULL),
(9, 'user', '$2y$10$0yqMIA7D7nT3omkzGEYzfulV5BOuuOo7yHIiZVDKYfpE9I6u4nWD.', 'user@test.ru', NULL),
(10, 'user2', '$2y$10$cnrXk57YSvGRb0jSQKLlLONKpIx0cuYEOElYQzH8xh/aqujFrTYCu', 'lll@test.com', NULL),
(11, 'user555', '$2y$10$em0xtfuyK1FR/ZOJAHqKiOyTneg167jlBLySTEq4Z0oprI7fvhy4K', 'lll@test.com', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basketball_courts`
--
ALTER TABLE `basketball_courts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_basketball_courts_user` (`user_id`);

--
-- Индексы таблицы `basketball_courts_temporary`
--
ALTER TABLE `basketball_courts_temporary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_basketball_courts_temporary_user` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basketball_courts`
--
ALTER TABLE `basketball_courts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `basketball_courts_temporary`
--
ALTER TABLE `basketball_courts_temporary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basketball_courts`
--
ALTER TABLE `basketball_courts`
  ADD CONSTRAINT `fk_basketball_courts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `basketball_courts_temporary`
--
ALTER TABLE `basketball_courts_temporary`
  ADD CONSTRAINT `fk_basketball_courts_temporary_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
