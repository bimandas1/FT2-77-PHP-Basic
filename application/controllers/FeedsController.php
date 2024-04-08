<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['email'])) {
  header('location: /Login');
}

require_once './application/models/UserModel.php';

$email = $_SESSION['email'];

$db = new UserModel('user');
$user_data = $db->getUserData($email);

require_once __DIR__ . '/fetch_posts.php';

require_once './application/views/feeds.php';




