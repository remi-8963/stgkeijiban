<?php 
    require('common.php');

    $session_user_id = $_SESSION['user_id'] ?? false;

    $sql = 'SELECT id, name, is_vc, comment, play_style FROM users';

    $users = mysqli_query($db,$sql) or die(mysqli_error($db)); 

    $games_sql = "SELECT id,title FROM games";

    $games = mysqli_query($db,$games_sql) or die(mysqli_error($db));
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
        <h1>FPS.TPSゲーム専用交流サイト</h1>

        <h2>名前検索</h2>
        <form action="search.php" method="GET">
            <input type="text" name="name">
            <input type="submit" value="検索する">
        </form>

        <h2>K/D検索</h2>
        <form action="kill_rate_search.php" method="GET">
            <input type="hidden" name="game_id" value="1">
            <input type="hidden" name="min_kill_rate" value="0">
            <input type="hidden" name="max_kill_rate" value="1">
            <input type="submit" value="k/d検索">
        </form>

        <h2>ユーザー一覧</h2>
        
        <table>

            <tr>
                <th>ID</th>
                <th>サイトユーザー名</th>
                <th>プレイスタイル</th>
                <th>VCの有無</th>
            </tr>

            <?php while($user = mysqli_fetch_assoc($users)): ?>

                <tr>
                    <td><a href="user.php?id=<?=$user['id']?>"><?=$user['id']?></a></td>
                    <td><?=$user['name']?></td>
                    <td><?=$user['play_style']?></td>
                    <td><?=$user['is_vc'] ? 'VC有り' : 'VC無し'?></td>
                </tr>
            <?php endwhile ?>
        </table>
        
        <h2>リンク</h2>
        <?php if(!$session_user_id): ?>
            <a href="signup.php"><button>自分のプロフィールを作ってみる！</button></a>
        <?php endif ?>
        <form action="timeline.php" method="GET">
        <select name="game_id">
          <?php while($game = mysqli_fetch_assoc($games)):?>
          <option value="<?=$game['id']?>" <?=$game['id'] ? 'selected' : ''?>><?=$game['title']?></option>" : " "     
          <?php endwhile ?> 
          <input type="submit" value="タイムラインへ">
        </select>
        </form>

    </body>
</html>




