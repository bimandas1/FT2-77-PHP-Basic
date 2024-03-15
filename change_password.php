<?php

$warning_id_or_old_password_incorrect = FALSE;

if (isset($_POST['id'])) {
  require __DIR__ . '/authenticate.php';
  require __DIR__ . '/mail.php';

  $id = $_POST['id'];
  $old_password = $_POST['old-password'];
  $new_password = $_POST['new-password'];

  // If user id and old password is valid.
  if ($db->isValidUser($id, $old_password) == TRUE) {
    // Change password with the new one.
    $db->changePassword($id, $new_password);
    header('location: ./index.php?msg=Password changed');
  }
  else {
    $warning_id_or_old_password_incorrect = TRUE;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Change password </title>
  <link rel="stylesheet" href="css/data_input.css">
</head>
<body>
  <div class="main">
    <!-- Warning : Id & old-password not matched -->
    <?php if ($warning_id_or_old_password_incorrect == TRUE) : ?>
      <div class="alert wrong">
        <p>Id and Old password are not matching</p>
      </div>
    <?php endif; ?>

    <!-- GET parameters -->
    <?php if (isset($_GET['msg'])) : ?>
      <div class="alert">
        <p><?= $_GET['msg'] ?></p>
      </div>
    <?php endif; ?>

    <div class="data-input">
      <div class="title">
        <p>Change password</p>
      </div>
      <!-- Input form -->
      <form action="./change_password.php" method="POST">
        <input type="text" name="id" placeholder="Email Id">
        <input type="text" name="old-password" placeholder="Old password">
        <input type="text" name="new-password" placeholder="New password">
        <input type="submit">
      </form>
    </div>
  </div>
</body>

</html>
