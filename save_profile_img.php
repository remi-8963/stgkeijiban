<?php
require_once('generate_profile_img.php');
require_once('db_connect.php');
session_start();

$id = $_SESSION['user_id'];
$file = $_FILES['image'];
// ファイルの拡張子
$file_ext = mb_strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if ($file_ext !== 'jpg' && $file_ext !== 'png') {
    echo "アップロードされたファイルの拡張子は「 $file_ext 」でしたが、アップロードできるファイルの拡張子はjpgもしくは、pngのみです。";
    return;
}
$path = "./uploaded_profile_images/$id.$file_ext";

// あったら消す
if (file_exists("./uploaded_profile_images/$id.jpg")) {
    unlink("./uploaded_profile_images/$id.jpg");
}
if (file_exists("./uploaded_profile_images/$id.png")) {
    unlink("./uploaded_profile_images/$id.png");
}

// 出現する
move_uploaded_file($file['tmp_name'],$path);
generate_profile_img($id, $db);
header("Location: user.php?id=$id");
