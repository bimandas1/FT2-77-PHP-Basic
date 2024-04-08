<?php

require __DIR__ . '/../models/PostModel.php';

session_start();
if(!isset($_SESSION['email'])) {
  header('location: /Login');
}

$email = $_SESSION['email'];

if(isset($_POST['text']) || isset($_FILES['media'])){
  $text = $_POST['text'] ?? null;
  $mediaContent = null;

  if(isset($_FILES['media'])) {
    $mediaContent = file_get_contents($_FILES['media']['tmp_name']);
  }

  $post_table = new PostModel('post');
  if ($post_table->insert($text, $mediaContent, $email) === TRUE) {
    echo '1';
  }
  else {
    echo '0';
  }
}
