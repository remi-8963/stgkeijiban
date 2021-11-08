<?php

require('common.php');

if(empty($_POST)) {
    header('Location: signup.php?error=アクセスが不正です');
    exit();
}


$name = $_POST['name'] ?? '';
$sex = $_POST['sex'] ?? '';
$pass_word = $_POST['pass_word'] ?? '';
$play_style = $_POST['play_style'] ?? '';
$active_time = $_POST['active_time'] ?? '';
$comment = $_POST['comment'] ?? '';
$twitter_id = $_POST['twitter_id'] ?? '';
$is_vc = $_POST['is_vc'] ?? '';

if($name === '' || $pass_word === '') {
    header('Location: signup.php?error=入力欄に空白が存在します');
    exit();
}

if (strlen($pass_word) < 4) {
    header('Location: signup.php?error=パスワードに入力されている文字数が4に達していません');
    exit();
}

$sql = sprintf('INSERT INTO users SET name="%s", sex="%s", pass_word="%s", play_style="%s", active_time="%s", comment="%s",twitter_id="%s", is_vc=%s',
    s($name),
    s($sex),
    s($pass_word),
    s($play_style),
    s($active_time),
    s($comment),
    s($twitter_id),
    s($is_vc == 1 ? 'TRUE' : 'FALSE')
);

mysqli_query($db,$sql)or die(mysqli_error($db));

$id = mysqli_insert_id($db);

$_SESSION['user_id'] = $id;

require_once('https://stgkeijiban.com/~tklab2021/091/stgkeijiban/generate_profile_img.php');
generate_profile_img($id, $db);

header("Location: user.php?id=$id");
exit();
