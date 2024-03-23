<?php

require __DIR__ . '/validate_email.php';
require __DIR__ . '/manage_session.php';
// Start session.
session_start();
// warning message.
$warning_already_registered = '';

// No email is set in session.
if(isset($_SESSION['email_authenticated']) == FALSE) {
  die("
    No session for this page.
    <br>
    Go to <a href='./index.php'> Log In </a> page
  ");
}

// POST request - New password submission.
if (isset($_POST['new-password'])) {
  require __DIR__ . '/authenticate.php';

  $email = $_SESSION['authenticate_email'];
  $new_password = $_POST['new-password'];
  $message = '';

  // If existing user then change password.
  if ($db->isExistingUser($email) == TRUE) {
    $db->changePassword($email, $new_password);
    $message = 'Password changed';
  }
  else {
    // Not existing user. Add as new user.
    $db->addNewUser($email, $new_password);
    $message = 'New account created';
  }

  // End session.
  end_session();
  header("location: ./index.php?msg=$message");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Set New Password </title>
  <link rel="stylesheet" href="css/data_input.css">
</head>
<body>
  <div class="main">
    <!-- If user is already registered -->
    <?php if ($warning_already_registered != '') : ?>
      <div class="alert wrong">
        <p><?= $warning_already_registered ?></p>
      </div>
    <?php endif; ?>

    <div class="data-input">
      <div class="title">
        <p>Set New Password</p>
      </div>

      <!-- Input form -->
      <form action="./set_password.php" method="POST">
        <label for="new-password"> Password : </label>
        <input type="text" name="new-password" placeholder="Password">
        <input type="submit">
      </form>
    </div>
  </div>
</body>
</html>
