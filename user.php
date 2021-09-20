<?php
    require('common.php');
    $id = ($_GET['id'] ?? null) or header('Location: index.php');
    $session_user_id = $_SESSION['user_id'] ?? false;

    $sql_users = sprintf(
        "SELECT name, sex, play_style, active_time, comment, is_vc, twitter_id FROM users WHERE users.id = %d",
        s($id)
    );

    $sql_users_games = sprintf(
        "SELECT user_name, map, weapon, title, kill_rate, damage, ranking, is_fpp FROM users JOIN users_games ON users.id = users_games.user_id JOIN games ON users_games.game_id = games.id WHERE users.id = %d",
        s($id)
    );  


    $result = mysqli_query($db, $sql_users) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    
    

    // 指定されたIDが存在しないユーザの場合
    if (!$row) {
        header('Location: index.php');
        exit();
    }

    $name = $row['name'];
    $is_vc = $row['is_vc'];
    

    $form_data = [
        [
            "japanese" => "ユーザネーム",
            "form_name" => "name",
        ],
        [
            "japanese" => "性別",
            "form_name" => "sex",
        ],
        [
            "japanese" => "プレイスタイル",
            "form_name" => "play_style",
        ],
        [
            "japanese" => "プレイしている時間帯",
            "form_name" => "active_time",
        ],
        [
            "japanese" => "一言あれば",
            "form_name" => "comment",
        ],
    ];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=h($name)?>さんのプロフィール</title>
        <!-- twitter共有 -->
        <meta property="og:title" content="<?=h($name)?>さんのプロフィール"> <!-- タイトル　-->
        <meta property="og:description" content="<?=h($name)?>さんのプロフィール"><!-- 対象の説明 -->
        <meta property="og:type" content="article"> <!-- ページの種類　-->
        <meta property="og:image" content="https://stgkeijiban.com/~tklab2021/091/stgkeijiban/img.php?id=<?=h($id)?>"><!-- 対象用の画像URL -->
        <meta property="og:url" content="https://stgkeijiban.com/~tklab2021/091/stgkeijiban"><!-- ページのURL -->
        <meta name="twitter:card" content="summary_large_image">　<!-- カードのサイズ -->
        <meta name="twitter:title" content="<?=h($name)?>さんのプロフィール">

        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">
    </head>
    <body>
        <?=login_banner()?>
        <h1><?=h($name)?>さんのプロフィール　　　　　　　ID:<?=h($id)?></h1>
        <img src="img.php?id=<?=h($id)?>">
        <table border="1">
            <?php foreach($form_data as $data): ?>
                <tr>
                    <td><?=$data['japanese']?></td>
                    <td><?=$row[$data['form_name']]?></td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td>ボイスチャット</td>
                    <td><?=$is_vc ? 'VCできます' : 'VCできません'?></td>
                </tr>
        </table>
        <table>
            <tr>
                <th>ゲーム名</th>
                <!-- <th>ゲームタイプ</th> -->
                <th>ユーザーネーム</th>
                <th>キルレート</th>
                <th>平均ダメージ</th>
                <th>好きなマップ</th>
                <th>好きな武器</th>
                <th>ランク</th>
            <tr>
            <!-- 登録してある人のtwitterへ飛ぶリンク -->
        <?php if($row['twitter_id'] == NULL):?>
            <p>twitterIDは登録されていません。</p>
        <?php else: ?>
            <a href="https://twitter.com/<?=$row['twitter_id']?>"><button><?=h($name)?>さんのtwitterへ</button></a>
        <?php endif ?>

        <?php  $result_users_games = mysqli_query($db,$sql_users_games) or die(mysqli_error($db));
            while($game = mysqli_fetch_assoc($result_users_games)):?>
                <tr>
                    <td><?=$game['title']?></td>
                    <!-- <td><?=$game['is_fpp'] ? 'FPP':'TPP'?></td> -->
                    <td><?=$game['user_name']?></td>
                    <td><?=$game['kill_rate']?></td>
                    <td><?=$game['damage']?></td>
                    <td><?=$game['map']?></td>
                    <td><?=$game['weapon']?></td>
                    <td><?=$game['ranking']?></td>
                </tr>
            <?php endwhile;?>
        </table>

            <ul>
                <?php if($session_user_id == $id): ?>
                    <li><a href="login.php?id=<?=h($id)?>"><button>プロフィールの編集</button></a></li>
                    <li><a href="user_game_list.php"><button>ゲームの登録/編集</button></a></li>
                <?php endif ?>
                <?php if(!$session_user_id): ?>
                    <li><a href="signup.php"><button>自分のプロフィールも作ってみる！</button></a></li>
                <?php endif ?>
                    <li><a href="index.php"><button>トップページに戻る</button></a></li>
                    <li><a href="https://twitter.com/intent/tweet?url=https://stgkeijiban.com/~tklab2021/091/stgkeijiban/user.php?id=<?=h($id)?>&text=<?=h($name)?>さんのプロフィールをみにいこう！"><button>共有</button></a></li>
                    <li><a href="timeline.php"><button>タイムライン</button></a></li>
            </ul>
            
        </body>
</html>