<?php

require_once __DIR__ . '/destroy_session.php';
require_once __DIR__ . '/../models/UserModel.php';

destroy_session();
$msg = null;

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $userTable = new UserModel('user');

  if ($userTable->isValidUser($email, $password)  === TRUE) {
    session_start();
    $_SESSION['email'] = $email;
    header('location: /Feeds');
  }
  else {
    $msg = "Email or password doesn't match! Try agauin.";
  }
}

// Google authentication
require_once __DIR__ . '/../helper/google_authentication.php';

// require './application/views/Login.php';
require_once __DIR__ . '/../views/Login.php';

