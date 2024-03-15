<?php

$warning_already_registered = FALSE;

if (isset($_POST['id'])) {
  require __DIR__ . '/authenticate.php';

  $id = $_POST['id'];
  $password = $_POST['password'];

  // User already registered.
  if ($db->isExistingUser($id) == TRUE) {
    $warning_already_registered = TRUE;
  }
  else {
    // User is not already registered, add new id - password.
    $db->addNewUser($id, $password);
    header('location: ./index.php?msg=You have been signed up');
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
    <?php if ($warning_already_registered == TRUE): ?>
      <div class="alert wrong">
        <p>You are already registered</p>
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
        <label for="password"> Password : </label>
        <input type="text" name="password" placeholder="Password">
        <input type="submit">
      </form>
    </div>
  </div>
</body>

</html>
