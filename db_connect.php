<?php

require_once('./environment.php');

$db =  mysqli_connect('localhost',$DATABASE_USERNAME,$DATABASE_PASSWORD,$DATABASE_TABLE);

mysqli_set_charset($db,'utf8');
