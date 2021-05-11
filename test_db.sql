-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 5 月 11 日 09:26
-- サーバのバージョン： 8.0.23
-- PHP のバージョン: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `test_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_fpp` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `games`
--

INSERT INTO `games` (`id`, `title`, `is_fpp`, `updated_at`, `created_at`) VALUES
(1, 'pubg', 1, '2021-04-14 04:36:28', '2021-04-14 04:36:28'),
(2, 'apex', 1, '2021-04-14 05:37:47', '2021-04-14 05:37:47');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass_word` text NOT NULL,
  `play_style` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `is_vc` tinyint(1) NOT NULL DEFAULT '0',
  `active_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `pass_word`, `play_style`, `sex`, `is_vc`, `active_time`, `comment`, `updated_at`, `created_at`) VALUES
(2, 'abcd', '12345', 'アタッカー', '男', 1, '22:00~', 'お願いします', '2021-04-25 15:23:39', '2021-04-14 04:29:33'),
(3, 'れみい', 'abcde', NULL, NULL, 0, NULL, NULL, '2021-04-25 15:24:19', '2021-04-21 06:09:18'),
(84, 'jjj', '123456', '', '', 0, '', '', '2021-05-07 09:25:58', '2021-05-07 09:25:58'),
(85, 'jjj', '12344', '', '', 0, '', '', '2021-05-09 13:10:21', '2021-05-09 13:10:21'),
(86, 'remi', '123456', 'アタッカー', '男', 0, '22:00~', 'a', '2021-05-10 04:40:11', '2021-05-10 04:40:11');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_games`
--

CREATE TABLE `users_games` (
  `users_id` int NOT NULL,
  `game_id` int NOT NULL,
  `kill_rate` double DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `weapon` varchar(255) DEFAULT NULL,
  `ranking` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users_games`
--

INSERT INTO `users_games` (`users_id`, `game_id`, `kill_rate`, `map`, `weapon`, `ranking`, `user_name`, `updated_at`, `created_at`) VALUES
(2, 1, NULL, NULL, NULL, NULL, '', '2021-04-14 05:31:28', '2021-04-14 05:31:28'),
(2, 2, NULL, 'livik', '416', 'gold', '', '2021-04-14 05:38:17', '2021-04-14 05:38:17');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_games`
--
ALTER TABLE `users_games`
  ADD PRIMARY KEY (`users_id`,`game_id`),
  ADD KEY `users_games_gameid` (`game_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `users_games`
--
ALTER TABLE `users_games`
  ADD CONSTRAINT `users_games_gameid` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_games_userid` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
