<?php

    require_once('common.php');
    $sql = sprintf(<<<SQL
    SELECT name,play_style,sex,active_time,comment,is_vc
    FROM users
    SQL
    );?>
    <?php //$name = "もとき";?>
    <form action='game.php'  method='POST'>
    <input type="text" name="name" value="">
    <input type="text" name="kill_rate">
    <input type="submit" value="つぎのページで表示">

<!DOCTYPE html>
<html>
<head></head>
<body>
<table border = "1">
<?php   $result = mysqli_query($db, $sql);
        while($row = mysqli_fetch_assoc($result)):?>
        <tr>
            <td><?= $row['name']?></td>
            <td><?= $row['play_style']?></td>
            <td><?= $row['sex']?></td>
            <td><?= $row['active_time']?></td>
            <td><?= $row['comment']?></td>
        </tr>
        <?php endwhile;?>
</table>
</body>
</html>
    
