<?php 

require('common.php');

// $sql = "SELECT * FROM users join users_games ON users.id = users_games.user_id join games ON users_games.game_id = games.id";

$sql = "SELECT id,title FROM games";

$games = mysqli_query($db,$sql) or die(mysqli_error($db));

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
        <h1>検索するゲームの選択</h1>
        <form action="" method="GET">
            <select name="game_id">
                <option value="">選択してください</option>
                <?php while($game = mysqli_fetch_assoc($games)):?>
                <option value="<?=$game['id']?>" <?=($_GET['game_id'] == $game['id']) ? 'selected' : ''?>><?=$game['title']?></option>" : " "
            <?php endwhile ?>
                <input type="submit" value="決定"> 
            </select>
        </form>

        

       

            
    </body>
</html>