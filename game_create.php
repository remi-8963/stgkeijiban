<?php

require('common.php');

$id = ($_GET['id'] ?? null) or header('Location: index.php');

if(empty($_POST)) {
    header('Location: signup.php?error=アクセスが不正です');
    exit();
}

$user_name = $_POST['user_name'] ?? '';
$kill_rate = $_POST['kill_rate'] ?? '';
$map = $_POST['map'] ?? '';
$weapon = $_POST['weapon'] ?? '';
$ranking = $_POST['ranking'] ?? '';


if($user_name === '') {
    header('Location: signup.php?error=入力欄に空白が存在します');
    exit();
}


$sql = sprintf('INSERT INTO users_games SET user_name="%s",',
    s($user_name)
);
    
mysqli_query($db,$sql)or die(mysqli_error($db));

header("Location: user.php?id=$id");
exit();
