<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= $user_data[0]['fname'] . ' ' . $user_data[0]['lname'] ?> </title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="./public/css/profile_style.css?<?= time() ?>">
  <link rel="stylesheet" href="./public/css/input_form.css?<?= time() ?>">
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="left">
      <a href="/Login" class="logo"> Unsocial </a>
    </div>
    <div class="right">
      <a href="/Feeds" class="user-profile-link"> Feeds </a>
      <a href="/Login" class="user-profile-link"> Log Out </a>
    </div>
  </div>

  <h1> Hello <?= $user_data[0]['fname'] . ' ' . $user_data[0]['lname'] ?> </h1>

  <div class="main">

    <!-- Update fname, lname -->
    <div class="data-input">
      <div class="title">
        <p>Update profile</p>
      </div>

      <!-- Input form -->
      <input type="text" name="fname" value="<?= $user_data[0]['fname'] ?>">
      <input type="text" name="lname" value="<?= $user_data[0]['lname'] ?>">
      <input type="submit" name="update-user-info" id="update-user-info" value="Update">
    </div>

    <!-- Update password -->
    <div class="data-input">
      <div class="title">
        <p>Update Password</p>
      </div>

      <!-- Input form -->
      <input type="password" name="current-password" placeholder="Enter your current password">
      <input type="password" name="new-password" placeholder="Enter new password">
      <input type="password" name="reenter-new-password" placeholder="Re-enter new password">
      <input type="submit" name="update-user-password" id="update-user-password" value="Update password">
    </div>

    <h3> Your posts </h3>

    <!-- Feeds -->
    <div class="feeds-section">
      <!-- Fetch Posts -->
      <?php require_once __DIR__ . '/show_posts.php'; ?>
    </div>
  </div>
</body>
<script src="/public/script/profile_script.js"></script>

</html>
