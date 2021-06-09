<?php
  function login_banner($user_id = null) {
    global $db;
    $param = $user_id ? "?id=<?=$user_id?>" : '';
    $session_user_id = $_SESSION['user_id'] ?? false;
?>
  <header style="display:flex; align-items:center; justify-content:space-between">
    <?php if($session_user_id): ?>
        <div style="display:flex; align-items:center;">
          <div style="display:inline-block; width: 50px; height: 50px; background-color:white; border-radius: 9999px; overflow: hidden">
            <img src="https://pbs.twimg.com/profile_images/1309957523089354760/uRrxAmOB_400x400.jpg" style="display: inline-block; width: 100%; height: 100%">
          </div>
          <span style="margin-left:10px">
            こんにちは、<?=mysqli_fetch_assoc(mysqli_query($db, "SELECT name FROM users WHERE id = $session_user_id"))['name']?>さん！
          </span>
        </div>
        <div>
          <a href="user.php?id=<?=$session_user_id?>"><button>プロフィール</button></a>
          <a href="logout.php"><button>ログアウト</button></a>
        </div>
    <?php else: ?>
        <a href="login.php<?=$param?>">
          <button>ログイン</button>
        </a>
    <?php endif; ?>
  </header>
<?php
  }
?>