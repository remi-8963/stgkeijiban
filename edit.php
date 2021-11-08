<?php
require('common.php');
require('form_data.php');

$id = $_SESSION['user_id'] ?? false;

if (!$id) {
    header('Location: index.php');
    exit();
}

$sql = sprintf('SELECT name, sex, play_style, active_time, comment, is_vc, twitter_id FROM users WHERE id = %d', s($id));
$row = mysqli_fetch_assoc(mysqli_query($db,$sql));

if (!$row) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
        <title>プロフィール編集</title>
    </head>
    <body>
        <h1>プロフィール編集</h1>
        <hr>

        <p>ID: <?=$id?></p>

        <form action="user_update.php" method="post">
            <table border="1">
                <caption>プロフィール編集</caption>

                <?php foreach($form_data as $data): ?>
                    <tr><td><?=$data['japanese']?></td><td><input type="<?=$data['type']?>" name="<?=$data['form_name']?>" size="40" minlength="<?=$data['minlength']?>" maxlength="<?=$data['maxlength']?>" value="<?=$row[$data['form_name']]?>" <?=$data['required']?'required':''?>></td></tr>
                <?php endforeach; ?>
                <tr>

                <td>ボイスチャット</td>
                <td>
                <select name="is_vc">
                    <option value="0" <?=$row['is_vc'] ? '' : 'selected' ?>>VCできません</option>
                    <option value="1" <?=$row['is_vc'] ? 'selected' : '' ?>>VCできます</option>
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