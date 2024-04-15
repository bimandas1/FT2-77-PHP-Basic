<?php
require_once __DIR__ . '/../models/UserModel.php';

session_start();
if(!isset($_SESSION['email'])) {
  header('location: /Login');
}

$email = $_SESSION['email'];

if(isset($_POST['task'])) {
  $task = $_POST['task'];
  $db = new UserModel('user');

  if($task == 'update user info') {
    if($db->updateUserData($email, $_POST['fname'], $_POST['lname']) == TRUE) {
      echo 'Updated';
    }
    else {
      echo 'Failed !';
    }
  }
  else if($task == 'update user password') {
    $res = $db->getUserPassword($email);
    if($res[0]['password'] !== $_POST['current-password']) {
      echo 'Current password is wrong.';
    }
    else {
      if ($db->updateUserPassword($email, $_POST['new-password']) == TRUE) {
        echo 'Updated';
      } else {
        echo 'Failed !';
      }
    }
  }
}
