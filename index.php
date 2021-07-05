<?php 
    require('common.php');

    $sql = 'SELECT id, name, is_vc, comment, play_style FROM users';

    $users = mysqli_query($db,$sql) or die(mysqli_error($db)); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トップページ</title>
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <?=login_banner()?>
        <h1>トップページ</h1>

        <h2>検索</h2>
        <form action="search.php" method="GET">
        <input type="text" name="name">
        <input type="submit" value="検索する">
        </form>

        <h2>一覧</h2>
        
        <table>
            <?php while($user = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td><?=$user['id']?></td>
                    <td><?=$user['name']?></td>
                    <td><?=$user['play_style']?></td>
                    <td><?=$user['is_vc'] ? 'VC有り' : 'VC無し'?></td>
                    <td><a href="user.php?id=<?=$user['id']?>">プロフィールへ</a></td>
                </tr>
            <?php endwhile ?>
        </table>
        
        <h2>リンク</h2>
        <a href="timeline.php"><button>タイムライン</button></a>
    </body>
</html>




