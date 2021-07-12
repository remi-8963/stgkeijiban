<?php

require('common.php');

if(empty($_POST) || !is_logged_in()) {
    header('Location: signup.php?error=アクセスが不正です');
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'] ?? '';
$sex = $_POST['sex'] ?? '';
$play_style = $_POST['play_style'] ?? '';
$active_time = $_POST['active_time'] ?? '';
$comment = $_POST['comment'] ?? '';
$twitter_id = $_POST['twitter_id'] ?? '';
$is_vc = $_POST['is_vc'] ?? '';

$sql = sprintf('UPDATE users SET name="%s", sex="%s", play_style="%s", active_time="%s", comment="%s", twitter_id="%s", is_vc=%s WHERE id = %d',
    s($name),
    s($sex),
    s($play_style),
    s($active_time),
    s($comment),
    s($twitter_id),
    s($is_vc == 1 ? 'TRUE' : 'FALSE'),
    s($user_id)
);

mysqli_query($db,$sql)or die(mysqli_error($db));

header("Location: user.php?id=$user_id");
exit();
