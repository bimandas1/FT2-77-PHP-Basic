<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    <!-- User data input div (visible only at user data input) -->
    <div class="data-input" id="user-data-input-box">
      <div class="title">
        <p>Register</p>
      </div>

      <form id="form-user-data-for-register">
        <input type="hidden" name="task" value="submit-user-data">
        <input type="text" name="email" placeholder="Email Id">
        <input type="text" name="fname" placeholder="First name">
        <input type="text" name="lname" placeholder="Last name">
        <input type="text" name="password" placeholder="Password">
        <input type="text" name="reenter-password" placeholder="Reenter password">
        <input type="submit" name="submit">
      </form>
    </div>

    <!-- OTP input div (visible only after submitting user data and generating OTP) -->
    <div class="data-input" id="otp-input-box">
      <div class="title">
        <p>Input OTP</p>
      </div>

      <form id="form-submit-otp">
        <input type="hidden" name="task" value="submit-otp">
        <input type="text" name="otp" placeholder="OTP">
        <input type="submit" name="submit">
      </form>
    </div>

    <!-- Reset password link -->
    <div class="reset-password">
      <span>Forgot Password ? </span>
      <a href="/reset-password"> Reset password </a>
    </div>

    <!-- Login link -->
    <div class="login">
      <span>Already registered ? </span>
      <a href="/login"> Go to Login </a>
    </div>

  </div>
</body>
<script src="/public/script/register_script.js"></script>
<script src="/public/script/script.js"></script>

</html>
