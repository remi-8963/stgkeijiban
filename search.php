<?php

require('common.php');

// $_GET['name']が入ってなかったら処理を終了
$search_name = $_GET['name'] ?? null or die();

$sql = "SELECT id, name FROM users WHERE name LIKE '%$search_name%' ORDER BY name DESC";

$match_users = mysqli_query($db, $sql) or die('SQLのエラー');

?>
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
        <h1>"<?=$search_name?>"の検索結果(<?=mysqli_num_rows($match_users)?>件)</h1>
        <table>
        <tr>
            <th>ID</th><th>ユーザ名</th>
        </tr>
        <?php while($match_user = mysqli_fetch_assoc($match_users)): ?>
            <tr>
                <td><?=$match_user['id']?></td>
                <td><a href="user.php?id=<?=$match_user['id']?>"><?=$match_user['name']?></a></td>
            </tr>
        <?php endwhile; ?>
        </table>
    </body>
</html>
