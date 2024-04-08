<?php

require './application/controllers/destroy_session.php';
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

require './application/views/Login.php';
