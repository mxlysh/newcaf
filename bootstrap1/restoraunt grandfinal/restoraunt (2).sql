-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 15 2024 г., 10:02
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `restoraunt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id_dish` int(11) NOT NULL,
  `dish` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id_dish`, `dish`) VALUES
(1, 'Борщ'),
(2, 'Сало'),
(3, 'Картофель молодой печёный'),
(4, 'Торт \"Медовик\"');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `id_dish` int(255) NOT NULL,
  `table` int(255) NOT NULL,
  `number_of_people` int(255) NOT NULL,
  `status_pay` text NOT NULL,
  `status_ready` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_orders`, `id_dish`, `table`, `number_of_people`, `status_pay`, `status_ready`, `id_user`) VALUES
(1, 1, 1, 2, 'Оплачено', 'не готово', 7),
(2, 2, 1, 3, 'Не оплачено', 'не готово', 6),
(5, 3, 4, 4, 'Оплачено', 'готово', 7),
(6, 2, 2, 2, 'Оплачено', 'готово', 7),
(7, 1, 1, 8, 'Оплачено', 'не готово', 7),
(9, 1, 1, 1, 'Оплачено', 'не готово', 6),
(18, 1, 1, 1, 'Оплачено', 'Не готов', 6),
(19, 1, 1, 1, 'Оплачено', 'Не готов', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `shift`
--

CREATE TABLE `shift` (
  `id_shift` int(11) NOT NULL,
  `id_user_shift` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shift`
--

INSERT INTO `shift` (`id_shift`, `id_user_shift`, `time_start`, `time_end`, `date`) VALUES
(1, 7, '04:20:00', '10:13:00', '2024-02-13'),
(2, 10, '08:08:00', '14:05:00', '2024-02-13'),
(3, 7, '14:12:00', '18:15:00', '2024-02-22'),
(4, 9, '16:40:00', '18:50:00', '2024-02-16'),
(5, 9, '14:51:00', '16:54:00', '2024-02-17'),
(6, 6, '14:51:00', '16:54:00', '2024-02-17'),
(7, 6, '14:04:00', '17:02:00', '2024-02-23');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `status` text NOT NULL,
  `user_shift` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `name`, `surname`, `password`, `role`, `status`, `user_shift`) VALUES
(4, 'Egor', 'Malyshenko', 'nikinem12345', 'Admin', '', '0000-00-00'),
(5, 'Ivan', 'Nasibulin', '123123', 'Cook', 'fired', '0000-00-00'),
(6, 'Grisha', 'Lebedev', '321321', 'Waiter', 'fired', '0000-00-00'),
(7, 'Nikita', 'Chipichapa', '112233', 'cook', 'fired', '0000-00-00'),
(9, 'Vasya ', 'Liliput', '098098', 'waiter', 'fired', '0000-00-00'),
(10, 'Rasim ', 'Aliev', '7788', 'cook', 'fired', '0000-00-00'),
(11, 'Sasha', 'Ruk', '554433', 'cook', 'fired', '0000-00-00'),
(13, 'Alena', 'Dance', '443322', 'cook', 'fired', '0000-00-00'),
(25, 'Крипто', 'Иванбум', '000444', 'waiter', 'fired', '0000-00-00'),
(26, 'Руслан ', 'Иванов', '44976', 'admin', 'work', '0000-00-00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_dish`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `Orders_fk0` (`id_dish`),
  ADD KEY `Orders_fk1` (`id_user`);

--
-- Индексы таблицы `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id_shift`),
  ADD KEY `Shift_fk0` (`id_user_shift`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id_dish` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `shift`
--
ALTER TABLE `shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_fk0` FOREIGN KEY (`id_dish`) REFERENCES `menu` (`id_dish`),
  ADD CONSTRAINT `Orders_fk1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `Shift_fk0` FOREIGN KEY (`id_user_shift`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
