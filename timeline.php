<?php
    require('dbconnect.php');
    session_start();

    $sql = sprintf('SELECT timelines.id AS comment_id, user_id, text, timelines.created_at, name FROM timelines JOIN users ON timelines.user_id = users.id WHERE timelines.destination_comment_id = 0 ORDER BY timelines.created_at DESC');

    $result = mysqli_query($db,$sql) or die(mysqli_error($db));

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
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div>
          <div>
            <a href="user.php?id=<?=$row['user_id']?>">
              <div style="width: 50px; height: 50px; background-color:white; border-radius: 9999px; overflow: hidden">
                <img src="https://englishlive.ef.com/ja-jp/blog/wp-content/uploads/sites/10/2019/03/10751058080_IMG_3159.jpg" style="display: inline-block; width: 100%; height: 100%">
              </div>
              <p><?=$row['name']?></p>
            </a>
          </div>
          <div>
            <?=htmlspecialchars($row['text'])?> <!--クロスサイトスプリクティング対策-->
          </div>
          <p>投稿日時: <?=$row['created_at']?></p>
          <p>コメントID: <?=$row['comment_id']?></p>
        </div>
        <?php 
          $replies = mysqli_query($db,"SELECT * FROM timelines WHERE destination_comment_id = ".$row['comment_id']); //コメントへの返信
          while($reply = mysqli_fetch_assoc($replies)): ?>
          <p><?=$reply['text']?></p>
        <?php endwhile ?>
      <?php endwhile?>
    </div>
    <a href="user.php?id=<?=$id?>"><button>自分のプロフィールに戻る</button></a>
    <a href="timeline.php"><button>タイムライン</button></a>
</body>
</html>

<?php

// if ($_SESSION['is_loggin'] !== true) {
//   header('Location: index.php');
//   exit();
// }