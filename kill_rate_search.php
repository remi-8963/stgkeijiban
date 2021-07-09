<?php 

require('common.php');

// $sql = "SELECT * FROM users join users_games ON users.id = users_games.user_id join games ON users_games.game_id = games.id";

$sql = "SELECT id,title FROM games";

// $sql_kill_rate = "SELECT id,user_name,kill_rate FROM users join users_games on users.id = users_games.user_id WHERE game_id = ".$_GET['game_id'];
        
$games = mysqli_query($db,$sql) or die(mysqli_error($db));

// $kill_rates = mysqli_query($db,$sql_kill_rate) or die(mysqli_error($db));



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ゲーム情報</title>
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <?=login_banner()?>
    <!-- ゲーム指定 -->
        <h3>検索するゲーム選択</h3>
        <form action="" method="GET">
            <select name="game_id">
                <?php while($game = mysqli_fetch_assoc($games)):?>
                <option value="<?=$game['id']?>" <?=($_GET['game_id'] == $game['id']) ? 'selected' : ''?>><?=$game['title']?></option>" : " "
                <?php endwhile ?> 
            </select>
    <!-- キルレート検索 -->
        <h3>キルレート検索範囲</h3>
                最低K/D
                <input type="text" name="min_kill_rate" value="<?=$_GET['min_kill_rate']?>">
                最高K/D
                <input type="text" name="max_kill_rate" value="<?=$_GET['max_kill_rate']?>">
                <input type="submit" value="決定"> 
        </form>

        <?php
        $sql_kill_rate = "SELECT id,user_name,kill_rate FROM users"
            ." JOIN users_games ON users.id = users_games.user_id"
            ." WHERE kill_rate >= ".$_GET['min_kill_rate']." AND kill_rate <= ".$_GET['max_kill_rate']." AND game_id = ".$_GET['game_id'];
        $kill_rates = mysqli_query($db,$sql_kill_rate) or die(mysqli_error($db));
        ?>
        <h3>検索結果</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>ゲームユーザー名</th>
                <th>K/D</th>
            </tr>

        <?php while($kill_rate = mysqli_fetch_assoc($kill_rates)):?>   
            <tr>
                <td><?=$kill_rate['id']?></td>
                <td><a href="user.php?id=<?=$kill_rate['id']?>"><?=$kill_rate['user_name']?></a></td>
                <td><?=$kill_rate['kill_rate']?></td>
            </tr>
        <?php endwhile ?>
        </table>
        
    </body>
</html>