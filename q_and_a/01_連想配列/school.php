<?php

$motoki = array(
    'name' => "もとき",
    'old' => 21,
    'school' => "理工科大学",
);

$remi = array(
    'name' => "remi",
    'old' => 18,
    'school' => "理工科大学",
);

function print_user_all($user){
    echo $user['name'];
    echo $user['old'];
    echo $user['school'];
    echo '<br>';
}

print_user_all($motoki);
print_user_all($remi);

function greeting($user){
    echo "こんにちは".$user['name']."です";
    echo '<br>';
}

function judge_user_drank($user) {
    if ($user['old'] >= 20) {
        echo "お酒飲んでOK";
    } else {
        echo "お酒飲めない";
    }
}

print_user_all($motoki);
print_user_all($remi);

greeting($motoki);
greeting($remi);

judge_user_drank($motoki);
judge_user_drank($remi);
?>