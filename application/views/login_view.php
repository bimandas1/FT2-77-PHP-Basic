<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
  <div class="main">
    <!-- Alert message -->
    <?php if ($message !== null) : ?>
      <div class="alert">
        <p class="alert-message"> <?= $message ?> </p>
      </div>
    <?php endif; ?>

    <!-- Alert message (by JS) -->
    <div class="alert" id="alert-by-js">
      <p class="alert-message" id="alert-message"> </p>
    </div>

    <!-- Title -->
    <div class="data-input">
      <div class="title">
        <p>Log In</p>
      </div>

      <!-- Input form -->
      <form action="/login" method="POST">
        <input type="text" name="email" placeholder="Email Id">
        <input type="text" name="password" placeholder="Password">
        <input type="submit" name="submit">
      </form>

      <!-- Login through Google auth -->
      <div class="google-login">
        <!-- Get authenticate url -->
        <a href="<?= $this->googleAuth->getAuthUrl() ?>"> Login with Google </a>
      </div>
    </div>

    <!-- Reset password link -->
    <div class="reset-password">
      <span>Forgot Password ? </span>
      <a href="/reset-password"> Reset password </a>
    </div>

    <!-- Register password link -->
    <div class="register">
      <span>New user ? </span>
      <a href="/register"> Register </a>
    </div>

  </div>
</body>

</html>
