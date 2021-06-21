<?php
    require_once("common.php");
    require_once("user_game_data.php");
    require_logged_in();
    $user_id = $_SESSION['user_id'];
    $game_id = ($_POST['game_id'] ?? null) or header('Location: index.php');

    $sql = sprintf(<<<SQL
      SELECT game_id, title, is_fpp, user_id, kill_rate, map, weapon, ranking, user_name FROM games
      JOIN users_games ON games.id = users_games.game_id
      WHERE user_id = %d AND game_id = %d
    SQL,
      s($user_id),
      s($game_id)
    );

    $column = mysqli_fetch_assoc(mysqli_query($db, $sql));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録画面</title>
    <style type="text/css">
        #red { color : red;}
    </style>
    <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
</head>
<body>
    <form action="user_game_update.php" method="post">
        <table border="1">
            <caption>ゲーム情報の編集</caption>
            <?php foreach($game_data as $data): ?>
                <tr>
                    <td><?=$data['japanese']?></td>
                    <td><input type="<?=$data['type']?>" name="<?=$data['form_name']?>" size="40" minlength="<?=$data['minlength']?>" maxlength="<?=$data['maxlength']?>" value="<?=$column[$data['form_name']]?>" <?=$data['required']?'required':''?>></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="hidden" name="game_id" value="<?=$game_id?>">
        <input type="submit" value="更新">
    </form>
</body>
</html>