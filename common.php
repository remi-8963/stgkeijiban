<?php
session_start();

require_once('db_connect.php');
require_once('components/login_banner.php');

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function s($str) {
  global $db;
  return mysqli_real_escape_string($db, $str);
}

function is_logged_in() {
  return ($_SESSION['user_id'] ?? null) ? true : false;
}

function require_logged_in() {
  if (!is_logged_in()) {
    header('Location: index.php');
    exit();
  }
}