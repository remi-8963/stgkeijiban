<?php
    require('common.php');

    $game_id = $_GET['game_id'] ?? 1;

    $sql = "SELECT id,title FROM games";
    // $sql = "SELECT games.id,title,timelines.game_id FROM games JOIN timelines ON games.id = timelines.game_id";

    $games = mysqli_query($db,$sql) or die(mysqli_error($db));
    
    function print_comments($comment, $depth=0) {
      global $db;
      extract($comment);
      $id = $comment['id'];
      $user_id = $comment['user_id'];
      $name = $comment['name'];
      $text = $comment['text'];
      $created_at = $comment['created_at'];
      $margin_left = ($depth * 60).'px';
      ?>
        <div style='margin-left: <?=h($margin_left)?>; margin-top: 10px; padding: 10px; background-color:#008080; border-radius: 10px'>
          <?php if($depth > 0):?>
            <!-- <img src="https://img.icons8.com/ios/452/reply-arrow.png" style="width:30px; margin:0"> -->
          <?php endif ?>
          <div style="display:flex; align-items:center">
          <!-- アイコン画像 -->
            <div style="display:inline-block; width: 50px; height: 50px; background-color:white; border-radius: 9999px; overflow: hidden">
              <img src="https://pbs.twimg.com/profile_images/1309957523089354760/uRrxAmOB_400x400.jpg" style="display: inline-block; width: 100%; height: 100%">
            </div>
            <a href="user.php?id=<?=h($user_id)?>" style="margin-left: 10px; text-decoration:none;">
              <span><?=h($name)?></span>
            </a>
          </div>
          <!-- <div style="margin-top:10px; padding:5px 10px; background-color:#F3FAFF; border-radius:5px"> -->
            <?=h($text)?> <!--クロスサイトスプリクティング対策-->
          </div>
          <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-top:10px">
            <a href="?destination_comment_id=<?=$id?>">
              <button>返信する</button>
            </a>
            <span style="color:#4084B0">投稿日時: <?=$created_at?></span>
          </div>
        </div>
      <?php
      //$idでコメントを取ってくる
      //投稿に対する返信
      $select_reply_comments = "SELECT timelines.id AS id, timelines.user_id AS user_id, timelines.text AS text, timelines.created_at AS created_at, users.name AS name FROM timelines JOIN users ON timelines.user_id = users.id WHERE timelines.destination_comment_id = $id ORDER BY timelines.created_at DESC";
      
      $replied_comments = mysqli_query($db, $select_reply_comments);
      
      while($replied_comment = mysqli_fetch_assoc($replied_comments)){
        print_comments($replied_comment, $depth + 1);
      }
    }
    

    //おおもとのコメント
    // $select_root_comments = "SELECT timelines.id AS id, timelines.user_id AS user_id, timelines.text AS text, timelines.created_at AS created_at, users.name AS name FROM timelines JOIN users ON timelines.user_id = users.id WHERE timelines.destination_comment_id IS NULL ORDER BY timelines.created_at DESC";

    $select_root_comments = "SELECT timelines.id AS id, timelines.user_id AS user_id, timelines.text AS text, timelines.created_at AS created_at, users.name AS name, timelines.game_id AS game_id FROM timelines JOIN users ON timelines.user_id = users.id WHERE game_id = ".$game_id." AND timelines.destination_comment_id IS NULL ORDER BY timelines.created_at DESC";

    $root_comments = mysqli_query($db, $select_root_comments) or die(mysqli_error($db));

    $id = $_SESSION['user_id'] ?? '';
    $destination_comment_id = $_GET['destination_comment_id'] ?? null
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stgkeijiban-タイムライン</title>
    <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
</head>
<body>
    <?=login_banner()?>
    <h1>タイムライン</h1>
    <a href="index.php"><button style="margin: 10px 0">← トップページ</button></a>

    <?php if(is_logged_in()): ?>

      <form action="timeline_create.php" method="POST">
        <select name="game_id">
          <?php while($game = mysqli_fetch_assoc($games)):?>
          <option value="<?=$game['id']?>" <?=($game_id == $game['id']) ? 'selected' : ''?>><?=$game['title']?></option>" : " "     
          <?php endwhile ?> 
        </select>
        <table>
          <?php if($destination_comment_id): ?>
            <tr>
              <input type="hidden" name="destination_comment_id" value="<?=$destination_comment_id?>">
              <th>返信先コメント</th><td><?=mysqli_fetch_assoc(mysqli_query($db, "SELECT text FROM timelines WHERE id = $destination_comment_id"))['text']?></td>
            </tr>
          <?php endif; ?>
          <tr>
            <th>コメント</th><td><textarea name="text" cols="30" row="3" style="width:100%" required></textarea></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" value="投稿"></td>
          </tr>
        </table>
      </form>
    <?php else: ?>
      <p>ログインすると投稿できます。</p>
    <?php endif ?>
    
    <?php while($root_comment = mysqli_fetch_assoc($root_comments)): ?>
      <?php print_comments($root_comment) ?>
    <?php endwhile?>

</body>
</html>