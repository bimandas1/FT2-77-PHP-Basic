<?php

require_once __DIR__ . '/Validator.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/Mail.php';

$otp = random_int(1000, 9999);

session_start();


$email = $_POST['email'];
$_SESSION['email'] = $email;
$_SESSION['otp'] = $otp;
$_SESSION['task'] = $_POST['task'];
$_SESSION['password'] = $_POST['password'];

$validator = new Validator();
if($validator->emailValidation($email) == FALSE || $validator->passwordValidation($_SESSION['password']) == FALSE) {
  echo '<p> Email or password is not valid. </p>';
  exit;
}

if($_POST['task'] === 'register') {
  $db = new UserModel('user');
  if ($db->isExistingUser($email)) {
    echo '<p> You are already registered. </p>';
    exit;
  }
  $_SESSION['fname'] = $_POST['fname'];
  $_SESSION['lname'] = $_POST['lname'];
}
else if($_POST['task'] === 'reset_password') {
  $db = new UserModel('user');
  if(!$db->isExistingUser($email)) {
    echo '<p> You are not a registered user. </p>';
    exit;
  }
}

$mail = new Mail();
$mail->sendMail($email, $otp);
// echo 'OTP -> ' . $otp . '<br>';

echo '
  <!-- OTP input form -->
  <div class="title">
    <p>Enter OTP</p>
  </div>

  <input type="text" name="otp" placeholder="OTP">
  <input type="submit" id="otp-submit-btn" value="Submit OTP">
';
