<?php

require('./common.php');

$sql = sprintf("SELECT play_style, name, sex, active_time, comment FROM users WHERE id = %d",
    s($_GET['id'])
);

$sql_users_games = sprintf("SELECT title FROM users JOIN users_games ON users.id = users_games.user_id JOIN games ON users_games.game_id = games.id WHERE users.id = %d",
    s($_GET['id'])
);
$result = mysqli_query($db,$sql) or die (mysqli_error($db));

$row = mysqli_fetch_assoc($result);

if (!$row) {
    header('Location: index.php');
    exit();
}

$image = imagecreatefromjpeg('./template1.jpg');
$icon_image = imagecreatefrompng('./icon_image.png');

extract($row);

$x = 650;
$y = 130;

$result_users_games = mysqli_query($db,$sql_users_games) or die(mysqli_error($db));

// while($row_games = mysqli_fetch_assoc($result_users_games)){
//     $text_title = mb_convert_encoding($row_games['title'], "UTF-8", "auto");
//     imagettftext($image, 30, 0, $x, $y, $textcolor, './rounded-mplus-1c-bold.ttf', $text_title);
//     $y += 50;
// }

for($a=0;$a<3;$a++){
    for($i=0;$i<3;$i++){
        $row_games = mysqli_fetch_assoc($result_users_games);
        for($j=0;$j<1;$j++){
            $text_title = mb_convert_encoding($row_games['title'], "UTF-8", "auto");
            imagettftext($image, 30, 0, $x, $y, $textcolor, './rounded-mplus-1c-bold.ttf', $text_title);
            $y += 50;
        }
    }
    $y = 130;
    $x += 120;
}


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