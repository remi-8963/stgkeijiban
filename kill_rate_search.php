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
        <h1><font color="#ffd900">検索するゲーム選択</font></h1>
        <form action="" method="GET">
            <select name="game_id">
                <?php while($game = mysqli_fetch_assoc($games)):?>
                <option value="<?=$game['id']?>" <?=($_GET['game_id'] == $game['id']) ? 'selected' : ''?>><?=$game['title']?></option>" : " "
                <?php endwhile ?> 
            </select>
    <!-- キルレート検索 -->
        <h3><font color="#b8d200">キルレート検索範囲</font></h3>
                最低K/D
                <input type="text" name="min_kill_rate" value="<?=$_GET['min_kill_rate']?>">
                最高K/D
                <input type="text" name="max_kill_rate" value="<?=$_GET['max_kill_rate']?>">
                <input type="submit" value="決定"> 
        </form>

        <?php
        $sql_game_date = "SELECT id,name,user_name,kill_rate,play_style FROM users"
            ." JOIN users_games ON users.id = users_games.user_id"
            ." WHERE kill_rate >= ".$_GET['min_kill_rate']." AND kill_rate <= ".$_GET['max_kill_rate']." AND game_id = ".$_GET['game_id'];
        $game_dates = mysqli_query($db,$sql_game_date) or die(mysqli_error($db));
        ?>
        <h3><font color="#b8d200">検索結果(<?=mysqli_num_rows($game_dates)?>件)</font></h3>
        <table>
            <tr>
                <th>ID</th>
                <th>サイトユーザー名</th>
                <th>ゲームユーザー名</th>
                <th>K/D</th>
                <th>プレイスタイル</th>
            </tr>

        <?php while($game_date = mysqli_fetch_assoc($game_dates)):?>   
            <tr>
                <td><?=$game_date['id']?></td>
                <td><a href="user.php?id=<?=$game_date['id']?>"><?=$game_date['name']?></a></td>
                <td><?=$game_date['user_name']?></td>
                <td><?=$game_date['kill_rate']?></td>
                <td><?=$game_date['play_style']?></td>
            </tr>
        <?php endwhile ?>
        </table>
        
    </body>
</html>