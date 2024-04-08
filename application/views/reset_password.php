<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="/public/css/input_form.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <div class="main">

    <!-- New user input form -->
    <div class="data-input">
      <div class="title">
        <p>Reset Password</p>
      </div>

      <form id="reset-password-submit-form">
        <input type="email" name="email" placeholder="Email Id" required>
        <input type="text" name="password" placeholder="New password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" required>
        <input type="submit" id="reset-password-submit-btn" value="Submit">
      </form>
    </div>

  </div>
</body>
<script src="public/script/reset_password_script.js"></script>

</html>
