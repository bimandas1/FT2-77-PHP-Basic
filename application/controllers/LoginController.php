<?php

require_once __DIR__ . '/destroy_session.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../helper/GoogleAuthentication.php';

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

// Authenticate user email by Google login.
$googleAuthentication = new GoogleAuthentication();
$googleAuthentication->authenticate();

require_once __DIR__ . '/../views/Login.php';
