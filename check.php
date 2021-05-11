
<?php

require('dbconnect.php');

session_start();

// 害悪
if (empty($_GET)) {
    header('Location: index.php');
    exit();
}

// すでにログインしているユーザが自分のプロフィールを変更する場合
if ($_SESSION['is_loggin'] && $_GET['id'] == $_SESSION['id']) {
    header('Location: edit.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ログイン画面</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <hr>

        <p>ID: <?=$_GET['id']?></p>

        <form action="check_2.php" method="post">
            <input type="hidden" name="id" size="30" maxlength="255" value="<?=$_GET['id']?>" />
            <p>パスワード: <input type="text" name="pass_word" size="30" maxlength="255" required/></p>
            <p>
                <input type="submit" value="ログイン">
                <input type="reset" value="リセット">
            </p>
        </form>
        <?php
        if($error = true) {
            echo "※入力が空・もしくは入力が間違っています";
        }
        ?>
        <p>登録されていない場合は<a href="sign_up.php">ココ</a>から登録できます</p>
    </body>
</html>