<?php

require('common.php');

$id = ($_POST['id'] ?? null) or header('Location: index.php');

$game_title = $_POST['game_title'] ?? '';
$game_is_fpp = $_POST['is_fpp'] ?? '';


if($game_title === '' && $game_is_fpp === '') {
    header('Location: game_signup.php');
    exit();
}

$sql = sprintf('INSERT INTO games SET title="%s",is_fpp="%d"',
    s($game_title),s($game_is_fpp)
);
    
mysqli_query($db,$sql)or die(mysqli_error($db));

header("Location: user.php?id=$id");
exit();
