-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2020 г., 15:01
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
-- База данных: `ecommerce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `anons` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(50) NOT NULL,
  `price` int(5) UNSIGNED NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `anons`, `text`, `img`, `price`, `category`) VALUES
(1, 'Мужские часы', 'Часы для мужчин', 'Часы которые практичны в бытовом пользовании', 'watch.jpg', 500, 'watches'),
(2, 'Часы ROLEX', 'Солидные мужские часы', 'Часы Rolex – это избранные материалы и внимание к каждой детали при сборке. Собственные разработка и производство каждого компонента отвечают высочайшим стандартам качества.', 'rolex.jpg', 20000, 'watches'),
(3, 'Ботинки мужские Dr. Martens', 'Мужские ботинки для холодной погоды', 'Удобные черные ботинки идеально подходят для зимы и поздней осени', 'shoes.jpg', 3500, 'shoes'),
(4, 'Футболка Supreme', 'Модная футболка Supreme', 'Данная футболка будет красиво на вас смотреться как и все остальные товары нашего магазина!', 'shirt.jpg', 2000, 'shirts'),
(5, 'Бейсболка gucci', 'Мужская бейсболка gucci', 'Яркая мужская бейсболка с прямым плотным козырьком выполнена из кожи с галечным фактурным узором на поверхности и дополнена вставкой из воздухопроницаемой сетки контрастного оттенка. Передняя планка украшена архивной печатной символикой бренда. Сзади имеется регулировочный кожаный ремешок, обеспечивающий идеальную посадку по обхвату головы. Сделано в Италии.', 'hat.jpg', 5000, 'hats'),
(6, 'Женские часы Lee Cooper LC06872.330', 'Красивые часы для женщин', 'Элегантные часы на удобном металлическом браслете покорят вас своим привлекательным дизайном и практичностью. Страна: Великобритания. Тип механизма: кварцевый. Калибр: Miyota 2035. Корпус: металл. Циферблат: серебристый. Браслет: металлический миланский. Водозащита: 30WR. Стекло: минеральное. Габаритные размеры: D 38мм.', 'w_watches.jpg', 15000, 'watches');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `pass`, `img`) VALUES
(1, 'Ноль Целковович', 'gleb-ruksha@rambler.ru', '$2y$10$wTwhPkm4LmSvOWKrZKKSbudDvFCiIq.krvpLBA/Vvqu/GemasD60S', 'noimage.jpg'),
(2, 'Gleb Ruksha', 'gleb-ruksha@ramler.ru', '$2y$10$oA1iY7AvKWQSyMd.wST9y.5gMiZlp.QFBqqICizHEb.7qqRZCtpB6', '1603735177.jpg'),
(7, 'Глеб Рукша', 'gleb-ruhas@rambler.ru', '$2y$10$jv.UINCabIRJxhrpWHngi.S8Ns3e8ub2nanoabWJIjqeVy.fxGZSW', 'noimage.jpg'),
(8, 'Vanish', 'glab-ruksha@rambler.ru', '$2y$10$0IjazYjg20zrjGcR6YfXouSa9bx0TsSjsTkUufiyGK4BoJYoycjq2', 'noimage.jpg'),
(9, 'Ноль Целковович', 'gleb-ruksha@rambler.run', '$2y$10$iJZg8lxv47NYP.whk1C6GOXvsktl2Lt978vjey6kUokXiZjbYUThW', 'noimage.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
