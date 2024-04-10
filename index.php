<?php

$url = $_SERVER['REQUEST_URI'];    // print_r($url);  echo '<br> <br>';
$url = rtrim($url);
$url = explode('?', $url)[0];   // print_r($url);  echo '<br> <br>';
$url = explode('/', $url);      // print_r($url); echo '<br> <br>';

// echo $url[1];

switch ($url[1]) {
  case '' :
    require __DIR__ . '/application/controllers/LoginController.php';
    break;

  case 'Login' :
    require __DIR__ . '/application/controllers/LoginController.php';
    break;

  case 'Feeds' :
    require __DIR__ . '/application/controllers/FeedsController.php';
    break;

  case 'Register' :
    require __DIR__ . '/application/views/register.html';
    break;

  case 'Reset-password' :
    require __DIR__ . '/application/controllers/reset_password.php';
    break;

  case 'Profile' :
    require __DIR__ . '/application/controllers/ProfileController.php';
    break;

  default :
    echo 'default';
}
?>
