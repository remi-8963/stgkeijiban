<?php

// 主キーが被ったとき
// ON DUPLICATE KEY UPDATE `kill_rate` = "$kill_rate", `map` = "$map", `weapon`  = $weapon, `ranking` = $ranking

// UPSERT

// list → edit → *update

require_once('common.php');
require_logged_in();

$game_id = ($_POST['game_id'] ?? null) or header('Location: index.php');


$sql = sprintf("DELETE FROM users_games WHERE game_id = %d", s($game_id));

mysqli_query($db, $sql) or die(mysqli_error($db));

header("Location: user_game_list.php");
exit();
