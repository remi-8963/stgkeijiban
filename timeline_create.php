<?php
require('common.php');

if(
  !isset($_POST['text']) ||
  $_POST['text'] === ''
) {
  header('Location:index.php');
  die();
};

$id = $_SESSION['user_id'];
$game_id = $_POST['game_id'];
$text = $_POST['text'];
$destination_comment_id = $_POST['destination_comment_id'] ?? 'NULL';

$sql = sprintf('INSERT INTO timelines SET user_id=%d, game_id=%d, text="%s", destination_comment_id=%s',
    s($id),s($text),s($game_id),s($destination_comment_id));

mysqli_query($db,$sql) or die(mysqli_error($db));

header('Location: timeline.php');