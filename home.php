<?php

session_start();
// If session variables (id and password) are not set.
if ((isset($_SESSION['id']) && isset($_SESSION['password'])) == FALSE) {
  // Redirect to Log in page.
  header('location: ./index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Main page </title>
  <link rel="stylesheet" href="./css/home.css">
</head>
<body>
  <div class="main">
    <h2 class="greet">Hello <?= $_SESSION['id'] ?> </h2>
    <h3 class="content"> This is Main content page </h3>
  </div>
  <div class="footer">
    <a href="./index.php?msg=You have been logged out"> Log out </a>
  </div>
</body>
</html>
