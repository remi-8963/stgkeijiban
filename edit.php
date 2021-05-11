<?php

require('dbconnect.php');
require('form_data.php');

session_start();

$id = $_SESSION['id'] ?? false;

if ($_SESSION['is_loggin'] !== true) {
    header('Location: index.php');
    exit();
}

if ($id === false) {
    header('Location: index.php');
    exit();
}

$sql = sprintf('SELECT name, sex, play_style, active_time, comment, is_vc FROM users WHERE id = %d', mysqli_real_escape_string($db, $id));
$result = mysqli_query($db,$sql);

$row = mysqli_fetch_assoc($result);

if (!$row) {
    header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>プロフィール編集</title>
    </head>
    <body>
        <h1>プロフィール編集</h1>
        <hr>

        <p>ID: <?=$id?></p>

        <form action="check_2.php" method="post">
            <table border="1">
                <caption>プロフィール編集</caption>

                <?php foreach($form_data as $data): ?>
                    <tr><td><?=$data['japanese']?></td><td><input type="<?=$data['type']?>" name="<?=$data['form_name']?>" size="40" minlength="<?=$data['minlength']?>" maxlength="<?=$data['maxlength']?>" value="<?=$row[$data['form_name']]?>" <?=$data['required']?'required':''?>></td></tr>
                <?php endforeach; ?>
                <tr>

                <td>ボイスチャット</td>
                <td>
                <select name="is_vc">
                    <option value="0" <?=$row['is_vc'] ? 'selected' : '' ?>>VCできません</option>
                    <option value="1" <?=$row['is_vc'] ? '' : 'selected' ?>>VCできます</option>
                </select>
                </td>
                </tr>
            </table>
            <p>
                <input type="submit" value="プロフィールを更新する">
            </p>
        </form>
    </body>
</html>