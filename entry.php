<?php
require('dbconnect.php');

session_start();

//エラー判定
if(empty($_POST)) {
    header('Location: sign_up.php?error=アクセスが不正です');
    exit();
}

if($_POST['name']!='' && $_POST['pass_word']!='') {
    header('Location: sign,_up.php?error=入力欄に空白が存在します');
    exit();
}

if (strlen($_POST['pass_word']) < 4) {
    header('Location: sign_up.php?error=パスワードに入力されている文字数が4に達していません');
    exit();
}

$name = $_POST['name'];
$pass_word = $_POST['pass_word'];


$sql = sprintf('INSERT INTO users SET name="%s",pass_word="%s",',
    mysqli_real_escape_string($db, $name),
    mysqli_real_escape_string($db, $pass_word),
);

mysqli_query($db,$sql)or die(mysqli_error($db));

$id = mysqli_insert_id($db);

$_SESSION['id'] = $id;
$_SESSION['is_loggin'] = true;

header('create.php');
