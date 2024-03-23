<?php

// POST request - Eamil submission.
if (isset($_POST['id'])) {
  require __DIR__ . '/authenticate.php';
  require __DIR__ . '/random_string.php';
  require __DIR__ . '/mail.php';

  $id = $_POST['id'];
  // Warning message.
  $email_not_registered = FALSE;

  // If user id exists in database.
  if ($db->isExistingUser($id) == TRUE) {
    session_start();
    $_SESSION['authenticate_email'] = $id;
    // Redirect for OTP verification.
    header('location: ./otp_validation.php?msg=OTP has been sent to your email');
  }
  else {
    $email_not_registered = TRUE;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Reset password </title>
  <link rel="stylesheet" href="css/data_input.css">
</head>
<body>
  <div class="main">
    <!-- User id is not registered -->
    <?php if ($email_not_registered == TRUE) : ?>
      <div class="alert wrong">
        <p>Email is in not registered.</p>
      </div>
    <?php endif; ?>

    <div class="data-input">
      <div class="title">
        <p>Reset password</p>
      </div>

      <!-- Input form -->
      <form action="./reset_password.php" method="POST">
        <input type="text" name="id" placeholder="Email Id">
        <input type="submit">
      </form>
    </div>
  </div>
</body>
</html>
