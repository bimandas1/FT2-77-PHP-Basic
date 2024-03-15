<?php

require __DIR__ . '/manage_session.php';

// End session on page reload.
end_session();

$wrong_id_password = FALSE;

if (isset($_POST['id'])) {
  require __DIR__ . '/authenticate.php';

  $id = $_POST['id'];
  $password = $_POST['password'];

  if ($db->isValidUser($id, $password) == TRUE) {
    // User id - password verified.
    session_start();
    // Set Id & password to session variables.
    $_SESSION['id'] = $id;
    $_SESSION['password'] = $password;
    // Rediret to Home page.
    header('location: ./home.php');
  }
  else {
    $wrong_id_password = TRUE;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Log In </title>
  <link rel="stylesheet" href="css/data_input.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="main">
    <!-- Id - password not matched -->
    <?php if ($wrong_id_password == TRUE) : ?>
      <div class="alert wrong">
        <p>Wrong Id or password</p>
      </div>
    <?php endif; ?>

    <!-- GET message -->
    <?php if (isset($_GET['msg'])) : ?>
      <div class="alert">
        <p><?= $_GET['msg'] ?></p>
      </div>
    <?php endif; ?>

    <div class="data-input">
      <div class="title">
        <p>Log In</p>
      </div>

      <!-- Input form -->
      <form action="/" method="POST">
        <input type="text" name="id" placeholder="Email Id">
        <input type="text" name="password" placeholder="Password">
        <input type="submit">
      </form>
    </div>

    <div class="change-password">
      <a href="./change_password.php"> Change password </a>
    </div>

    <div class="reset-password">
      <span>Forgot Password ? </span>
      <a href="./reset_password.php"> Reset password </a>
    </div>

    <div class="register">
      <span>New user ? </span>
      <a href="./register.php"> Register </a>
    </div>
  </div>
</body>
</html>
