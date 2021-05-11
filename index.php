<?php
    require('dbconnect.php');

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
        <title>一覧</title>
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <h1>一覧</h1>
        <p style="color:red; font-size:50px"><?=$_GET['message'] ?? ''?></p>

        <table>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['name']?></td>
                    
                    <?php if($is_vc === 1): ?>
                        <td>VCできます</td>
                    <?php else: ?>
                        <td>VCできません</td>
                    <?php endif; ?>
                    <td><a href="user.php?id=<?=$row['id']?>">リンク</a></td>
                </tr>
            <?php endwhile ?>
        </table>
    </body>
</html>




