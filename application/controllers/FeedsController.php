<?php

session_start();
if (!isset($_SESSION['email'])) {
  header('location: /Login');
}

require_once './application/models/UserModel.php';

$email = $_SESSION['email'];

// Fetch user's data.

$db = new UserModel('user');
$user_data = $db->getUserData($email);

// Fetch posts.
require_once __DIR__ . '/fetch_posts.php';
// View of feeds page.
require_once './application/views/feeds.php';
 