<?php

require __DIR__ . '/Mail.php';

if(isset($_POST['email'])) {
  $mail = new Mail();
  $mail->sendMail($_POST['email']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Adv assignment-2</title>
</head>
<body>
  <form action="./index.php" method="POST">
    <label for="email"> Email : </label>
    <input type="email" name="email">
    <input type="submit">
  </form>
</body>
</html>
