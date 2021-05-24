<?php

require('dbconnect.php');
session_start();

if(
  isset($_SESSION['is_login']) &&
  isset($_SESSION['id']) &&
  $_SESSION['is_loggin'] &&
  isset($_POST['text']) &&
  $_POST['text'] === ''
) {
  header('Location:index.php');
  die();
};

$id = $_SESSION['id'];
$text = $_POST['text'];
$destination_comment_id = $_POST['destination_comment_id'] === '' ? 'NULL' : $_POST['destination_comment_id'];

$sql = sprintf('INSERT INTO timelines SET user_id=%d, text="%s", destination_comment_id=%s',
    mysqli_real_escape_string($db, $id),
    mysqli_real_escape_string($db, $text),
    mysqli_real_escape_string($db, $destination_comment_id),
);

mysqli_query($db,$sql) or die(mysqli_error($db));

header('Location: timeline.php');