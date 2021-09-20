<?php

// form_name = フォームのname = users_gamesテーブルのカラム

$game_data = [
    [
        "japanese" => "ユーザーネーム(必須)",
        "type" => "text",
        "form_name" => "user_name",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => true,
    ],
    [
        "japanese" => "キルレート(必須)",
        "type" => "text",
        "form_name" => "kill_rate",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => true,
    ],
    [
        "japanese" => "平均ダメージ",
        "type" => "text",
        "form_name" => "damage",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "好きなマップ",
        "type" => "text",
        "form_name" => "map",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "好きな武器",
        "type" => "text",
        "form_name" => "weapon",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "ランク",
        "type" => "text",
        "form_name" => "ranking",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ]
];
?>