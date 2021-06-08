<?php
    require('common.php');
    
    $sql = sprintf('SELECT id, name, is_vc FROM users');
    $result = mysqli_query($db,$sql) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $is_vc = $row['is_vc'];
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
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['is_vc'] ? 'VCできます' : 'VCできません'?></td>
                    <td><a href="user.php?id=<?=$row['id']?>">リンク</a></td>
                </tr>
            <?php endwhile ?>
        </table>

        <h2>リンク</h2>
        <a href="timeline.php"><button>タイムライン</button></a>
    </body>
</html>




