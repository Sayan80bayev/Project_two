-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 19 2023 г., 09:34
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
-- Структура таблицы `friend`
--

CREATE TABLE `friend` (
  `friendship_id` int(11) NOT NULL,
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL,
  `friendship_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Структура таблицы `library`
--

CREATE TABLE `library` (
  `library_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 11, 1, 10, 'Best game of my life', '2023-11-17 18:00:00'),
(2, 11, 4, 10, 'Masterpiece', '2023-11-17 18:00:00'),
(3, 12, 1, 9, 'One of my favourite games ever!', '2023-11-18 18:24:54'),
(7, 2, 1, 8, 'THE BEST open world game!', '2023-11-18 18:27:44'),
(9, 8, 1, 6, 'Overrated IMO', '2023-11-18 18:29:47'),
(15, 10, 1, 9, 'The best music in game industry! Yoko Taro is genius!', '2023-11-19 07:39:40');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `registration_date`, `avatar_url`, `password`) VALUES
(1, 'Sayan', 'sayan@gmail.com', '0000-00-00', 'no_avatar.jpg', '3749dae01a0bc2482673fe8135c7cc15'),
(4, 'Beka', 'beka@gmail.com', '0000-00-00', 'no_avatar.jpg', '6f9dff5af05096ea9f23cc7bedd65683');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`friendship_id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- Индексы таблицы `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`library_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `unique_user_game_review` (`user_id`,`game_id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

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
-- AUTO_INCREMENT для таблицы `friend`
--
ALTER TABLE `friend`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `library`
--
ALTER TABLE `library`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `library`
--
ALTER TABLE `library`
  ADD CONSTRAINT `library_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `library_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`);

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
