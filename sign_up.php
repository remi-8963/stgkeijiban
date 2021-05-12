<?php
    require("form_data.php");

    array_push($form_data,["japanese" => "パスワード",
    "type" => "password",
    "form_name" => "pass_word",
    "minlength" => 0,
    "maxlength" => 255,
    "required" => true,
    ]);
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
        <form action="create.php" method="post">
            <table border="1">
                <caption>プロフィール作成</caption>
                <?php foreach($form_data as $data): ?>
                    <tr><td><?=$data['japanese']?></td><td><input type="<?=$data['type']?>" name="<?=$data['form_name']?>" size="40" minlength="<?=$data['minlength']?>" maxlength="<?=$data['maxlength']?>"<?=$data['required']?'required':''?>></td></tr>
                <?php endforeach; ?>
                <tr>
                <td>ボイスチャット</td>
                <td>
                <select name="is_vc">
                    <option value="0">VCできません</option>
                    <option value="1">VCできます</option> 
                </select>
                </td>
                </tr>
            </table>
            <p id="red"><?$_GET['error']?></p>
            <p>※ユーザーネーム・パスワードに空白がある場合の登録は無効です</p>
            <p>※パスワードはセキュリティのため4文字以上記入してください</p>
            <input type="submit" value="登録確認">
            <input type="reset" value="リセット">
        </form>
    </body>
</html>