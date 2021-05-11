<?php

require('dbconnect.php');

session_start();

//エラー判定（普通は起らない）
if(empty($_POST)) {
    header('Location: sign_up.php?error=アクセスが不正です');
    exit();
}

$name = $_POST['name'] ?? '';
$sex = $_POST['sex'] ?? '';
$pass_word = $_POST['pass_word'] ?? '';
$play_style = $_POST['play_style'] ?? '';
$active_time = $_POST['active_time'] ?? '';
$comment = $_POST['comment'] ?? '';
$is_vc = $_POST['is_vc'] ?? '';

if($name === '' || $pass_word === '') {
    header('Location: sign_up.php?error=入力欄に空白が存在します');
    exit();
}

if (strlen($pass_word) < 4) {
    header('Location: sign_up.php?error=パスワードに入力されている文字数が4に達していません');
    exit();
}

$sql = sprintf('INSERT INTO users SET name="%s", sex="%s", pass_word="%s", play_style="%s", active_time="%s", comment="%s", is_vc=%s',
    mysqli_real_escape_string($db, $name),
    mysqli_real_escape_string($db, $sex),
    mysqli_real_escape_string($db, $pass_word),
    mysqli_real_escape_string($db, $play_style),
    mysqli_real_escape_string($db, $active_time),
    mysqli_real_escape_string($db, $comment),
    mysqli_real_escape_string($db, $is_vc == 1 ? 'TRUE' : 'FALSE'),
);

mysqli_query($db,$sql)or die(mysqli_error($db));

$id = mysqli_insert_id($db);

$_SESSION['id'] = $id;
$_SESSION['is_loggin'] = true;

header("Location: user.php?id=$id");
exit();
