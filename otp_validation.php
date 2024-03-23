<?php

require __DIR__ . '/random_string.php';
require __DIR__ . '/mail.php';

session_start();
// Set Time-zone.
date_default_timezone_set("Asia/Kolkata");
// warning message.
$warning_msg = '';

// If email is not set in session.
if(isset($_SESSION['authenticate_email']) == FALSE) {
  die("
    No session for this page.....
    <br>
    Go to <a href='./index.php'> Log In </a> page
  ");
}

// POST request - Resend OTP.
if (isset($_POST['resend-otp-request'])) {
  $curr_time = strtotime('now');
  $resend_otp_activation_time = $_SESSION['resend_otp_activation_time'];
  // If current time is greater/equal 'Resend OTP' activation time.
  if ($curr_time >= $resend_otp_activation_time) {
    // Reload the page to send a new OTP.
    header('location: ./otp_validation.php?msg=A new OTP has been sent to your email');
  }
  // Client side must have been modified to send this request before reset otp activation time.
  else {
    header('location: ./index.php?msg=Client side must have modified to send this request before reset otp activation time.');
  }
}

// POST request - OTP check.
if (isset($_POST['otp'])) {
  $curr_time = strtotime('now');
  $otp_expire_time = $_SESSION['otp_expire'];

  // If current time greater than OTP expiration time.
  if ($curr_time >= $otp_expire_time) {
    // OTP time expired. Redirect to Log in page.
    header('location: ./index.php?msg=OTP time expired.');
  }
  // If OTP matched.
  else if ($_POST['otp'] == $_SESSION['authenticate_otp']) {
    // To make sure that Email is authenticated by OTP set 'email_authenticated'
    // variable in SESSION,
    // so that direct redirect to 'set_password.php' page does not lead
    // to modify password.
    $_SESSION['email_authenticated'] = TRUE;
    header('location: ./set_password.php');
  }
  // OTP not matched.
  else {
    // Send OTP again.
    header('location: ./otp_validation.php?msg=OTP not matched. We have resent you a new OTP.');
  }
}
else {
  // If OTP is not already sent.
  if (isset($_SESSION['authenticate_otp']) == FALSE) {
    // Generate OTP and send to user's email.
    $email = $_SESSION['authenticate_email'];
    // Generate OTP of 4 length.
    $otp = generateRandomString(4);
    // Send to user's email.
    mailer($email, $otp);
    // Set OTP in session.
    $_SESSION['authenticate_otp'] = $otp;
    // Set time-zone.
    date_default_timezone_set("Asia/Kolkata");
    // Set OTP expiration time.
    $_SESSION['otp_expire'] = strtotime('+30 second');
    // Set Resend OTP option activation time.
    $_SESSION['resend_otp_activation_time'] = strtotime('+40 second');
  }
  else {
    // Modify the GET parameter.
    $_GET['msg'] = 'OTP already has been sent to your email.';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> OTP Validate </title>
  <link rel="stylesheet" href="css/data_input.css">
  <link rel="stylesheet" href="./css/otp_validation.css">
</head>
<body>
  <div class="main">
    <!-- GET message -->
    <?php if (isset($_GET['msg'])) : ?>
      <div class="alert">
        <p><?= $_GET['msg'] ?></p>
      </div>
    <?php endif; ?>

    <!-- If user is already registered -->
    <?php if ($warning_msg != '') : ?>
      <div class="alert wrong">
        <p><?= $warning_msg ?></p>
      </div>
    <?php endif; ?>

    <div class="data-input">
      <div class="title">
        <p>OTP Validate</p>
      </div>

      <!-- Input form -->
      <form action="./otp_validation.php" method="POST">
        <label for="id"> OTP : </label>
        <input type="text" name="otp" placeholder="OTP">
        <input type="submit">
      </form>
    </div>

    <!-- Resend OTP -->
    <div class="resend-otp">
      <form action="/otp_validation.php" method="POST">
        <p id="countdown-showing-line"></p>
        <input type="submit" name="resend-otp-request" value="Resend OTP">
      </form>
    </div>
  </div>
</body>
  <script src="./script/resend_otp.js"></script>
</html>
