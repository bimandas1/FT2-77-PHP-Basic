<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" href="./public/css/input_form.css">
</head>

<body>
  <div class="main">
    <!-- Alert message -->
    <?php if ($msg != null) : ?>
      <div class="alert wrong">
        <p> <?= $msg ?> </p>
      </div>
    <?php endif; ?>

    <!-- Title -->
    <div class="data-input">
      <div class="title">
        <p>Log In</p>
      </div>

      <!-- Input form -->
      <form action="/Login" method="POST">
        <input type="text" name="email" placeholder="Email Id">
        <input type="text" name="password" placeholder="Password">
        <input type="submit" name="submit">
      </form>

    </div>

    <!-- Reset password link -->
    <div class="reset-password">
      <span>Forgot Password ? </span>
      <a href="/Reset-password"> Reset password </a>
    </div>

    <!-- Register password link -->
    <div class="register">
      <span>New user ? </span>
      <a href="/Register"> Register </a>
    </div>
  </div>
</body>

</html>
