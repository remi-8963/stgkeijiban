<?php
    require("game_data.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>登録画面</title>
        <style type="text/css">
            #red { color : red;}
        </style>
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <form action="game_create.php" method="post">
            <table border="1">
                <caption>ゲームのプロフィール作成</caption>
                <?php foreach($game_data as $data): ?>
                    <tr><td><?=$data['japanese']?></td><td><input type="<?=$data['type']?>" name="<?=$data['form_name']?>" size="40" minlength="<?=$data['minlength']?>" maxlength="<?=$data['maxlength']?>"<?=$data['required']?'required':''?>></td></tr>
                <?php endforeach; ?>
            </table>
            <p id="red"><?$_GET['error']?></p>
            <input type="submit" value="登録確認">
            <input type="reset" value="リセット">
        </form>
    </body>
</html>