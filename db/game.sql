-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 16 2023 г., 06:27
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

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(256) NOT NULL,
  `developers` varchar(256) NOT NULL,
  `old_price` decimal(8,2) NOT NULL,
  `new_price` decimal(8,2) NOT NULL,
  `release_date` date NOT NULL,
  `photo` text NOT NULL,
  `screenshot_1` text NOT NULL,
  `screenshot_2` text NOT NULL,
  `screenshot_3` text NOT NULL,
  `description` text NOT NULL,
  `poster` text NOT NULL,
  `genre` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`game_id`, `game_name`, `developers`, `old_price`, `new_price`, `release_date`, `photo`, `screenshot_1`, `screenshot_2`, `screenshot_3`, `description`, `poster`, `genre`) VALUES
(1, 'Minecraft', 'Mojang Studios', 26.95, 26.95, '2011-11-18', 'images/minecraft.jpg', 'images/Screenshots/minecraft_1.png', 'images/Screenshots/minecraft_2.png', 'images/Screenshots/minecraft_3.png', 'Minecraft is a sandbox video game...', 'images/Posters/MINECRAFT_POSTER.jpg', 'Sandbox'),
(2, 'Grand Theft Auto V', 'Rockstar North', 29.99, 14.99, '2013-09-17', 'images/GTAV4K.jpg', 'images/Screenshots/gtav_1.png', 'images/Screenshots/gtav_2.png', 'images/Screenshots/gtav_3.png', 'Grand Theft Auto V is an action-adventure game...', 'images/Posters/GTAV_POSTER.jpg', 'Action'),
(3, 'The Elder Scrolls V: Skyrim', 'Bethesda Game Studios', 19.99, 9.99, '2011-11-11', 'images/Skyrim.jpg', 'images/Screenshots/skyrim_1.png', 'images/Screenshots/skyrim_2.png', 'images/Screenshots/skyrim_3.png', 'The Elder Scrolls V: Skyrim is an open-world action role-playing game...', 'images/Posters/SKYRIM_POSTER.jpg', 'RPG'),
(4, 'The Legend of Zelda: Breath of the Wild', 'Nintendo EPD', 59.99, 49.99, '2017-03-03', 'images/Zelda.png', 'images/Screenshots/zelda_1.png', 'images/Screenshots/zelda_2.png', 'images/Screenshots/zelda_3.png', 'The Legend of Zelda: Breath of the Wild is an action-adventure game...', 'images/Posters/Zelda_POSTER.jpg', 'Action'),
(5, 'Fortnite', 'Epic Games', 0.00, 0.00, '2017-07-25', 'images/FORTNITE.jpg', 'images/Screenshots/fortnite_1.png', 'images/Screenshots/fortnite_2.png', 'images/Screenshots/fortnite_3.png', 'Fortnite is a battle royale game where players compete against each other to be the last one standing...', 'images/Posters/FORTNITE_POSTER.jpg', 'Action'),
(6, 'Red Dead Redemption 2', 'Rockstar Games', 59.99, 39.99, '2018-10-26', 'images/game1.jpg', 'images/Screenshots/rdr2_1.png', 'images/Screenshots/rdr2_2.png', 'images/Screenshots/rdr2_3.png', 'Red Dead Redemption 2 is an open-world action-adventure game set in the American Old West...', 'images/Posters/RDR2_POSTER.jpg', 'Action'),
(7, 'The Witcher 3: Wild Hunt', 'CD Projekt Red', 39.99, 19.99, '2016-05-19', 'images/game2.jpg', 'images/Screenshots/tw3_1.png', 'images/Screenshots/tw3_2.png', 'images/Screenshots/tw3_3.png', 'The Witcher 3: Wild Hunt is an open-world action role-playing game...', 'images/Posters/TW3_POSTER.jpg', 'RPG'),
(8, 'Resident Evil Village', 'Capcom', 59.99, 49.99, '2021-05-07', 'images/Posters/REVII_POSTER.jpg', 'images/Screenshots/re8_1.png', 'images/Screenshots/re8_2.png', 'images/Screenshots/re8_3.png', 'Resident Evil Village is a survival horror game and the eighth main installment in the Resident Evil series...', 'images/Posters/REVII_POSTER.jpg', 'Survival horror'),
(9, 'Elden Ring', 'FromSoftware', 59.99, 49.99, '2022-01-21', 'images/game3.jpg', 'images/Screenshots/er_1.png', 'images/Screenshots/er_2.png', 'images/Screenshots/er_3.png', 'Elden Ring is an upcoming action role-playing game developed by FromSoftware and published by Bandai Namco Entertainment...', 'images/Posters/ELDENRING_POSTER.jpg', 'RPG'),
(10, 'Nier Automata', 'PlatinumGames', 59.99, 39.99, '2017-02-23', 'images/NIER.jpg', 'images/Screenshots/nier_automata_1.png', 'images/Screenshots/nier_automata_2.png', 'images/Screenshots/nier_automata_3.png', 'Nier Automata is an action role-playing video game developed by PlatinumGames and published by Square Enix...', 'images/Posters/NIER_POSTER.jpg', 'Action'),
(11, 'Cyberpunk 2077', 'CD Projekt', 59.99, 39.99, '2020-12-10', 'images/cyberpunk_2077.jpg', 'images/Screenshots/cyberpunk_1.png', 'images/Screenshots/cyberpunk_2.png', 'images/Screenshots/cyberpunk_3.png', 'Cyberpunk 2077 is an action role-playing game...', 'images/Posters/CYBERPUNK_2077_POSTER.jpg', 'Action RPG'),
(12, 'Mortal Kombat', 'NetherRealm Studios', 59.99, 59.99, '1992-10-08', 'images/mortal_kombat.jpg', 'images/Screenshots/mortal_kombat_1.png', 'images/Screenshots/mortal_kombat_2.png', 'images/Screenshots/mortal_kombat_3.png', 'Mortal Kombat is a classic fighting game known for its intense battles and iconic characters.', 'images/Posters/MORTAL_KOMBAT_POSTER.jpg', 'Fighting'),
(13, 'Tekken', 'Bandai Namco Entertainment', 49.99, 49.99, '0000-00-00', 'images/tekken.jpg', 'images/Screenshots/tekken_1.png', 'images/Screenshots/tekken_2.png', 'images/Screenshots/tekken_3.png', 'Tekken is a popular fighting game...', 'images/Posters/TEKKEN_POSTER.jpg', 'Fighting');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
