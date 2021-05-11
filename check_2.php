<?php

require('dbconnect.php');
session_start();

//エラー判定（普通は起らない）
if(empty($_POST)) {
    header('Location: index.php?message=POSTが空(check_2.php)');
    exit();
}

$id = $_POST['id'] ?? '';
$pass_word = $_POST['pass_word'] ?? '';

if($id === '' || $pass_word === '') {
    header("Location: user.php?id=$id");
    exit();
}

$sql = sprintf('SELECT id FROM users WHERE id = %d AND pass_word = "%s"',
    mysqli_real_escape_string($db, $id),
    mysqli_real_escape_string($db, $pass_word),
);

echo $sql;

$result = mysqli_query($db,$sql) or die(mysqli_error($db));

// 一致するレコードが存在しない
if (!mysqli_fetch_assoc($result)) {
    header("Location: check.php?id=$id");
    exit();
}

$_SESSION['id'] = $id;
$_SESSION['is_loggin'] = true;

header("Location: edit.php");
exit();