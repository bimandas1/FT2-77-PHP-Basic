<?php

$url = $_SERVER['REQUEST_URI'];
$url = rtrim($url);
$url = explode('?', $url)[0];
$url = explode('/', $url);

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

  case 'Google-login':
    require_once __DIR__ . '/application/controllers/google_login.php';
    break;

  case 'Profile' :
    require __DIR__ . '/application/controllers/ProfileController.php';
    break;

  default :
    echo 'default';
}
?>
