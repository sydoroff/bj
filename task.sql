-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 01 2019 г., 02:42
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `name`, `email`, `text`, `status`, `create_at`, `hash`) VALUES
(1, 'Djohn', '1@mail.com', 'Bla bla bla....\r\n1. -\r\n2. -dfdgvxc\r\n3. -\r\n\r\nend', 1, '2019-03-31 20:05:44', NULL),
(2, 'Djohn', '2@mail.com', 'Bla bla bla....\r\n1. -\r\n2. -\r\n3. -\r\n\r\nend', NULL, '2019-03-31 20:05:44', NULL),
(3, 'Sid', '3@mail.com', '1\r\n2\r\n34\r\n56677', NULL, '2019-03-31 20:05:44', NULL),
(4, 'Rrr', '4@mail.com', '4\r\n5\r\n6\r\n7\r\n89', NULL, '2019-03-31 20:05:44', NULL),
(5, 'Sid', '3@mail.com', '1\r\n2\r\n34\r\n56677', NULL, '2019-03-31 20:05:44', NULL),
(6, 'Rrr', '4@mail.com', '4\r\n5\r\n6\r\n7\r\n89', NULL, '2019-03-31 20:05:44', NULL),
(7, 'Siddd', '3@mail.com', '1\r\n2\r\n34\r\n56677', NULL, '2019-03-31 20:05:44', NULL),
(8, 'Rrdddr', '4@mail.com', '4\r\n5\r\n6\r\n7\r\n89', NULL, '2019-03-31 20:05:44', NULL),
(9, 'admin', 'vasya-petya@gmail.com', '123123\r\n123\r\n12\r\n3іфваф\r\nіафіа', NULL, '2019-04-01 00:12:48', 'admin222009538.28571'),
(10, 'admin', 'vasya-petya@gmail.com', 'asdfasfd\r\nsafsdfasfasf', NULL, '2019-04-01 00:17:21', '$2y$10$yh65i5iab0me2WtzOOmig.Bq8W3/l81vHS9eFAgnfhf8HODflPA.G'),
(11, 'sdfdsf', 'ssdf@gmail.com', 'sdhsdf', NULL, '2019-04-01 00:31:43', '$2y$10$ETHttb47fKHB5leJqSJ9CuH5HsTDZDm0Q5sUhFzlRqaiTqolywa/O'),
(12, 'sdfdsf', 'ssdf@gmail.com', 'sdhsdf', NULL, '2019-04-01 00:32:26', '$2y$10$fX/rUbbv/nt2nscKqUUcuOp0bV64x1d4bK.cW7SZjtLvNwjcvFUz2'),
(13, 'user7', '2sdfsdf@gmail.com', 'dgdsgsdgdsg', NULL, '2019-04-01 00:36:08', '$2y$10$WY4xgq6Sl17CbU/8PCMz2O/AbhBsEVBwa7bQ1F1HIzcb2seBj/ery'),
(14, 'admin1', 'vasya-petya@gmail.com', 'sdtgsrg', NULL, '2019-04-01 00:38:10', '$2y$10$.Zg6NvzFEpBiIRJOfVgTwevmu6sryfi7rlZBeDEngJ0V.0rJjSSRO'),
(15, 'admin', 'vasya-petya@gmail.com', 'fghfghfh', NULL, '2019-04-01 00:39:34', '$2y$10$H.WDmUOaz50zsh14UFC5ZOgoVztM4NKL6MUKMaR3fl5zH0id20S9y'),
(16, 'admin1', 'vasya-petya@gmail.com', 'sdfsdf\r\ns\r\nfs\r\nfs', NULL, '2019-04-01 00:42:56', '$2y$10$JRN8Pls7I8lRCIO2Ww4c.O4/L7Bq1.Q/mKnZXYh1aIkOK5Y/Q.YJi'),
(17, 'user7', 'vasya-petya@gmail.com', 'dfhdfhfdhfdh\r\nxcvxvxcv\r\nsdf\r\nxxcvxcv', 1, '2019-04-01 00:45:27', '$2y$10$sBSIQt5ku0IiyGyfwg7q/OXu0qVyIZ/WhOgF74Me2pmBTwdICQfyG'),
(18, 'товар 23', 'vasya-petya@gmail.com', 'cgj\r\n\r\nj\r\ng\r\ncgj', NULL, '2019-04-01 00:50:01', '$2y$10$OAUZ32qfaszRLeOU5hNxlu3JtzgEBiwyMhXo359M0JmkO.6Ot/NDG'),
(19, 'admin', 'vasya-petya@gmail.com', 'zgzdfzdgzgz', NULL, '2019-04-01 00:52:36', '$2y$10$IvcdIXyCld0JJ4/CpKODKeceZP/7NtDdcArVlqQAS9RjcPckA.wLS');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
