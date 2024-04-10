<?php

session_start();

if (!isset($_SESSION['email'])) {
  header('location: /Login');
}

// require_once './application/models/UserModel.php';
require_once __DIR__ . '/../models/UserModel.php';

$email = $_SESSION['email'];

// Fetch user's data.

$db = new UserModel('user');
$user_data = $db->getUserData($email);

// If user not registered then send to Register page.
if(empty($user_data)) {
  header('location: /Register');
}

// Fetch posts.
require_once __DIR__ . '/fetch_posts.php';
// View of feeds page.
// require_once './application/views/feeds.php';
require_once __DIR__ . '/../views/feeds.php';
