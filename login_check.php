<?php

require('common.php');


//エラー判定（普通は起らない）
if(
    !isset($_POST['id']) ||
    !isset($_POST['pass_word'])
) {
    header('Location: index.php');
    exit();
}

$id = $_POST['id'];
$pass_word = $_POST['pass_word'];

$sql = sprintf('SELECT id FROM users WHERE id = %d AND pass_word = "%s"', s($id), s($pass_word));

$result = mysqli_query($db, $sql) or die(mysqli_error($db));

// 一致するレコードが存在しない
if (!mysqli_fetch_assoc($result)) {
    header("Location: login.php?id=$id&message=IDまたはパスワードが違います。");
    exit();
}

$_SESSION['user_id'] = $id;

header("Location: user.php?id=$id");
exit();