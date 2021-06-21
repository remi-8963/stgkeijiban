<?PHP
require_once('common.php');

$sql = sprintf(<<<SQL
    SELECT name,title,kill_rate
    FROM users
    join users_games
    on users.id = users_games.user_id
    join games
    on users_games.game_id = games.id
    WHERE users.id = 2
    SQL,
        // s($id)
    );?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<table border = "1">
<?php   $result = mysqli_query($db, $sql);
        while($row = mysqli_fetch_assoc($result)):?>
        <tr>
            <td><?= $row['name']?></td>
            <td><?= $row['title']?></td>
            <td><?= $row['kill_rate']?></td>
        </tr>
        <?php endwhile;?>
</table>
<p>ユーザーネーム：<?=$_POST['name']?></p>
<p>キルレート：<?=$_POST['kill_rate']?></p>
</body>
</html>
    
