<?php

require('common.php');

$id = ($_POST['id'] ?? null) or header('Location: index.php');

$game_title = $_POST['game_title'] ?? '';


if($game_title === '') {
    header('Location: signup.php?error=入力欄に空白が存在します');
    exit();
}

$sql = sprintf('INSERT INTO games SET title="%s"',
    s($game_title)
);
    
mysqli_query($db,$sql)or die(mysqli_error($db));

header("Location: user.php?id=$id");
exit();
