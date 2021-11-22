
<?php
require('common.php');


$param_id = $_GET['id'] ?? null;

if(
    isset($_SESSION['user_id']) &&
    $param_id == $_SESSION['user_id']
){
    header('Location: edit.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
        <title>ログイン画面</title>
    </head>
    <body>
        <h1><font color="#ffd900">ログイン画面</font></h1>
        <a href="./"><button>←トップに戻る</button></a>
        <hr>
        <p style="color:red"><?=$_GET['message'] ?? ''?></p>
        <form action="login_check.php" method="post">
            <table>
                <tr>
                    <?php // GETでIDが渡されていない場合は、テキストボックスを表示する ?>
                    <?php if($param_id): ?>
                        <input type="hidden" name="id" maxlength="255" value="<?=$param_id?>">
                        <th>ID</th><td><?=$_GET['id']?></td>
                    <?php else: ?>
                        <td>ID</th><td><input name="id" maxlength="255" required></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th>パスワード</th>
                    <td><input type="password" name="pass_word" maxlength="255" required/></td>
                </tr>
            </table>
            <p>
                <input type="submit" value="ログイン">
                <input type="reset" value="リセット">
            </p>
        </form>
        <p>登録されていない場合は<a href="signup.php">ココ</a>から登録できます</p>
    </body>
</html>