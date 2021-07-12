<?php
    require_once('common.php');
    
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
                <caption>新規ゲームの登録</caption>
            </table>
            <P>新規ゲーム名</p>
            <input type="text" name="game_title" value="">
            <p>fpp = 1,tpp = 0</p>
            <input type="text" name="is_fpp" value="">
            <input type="submit" value="登録">
        </form>
    </body>
</html>