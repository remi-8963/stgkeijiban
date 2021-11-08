<?php
// header("Content-type: image/png");

function generate_profile_img($id, $db) {
    $sql = sprintf("SELECT play_style, name, sex, active_time, comment FROM users WHERE id = %d",
        $id
    );

    $sql_users_games = sprintf("SELECT title FROM users JOIN users_games ON users.id = users_games.user_id JOIN games ON users_games.game_id = games.id WHERE users.id = %d",
        $id
    );
    $result = mysqli_query($db,$sql) or die (mysqli_error($db));

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header('Location: index.php');
        exit();
    }

    $image = imagecreatefromjpeg('./template1.jpg');
    $icon_image_url_jpg = "./uploaded_profile_images/$id.jpg";
    $icon_image_url_png = "./uploaded_profile_images/$id.png";

    if (file_exists($icon_image_url_jpg)) {
        $icon_image = imagecreatefromjpeg($icon_image_url_jpg);
    } else if (file_exists($icon_image_url_png)) {
        $icon_image = imagecreatefrompng($icon_image_url_png);
    } else {
        $icon_image = imagecreatefrompng('./default_icon_image.png');
    }

    extract($row);

    $result_users_games = mysqli_query($db,$sql_users_games) or die(mysqli_error($db));

    // while($row_games = mysqli_fetch_assoc($result_users_games)){
    //     $text_title = mb_convert_encoding($row_games['title'], "UTF-8", "auto");
    //     imagettftext($image, 30, 0, $x, $y, $textcolor, './rounded-mplus-1c-bold.ttf', $text_title);
    //     $y += 50;
    // }

    $textcolor = imagecolorallocate($image, 0, 0, 0);

    $finish_display_all_games = false;

    for($x=650;$x<650+160*3;$x+=160){
        for($y=130;$y<130+50*3;$y+=50){
            $games = mysqli_fetch_assoc($result_users_games);
            if (!$games) {
                $finish_display_all_games = true;
                echo "<span style='margin:0 5px'>break!</span>";
                break;
            }
            echo "<span style='margin:0 5px'>".$games['title']."</span>";
            $text_title = mb_convert_encoding($games['title'], "UTF-8", "auto");
            imagettftext($image, 30, 0, $x, $y, $textcolor, './rounded-mplus-1c-bold.ttf', $text_title);
        }
        if ($finish_display_all_games) {
            echo "<span style='margin:0 5px'>break!</span>";
            break;
        }
    }

    $text_name = mb_convert_encoding($name, "UTF-8", "auto");
    imagettftext($image, 20, 0, 270, 345, $textcolor, './rounded-mplus-1c-bold.ttf', $text_name);

    $text_play_style = mb_convert_encoding($play_style, "UTF-8", "auto");
    imagettftext($image, 20, 0, 270, 428, $textcolor, './rounded-mplus-1c-bold.ttf', $text_play_style);

    $text_active_time = mb_convert_encoding($active_time, "UTF-8", "auto");
    imagettftext($image, 20, 0, 270, 508, $textcolor, './rounded-mplus-1c-bold.ttf', $text_active_time);

    $text_comment = mb_convert_encoding($comment, "UTF-8", "auto");
    imagettftext($image, 20, 0, 650, 400, $textcolor, './rounded-mplus-1c-bold.ttf', $text_comment);

    $icon_image_width = imagesx($icon_image);
    $icon_image_height = imagesy($icon_image);

    $ICON_IMAGE_RATIO = 3;

    if ($icon_image_width / $icon_image_height > $ICON_IMAGE_RATIO) {
        // 横長
        echo "横長";
        $src_width = $icon_image_height * $ICON_IMAGE_RATIO;
        $src_height = $icon_image_height;
        $src_x = ($icon_image_width - $src_width) / 2;
        $src_y = 0;
    } else {
        // 縦長もしくはそのまま
        echo "縦長",
        $src_width = $icon_image_width;
        $src_height = $icon_image_width / $ICON_IMAGE_RATIO;
        $src_x = 0;
        $src_y = ($icon_image_height - $src_height) / 2;
    }

    echo "<pre>";
    var_export([
        'src_width' => $src_width,
        'src_height' => $src_height,
        'src_x' => $src_width,
        'src_y' => $src_y,
    ]);
    echo "</pre>";

    imagecopyresampled($image, $icon_image, 0, 0, $src_x, $src_y, 600, 200, $src_width, $src_height);

    imagepng($image, "./profile_images/$id.png");

    imagedestroy($image);
}

// idを渡すとそのIDのユーザのプロフィール画像を再生成（もしくは生成）する