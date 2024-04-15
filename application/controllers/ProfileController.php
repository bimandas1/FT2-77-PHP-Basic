<?php

session_start();
if (!isset($_SESSION['email'])) {
  header('location: /Login');
}

require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../models/UserModel.php';


$email = $_SESSION['email'];

// Fetch User's data
$db = new UserModel('user');
$user_data = $db->getUserData($email);

// Fetch user's Posts.
$db = new PostModel('post');
$posts = $db->getUserPosts($email);

require __DIR__ . '/../views/profile.php';
