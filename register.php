<?php

require __DIR__ . '/validate_email.php';
// start session.
session_start();
// Warning message.
$warning_msg = '';

// POST request - email submission.
if (isset($_POST['id'])) {
  require __DIR__ . '/authenticate.php';

  $id = $_POST['id'];
  // User already registered.
  if ($db->isExistingUser($id) == TRUE) {
    $warning_msg = 'You are already registered';
  }
  // Email is not valid.
  else if (is_valid_email($id) == FALSE) {
    $warning_msg = 'Invalid Email Id';
  }
  // Email is valid and not already registered.
  else {
    $_SESSION['authenticate_email'] = $id;
    // redirec t for OTP verification.
    header('location: ./otp_validation.php?msg=OTP has been sent to your email');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> New user Registeration </title>
  <link rel="stylesheet" href="css/data_input.css">
</head>
<body>
  <div class="main">
    <!-- If user is already registered -->
    <?php if ($warning_msg != ''): ?>
      <div class="alert wrong">
        <p><?= $warning_msg ?></p>
      </div>
    <?php endif; ?>

    <div class="data-input">
      <div class="title">
        <p>Register</p>
      </div>

      <!-- Input form -->
      <form action="./register.php" method="POST">
        <label for="id"> Id : </label>
        <input type="text" name="id" placeholder="Email Id">
        <input type="submit">
      </form>
    </div>
  </div>
</body>
</html>
