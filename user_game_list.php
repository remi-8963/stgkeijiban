<?php
    require_once('common.php');
    require_once('user_game_data.php');
    require_logged_in();
    $user_id = $_SESSION['user_id'];

    $sql = sprintf(<<<SQL
      SELECT game_id, title, is_fpp, user_id, kill_rate, map, weapon, ranking, user_name FROM games
      JOIN users_games ON games.id = users_games.game_id
      WHERE user_id = %d
    SQL,
      s($user_id)
    );
    $user_games = mysqli_query($db, $sql) or die(mysqli_error($db));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ゲーム一覧</title>
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <?=login_banner()?>
        <h1>ゲーム一覧</h1>
        <table>
          <tr>
            <td>ゲームタイトル</td>
            <td>ゲームタイプ</td>
            <?php foreach($game_data as $game): ?>
              <td><?=$game['japanese']?></td>
            <?php endforeach ?>
            <td>編集</td>
          </tr>
          <?php while($user_game = mysqli_fetch_assoc($user_games)): ?>
              <tr>
                  <td><?=$user_game['title']?></td>
                  <td><?=$user_game['is_fpp'] ? 'FPP' : 'TPP'?></td>
                  <?php foreach($game_data as $game): ?>
                    <td><?=$user_game[$game['form_name']]?></td>
                  <?php endforeach ?>
                  <td>
                    <form action="user_game_edit.php" method="post">
                      <input type="hidden" name="game_id" value="<?=$user_game['game_id']?>">
                      <input type="submit" value="編集">
                    </form>
                  </td>
                  
              </tr>
          <?php endwhile ?>
        </table>
        
              <form action="user_game_create.php" method="post">
                <input type="hidden" name="game_id" value="<?=$user_game['game_id']?>">
                <input type="submit" value="このゲームで新しく作る">     
    </body>
</html>




