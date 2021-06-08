<?php

require('./common.php');

$sql = sprintf('SELECT name, play_style, active_time, comment FROM users WHERE id = %d',
    s($_GET['id'])
);

$result = mysqli_query($db,$sql) or die (mysqli_error($db));

$row = mysqli_fetch_assoc($result);

if (!$row) {
    header('Location: index.php');
    exit();
}

extract($row);

$image = imagecreatefromjpeg('./template1.jpg');
$icon_image = imagecreatefrompng('./icon_image.png');

$textcolor = imagecolorallocate($image, 50, 50, 50);

$text_name = mb_convert_encoding($name, "UTF-8", "auto");
imagettftext($image, 20, 0, 270, 345, $textcolor, './rounded-mplus-1c-bold.ttf', $text_name);

$text_play_style = mb_convert_encoding($play_style, "UTF-8", "auto");
imagettftext($image, 20, 0, 270, 428, $textcolor, './rounded-mplus-1c-bold.ttf', $text_play_style);

$text_active_time = mb_convert_encoding($active_time, "UTF-8", "auto");
imagettftext($image, 20, 0, 270, 508, $textcolor, './rounded-mplus-1c-bold.ttf', $text_active_time);

$text_comment = mb_convert_encoding($comment, "UTF-8", "auto");
imagettftext($image, 20, 0, 650, 400, $textcolor, './rounded-mplus-1c-bold.ttf', $text_comment);

imagecopy($image, $icon_image, 0, 0, 0, 0, 600, 200);

header("Content-type: image/png");
imagepng($image);

imagedestroy($image);
?>