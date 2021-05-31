<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>一覧</title>
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <?php

        require('dbconnect.php');

        // /search.php?name=れみ
        // れみい

        // /search.php
        // 何も表示されない

        $search_name = $_GET['name'] ?? null; // $_GET['name']が入ってたら$_GET['name']、入ってなかったらnull

        if ($search_name === null) die();

        $sql = "SELECT id, name FROM users WHERE name LIKE '%$search_name%' ORDER BY name DESC";

        $match_users = mysqli_query($db, $sql) or die('SQLのエラー');

        while($match_user = mysqli_fetch_assoc($match_users)): ?>

        <p><?=$match_user['id']?>: <a href="user.php?id=<?=$match_user['id']?>"><?=$match_user['name']?></a></p>

        <?php endwhile; ?>

    </body>
</html>
