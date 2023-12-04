-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 02 2023 г., 15:09
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gamestore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(256) NOT NULL,
  `developers` varchar(256) NOT NULL,
  `old_price` decimal(8,2) NOT NULL,
  `new_price` decimal(8,2) NOT NULL,
  `release_date` date NOT NULL,
  `photo` text DEFAULT NULL,
  `screenshot_1` text DEFAULT NULL,
  `screenshot_2` text DEFAULT NULL,
  `screenshot_3` text DEFAULT NULL,
  `description` text NOT NULL,
  `poster` text DEFAULT NULL,
  `genre` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `games` (`game_id`, `game_name`, `developers`, `old_price`, `new_price`, `release_date`, `photo`, `screenshot_1`, `screenshot_2`, `screenshot_3`, `description`, `poster`, `genre`) VALUES
(1, 'Minecraft', 'Mojang Studios', 26.95, 26.95, '2011-11-18', 'images/photo/minecraft.jpg', 'images/Screenshots/minecraft_1.png', 'images/Screenshots/minecraft_2.png', 'images/Screenshots/minecraft_3.png', 'Minecraft is a sandbox video game...', 'images/Posters/MINECRAFT_POSTER.jpg', 'Sandbox'),
(2, 'Grand Theft Auto V', 'Rockstar North', 29.99, 14.99, '2013-09-17', 'images/photo/GTAV4K.jpg', 'images/Screenshots/gtav_1.png', 'images/Screenshots/gtav_2.png', 'images/Screenshots/gtav_3.png', 'Grand Theft Auto V is an action-adventure game...', 'images/Posters/GTAV_POSTER.jpg', 'Action'),
(3, 'The Elder Scrolls V: Skyrim', 'Bethesda Game Studios', 19.99, 9.99, '2011-11-11', 'images/photo/Skyrim.jpg', 'images/Screenshots/skyrim_1.png', 'images/Screenshots/skyrim_2.png', 'images/Screenshots/skyrim_3.png', 'The Elder Scrolls V: Skyrim is an open-world action role-playing game...', 'images/Posters/SKYRIM_POSTER.jpg', 'RPG'),
(4, 'The Legend of Zelda: Breath of the Wild', 'Nintendo EPD', 59.99, 49.99, '2017-03-03', 'images/photo/Zelda.png', 'images/Screenshots/zelda_1.png', 'images/Screenshots/zelda_2.png', 'images/Screenshots/zelda_3.png', 'The Legend of Zelda: Breath of the Wild is an action-adventure game...', 'images/Posters/Zelda_POSTER.jpg', 'Action'),
(5, 'Fortnite', 'Epic Games', 0.00, 0.00, '2017-07-25', 'images/photo/FORTNITE.jpg', 'images/Screenshots/fortnite_1.png', 'images/Screenshots/fortnite_2.png', 'images/Screenshots/fortnite_3.png', 'Fortnite is a battle royale game where players compete against each other to be the last one standing...', 'images/Posters/FORTNITE_POSTER.jpg', 'Action'),
(6, 'Red Dead Redemption 2', 'Rockstar Games', 59.99, 39.99, '2018-10-26', 'images/photo/game1.jpg', 'images/Screenshots/rdr2_1.png', 'images/Screenshots/rdr2_2.png', 'images/Screenshots/rdr2_3.png', 'Red Dead Redemption 2 is an open-world action-adventure game set in the American Old West...', 'images/Posters/RDR2_POSTER.jpg', 'Action'),
(7, 'The Witcher 3: Wild Hunt', 'CD Projekt Red', 39.99, 19.99, '2016-05-19', 'images/photo/game2.jpg', 'images/Screenshots/tw3_1.png', 'images/Screenshots/tw3_2.png', 'images/Screenshots/tw3_3.png', 'The Witcher 3: Wild Hunt is an open-world action role-playing game...', 'images/Posters/TW3_POSTER.jpg', 'RPG'),
(8, 'Resident Evil Village', 'Capcom', 59.99, 49.99, '2021-05-07', 'images/Posters/REVII_POSTER.jpg', 'images/Screenshots/re8_1.png', 'images/Screenshots/re8_2.png', 'images/Screenshots/re8_3.png', 'Resident Evil Village is a survival horror game and the eighth main installment in the Resident Evil series...', 'images/Posters/REVII_POSTER.jpg', 'Survival horror'),
(9, 'Elden Ring', 'FromSoftware', 59.99, 49.99, '2022-01-21', 'images/photo/game3.jpg', 'images/Screenshots/er_1.png', 'images/Screenshots/er_2.png', 'images/Screenshots/er_3.png', 'Elden Ring is an upcoming action role-playing game developed by FromSoftware and published by Bandai Namco Entertainment...', 'images/Posters/ELDENRING_POSTER.jpg', 'RPG'),
(10, 'Nier Automata', 'PlatinumGames', 59.99, 39.99, '2017-02-23', 'images/photo/NIER.jpg', 'images/Screenshots/nier_automata_1.png', 'images/Screenshots/nier_automata_2.png', 'images/Screenshots/nier_automata_3.png', 'Nier Automata is an action role-playing video game developed by PlatinumGames and published by Square Enix...', 'images/Posters/NIER_POSTER.jpg', 'Action'),
(11, 'Cyberpunk 2077', 'CD Projekt', 50.99, 39.99, '2020-12-10', 'images/photo/cyberpunk_2077.jpg', 'images/Screenshots/cyberpunk_1.png', 'images/Screenshots/cyberpunk_2.png', 'images/Screenshots/cyberpunk_3.png', 'Cyberpunk 2077 is an action role-playing game...', 'images/Posters/CYBERPUNK_2077_POSTER.jpg', 'Action RPG'),
(12, 'Mortal Kombat', 'NetherRealm Studios', 59.99, 59.99, '2019-01-26', 'images/photo/mortal_kombat.jpg', 'images/Screenshots/mortal_kombat_1.png', 'images/Screenshots/mortal_kombat_2.png', 'images/Screenshots/mortal_kombat_3.png', 'Mortal Kombat is a classic fighting game known for its intense battles and iconic characters.', 'images/Posters/MORTAL_KOMBAT_POSTER.jpg', 'Fighting'),
(13, 'Tekken', 'Bandai Namco Entertainment', 49.99, 49.99, '2017-01-27', 'images/photo/tekken.jpg', 'images/Screenshots/tekken_1.png', 'images/Screenshots/tekken_2.png', 'images/Screenshots/tekken_3.png', 'Tekken is a popular fighting game...', 'images/Posters/TEKKEN_POSTER.jpg', 'Fighting'),
(29, '', '', 0.00, 0.00, '0000-00-00', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`review_id`, `game_id`, `user_id`, `rating`, `comment`, `review_date`) VALUES
(7, 2, 1, 10, 'THE BEST open world game!', '2023-11-18 18:27:44'),
(9, 8, 1, 6, 'Overrated IMO', '2023-11-18 18:29:47'),
(16, 13, 1, 6, 'not mk', '2023-11-19 19:54:59'),
(21, 1, 1, 10, 'Game of childhood!', '2023-11-26 22:25:22'),
(22, 11, 1, 10, 'ok', '2023-11-26 22:26:01'),
(24, 10, 1, 10, 'Masterpiece!', '2023-11-27 04:54:53');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `registration_date` date NOT NULL,
  `avatar_url` text NOT NULL DEFAULT 'no_avatar.jpg',
  `password` text NOT NULL,
  `role` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `registration_date`, `avatar_url`, `password`, `role`) VALUES
(1, 'Sayan', 'sayan@gmail.com', '0000-00-00', '1701060828Screenshot 2023-08-21 150346.png', '2ac9cb7dc02b3c0083eb70898e549b63', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `unique_user_game_review` (`user_id`,`game_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
