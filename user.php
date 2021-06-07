<?php
    require('dbconnect.php');

    if (!isset($_GET['id'])) {
        header('Location: index.php');
    }
    $id = $_GET['id'];

    $sql = sprintf('SELECT name, sex, play_style, active_time, comment, is_vc FROM users WHERE id = %d',
        mysqli_real_escape_string($db, $id)
    );

    $result = mysqli_query($db,$sql) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);

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
        ]
    ];
?>

<!DOCTYPE html>

<html>
<header><a href="check.php?id=<?=$id?>"><button>ログイン</button></a></header>  
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$name?>さんのプロフィール</title>
        <meta property="og:title" content="<?=$name?>さんのプロフィール">
        <meta property="og:description" content="<?=$name?>さんのプロフィール"><!-- ページのディスクリプション -->
        <meta property="og:type" content="article"> <!-- ページの種類　-->
        <meta property="og:image" content="https://stgkeijiban.com/img.php?id=<?=$id?>">
        <meta property="og:url" content="https://stgkeijiban.com/"><!-- ページのURL -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?=$name?>さんの">
        <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css">

    </head>
    <body>
        <h1><?=$name?>さんのプロフィール</h1>

        <img src="./img.php?id=<?=$id?>">

        <table border="1">
            
            <?php foreach($form_data as $data): ?>
                <tr>
                    <td><?=$data['japanese']?></td>
                    <td><?=$row[$data['form_name']]?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
            <td>ボイスチャット</td>
                <td>
                <?php if($is_vc): ?>
                    VCできます
                <?php else: ?>
                    VCできません
                <?php endif; ?>
                </td>
            </tr>
        </table>

        <a href="index.php"><button>トップページに戻る</button></a>
        <a href="https://twitter.com/intent/tweet?url=https://stgkeijiban.com/user?id=<?=$id?>&text=<?=$name?>さんのプロフィールをみにいこう！"><button>共有</button></a>
        <a href="check.php?id=<?=$id?>"><button>編集</button></a>
        <a href="timeline.php"><button>タイムライン</button></a>
        <a href="sign_up.php"><button>自分のプロフィールも作ってみる！</button></a>

        
    </body>
</html>




