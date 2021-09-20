<?php

// 主キーが被ったとき
// ON DUPLICATE KEY UPDATE `kill_rate` = "$kill_rate", `map` = "$map", `weapon`  = $weapon, `ranking` = $ranking

// UPSERT

// list → edit → *update

require_once('common.php');
require_logged_in();

$user_id = ($_SESSION['user_id'] ?? null) or header('Location: index.php');
$game_id = ($_POST['game_id'] ?? null) or header('Location: index.php');
$user_name = ($_POST['user_name'] ?? null) or header('Location: index.php');
$kill_rate = ($_POST['kill_rate'] ?? null) or header('Location: index.php');
$damage = ($_POST['damage'] ?? null) or header('Location: index.php');
$map = ($_POST['map'] ?? null) or header('Location: index.php');
$weapon = ($_POST['weapon'] ?? null) or header('Location: index.php');
$ranking = ($_POST['ranking'] ?? null) or header('Location: index.php');

if($user_name === '') {
    header('Location: user_game_edit.php');
    exit();
}


$sql = sprintf('INSERT INTO users_games (user_id, game_id, user_name, kill_rate, damage, map, weapon, ranking) VALUES (%d, %d, "%s", %f, %f, "%s", "%s", "%s") ON DUPLICATE KEY UPDATE `user_name` = "%s", `kill_rate` = %f, `damage` = %f, `map` = "%s", `weapon`  = "%s", `ranking` = "%s"',
    s($user_id), s($game_id), s($user_name), s($kill_rate), s($damage), s($map), s($weapon), s($ranking),
    s($user_name), s($kill_rate),s($damage), s($map), s($weapon), s($ranking)
);

mysqli_query($db, $sql) or die(mysqli_error($db));
header("Location: user_game_list.php");
exit();
