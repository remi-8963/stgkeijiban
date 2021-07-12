<?php
$form_data = [
    [
        "japanese" => "ユーザネーム(必須)",
        "type" => "text",
        "form_name" => "name",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => true,
    ],
    [
        "japanese" => "性別",
        "type" => "text",
        "form_name" => "sex",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "プレイスタイル",
        "type" => "text",
        "form_name" => "play_style",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "プレイしている時間帯",
        "type" => "text",
        "form_name" => "active_time",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "一言あれば",
        "type" => "text",
        "form_name" => "comment",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ],
    [
        "japanese" => "自身のtwitterのID(@から下)",
        "type" => "text",
        "form_name" => "twitter_id",
        "minlength" => 0,
        "maxlength" => 255,
        "required" => false,
    ]
];
?>