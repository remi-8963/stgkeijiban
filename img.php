<?php

require('./dbconnect.php');

$sql = sprintf('SELECT name, play_style, active_time, comment FROM users WHERE id = %d',
    mysqli_real_escape_string($db, $_GET['id'])
);

$reslut = mysqli_query($db,$sql) or die (mysqli_error($db));

$row = mysqli_fetch_assoc($reslut);

if (!$row) {
    header('Location: index.php');
    exit();
}



$image = imagecreatefromjpeg('./template1.jpg');
$icon_image = imagecreatefrompng('./icon_image.png');

$textcolor = imagecolorallocate($image, 50, 50, 50);

$name = $row['name'];

$text = mb_convert_encoding($name, "UTF-8", "auto");

imagettftext($image, 20, 0, 270, 345, $textcolor, './rounded-mplus-1c-bold.ttf', $text);

imagecopy($image, $icon_image, 0, 0, 0, 0, 600, 200);

header("Content-type: image/png");
imagepng($image);

imagedestroy($image);
?>