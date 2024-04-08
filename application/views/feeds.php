<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feeds</title>
  <link rel="stylesheet" href="/public/css/feeds_style.css?<?= time() ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="left">
      <a href="/Login" class="logo"> Unsocial </a>
    </div>
    <div class="right">
      <a href="/Login" class="user-profile-link"> Log Out </a>
      <a href="/Profile" class="user-profile-link"> <?= $user_data[0]['fname'] . ' ' . $user_data[0]['lname'] ?> </a>
    </div>
  </div>

  <!-- Search -->
  <div class="search-section">
    <div class="search">
      <input type="text" name="search" id="search-post" placeholder="Search a post">
    </div>
  </div>

  <!-- Add Post -->
  <div class="add-post-section">
    <div class="add-post">
      <!-- <form method="POST" enctype="multipart/form-data"> -->
      <textarea id="post-text-input" name="text" cols="30" rows="4"></textarea>
      <input type="file" id="post-media-input" name="media" id="add-post-media-input">
      <button id="add-post-btn"> Add Post</button>
      <!-- </form> -->
    </div>
  </div>

  <!-- Feeds -->
  <div class="feeds-section" id="feeds-posts">
    <!-- Fetch Posts on page load -->
    <?php
    // require_once './application/controllers/fetch_posts.php';
      require_once __DIR__ . '/show_posts.php';
    ?>

    <!-- More loaded posts will be appended here -->
  </div>

  <!-- For searched posts -->
  <div class="feeds-section" id="searched-posts">
    <!-- Searched posts will be added here -->
  </div>

  <!-- Load more button -->
  <div class="load-more">
    <button id="load-more-btn"> Load more </button>
  </div>
</body>
<script src="/public/script/feeds_script.js?<='x'?>"> </script>

</html>
