<?php

if (isset($_POST['id'])) {
  require __DIR__ . '/authenticate.php';
  require __DIR__ . '/random_string.php';
  require __DIR__ . '/mail.php';

  $email_not_registered = FALSE;

  $id = $_POST['id'];

  // If user id is valid.
  if ($db->isExistingUser($id) == TRUE) {
    // New unique password (random string).
    $new_random_password = generateRandomString(6);
    // Change ol password with the new one (random string).
    $db->changePassword($id, $new_random_password);
    // Send the new password (random string) to the user's email.
    mailer($id, $new_random_password);

    header('location: ./change_password.php?msg=New password have been generated and sent to your email');
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
