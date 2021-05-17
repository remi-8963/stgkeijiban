-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 5 月 17 日 07:18
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
-- テーブルの構造 `timelines`
--

CREATE TABLE `timelines` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `text` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `timelines`
--

INSERT INTO `timelines` (`id`, `user_id`, `text`, `updated_at`, `created_at`) VALUES
(1, 3, 'test', '2021-05-16 13:32:08', '2021-05-16 13:32:08'),
(2, 3, 'abcde', '2021-05-16 14:33:10', '2021-05-16 14:33:10'),
(3, 3, 'abcde', '2021-05-16 14:33:54', '2021-05-16 14:33:54'),
(4, 3, 'あいうえお', '2021-05-16 14:34:12', '2021-05-16 14:34:12'),
(5, 3, 'あいう', '2021-05-16 14:40:19', '2021-05-16 14:40:19'),
(6, 3, '<script>alert(\'xss\')</script>', '2021-05-16 14:45:15', '2021-05-16 14:45:15'),
(7, 3, '', '2021-05-17 05:03:34', '2021-05-17 05:03:34'),
(8, 3, 'a', '2021-05-17 05:42:07', '2021-05-17 05:42:07'),
(9, 3, '1234567890', '2021-05-17 05:47:48', '2021-05-17 05:47:48'),
(10, 86, 'a', '2021-05-17 05:52:09', '2021-05-17 05:52:09'),
(11, 86, 'q', '2021-05-17 06:12:46', '2021-05-17 06:12:46'),
(12, 3, 'r', '2021-05-17 06:23:54', '2021-05-17 06:23:54'),
(13, 3, 'y', '2021-05-17 07:04:53', '2021-05-17 07:04:53');

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
-- テーブルのインデックス `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timelines_users_id` (`user_id`);

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
-- テーブルの AUTO_INCREMENT `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `timelines`
--
ALTER TABLE `timelines`
  ADD CONSTRAINT `timelines_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
