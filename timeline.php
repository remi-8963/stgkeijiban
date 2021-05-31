<?php
    require('dbconnect.php'); // ← $db が宣言されてる
    session_start();

    function print_comments($comment, $depth=0) {
      global $db;
      $id = $comment['id'];
      $user_id = $comment['user_id'];
      $name = $comment['name'];
      $text = $comment['text'];
      $created_at = $comment['created_at'];
      $created_at = $comment['created_at'];
      $margin_left = ($depth * 60).'px';
      ?>
        <div style='margin-left: <?=$margin_left?>'>
          <div>
            <a href="user.php?id=<?=$user_id?>">
              <div style="width: 50px; height: 50px; background-color:white; border-radius: 9999px; overflow: hidden">
                <img src="https://englishlive.ef.com/ja-jp/blog/wp-content/uploads/sites/10/2019/03/10751058080_IMG_3159.jpg" style="display: inline-block; width: 100%; height: 100%">
              </div>
              <p><?=$name?></p>
            </a>
          </div>
          <div>
            <?=htmlspecialchars($text)?> <!--クロスサイトスプリクティング対策-->
          </div>
          <form action='' method='GET'>
          <p>ID: <button><?=$id?></button> 投稿日時: <?=$created_at?></p>
        </div>
      <?php
    //$idでコメントを取ってくる　
    //投稿に対する返信
      $select_reply_comments = <<<SQL
      SELECT 
        timelines.id AS id,
        timelines.user_id AS user_id,
        timelines.text AS text,
        timelines.created_at AS created_at,
        users.name AS name
      FROM timelines
      JOIN users ON timelines.user_id = users.id
      WHERE timelines.destination_comment_id = $id 
      ORDER BY timelines.created_at DESC
      SQL;

      $replied_comments = mysqli_query($db, $select_reply_comments);
    
      while($replied_comment = mysqli_fetch_assoc($replied_comments)) {
        print_comments($replied_comment, $depth + 1);
      }
    }
    //おおもとのコメント
    $select_root_comments = <<<SQL
    SELECT 
      timelines.id AS id,
      timelines.user_id AS user_id,
      timelines.text AS text,
      timelines.created_at AS created_at,
      users.name AS name
    FROM timelines
    JOIN users ON timelines.user_id = users.id
    WHERE timelines.destination_comment_id IS NULL
    ORDER BY timelines.created_at DESC
    SQL;

    $root_comments = mysqli_query($db, $select_root_comments) or die(mysqli_error($db));

    $id = $_SESSION['id'];
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
    <h1>タイムライン</h1>
    <div>
      <a href="user.php?id=<?=$id?>"><button>自分のプロフィールに戻る</button></a>
      <a href="index.php"><button>トップページに戻る</button></a>
      <?php if(isset($_SESSION['is_loggin']) && $_SESSION['is_loggin'] === true): ?>
        <form action="timeline_create.php" method="post">
        <p>返信先コメントID: <input name="destination_comment_id"></p>
        <textarea name="text" cols="30" row="3" required></textarea>
          <input type="submit" value="投稿">
        </form>
      <?php else: ?>
        <p>ログインすると投稿できます。</p>
      <?php endif ?>
    </div>
    <div>
      <?php while($root_comment = mysqli_fetch_assoc($root_comments)): ?>
        <?php print_comments($root_comment) ?>
      <?php endwhile?>
    </div>
</body>
</html>