<?php

require __DIR__ . '/../models/UserModel.php';
require __DIR__ . '/destroy_session.php';

session_start();

if($_POST['otp'] == $_SESSION['otp']) {
  $userTable = new UserModel('user');

  if($_SESSION['task'] == 'register') {
    if($userTable->addUser($_SESSION['email'], $_SESSION['password'], $_SESSION['fname'], $_SESSION['lname']) == TRUE) {
      echo "<p class='alert'> You have been registered. </p>";
    }
    else {
      echo "<p class='alert'> Failed to register. </p>";
    }
  }
  else if ($_SESSION['task'] == 'reset_password') {
    $userTable->changePassword($_SESSION['email'], $_SESSION['password']);
    echo "<p class='alert'> Password has been changed. </p>";
  }
}
else {
  echo "<p class='alert'> OTP not matched. </p>";
}

destroy_session();
