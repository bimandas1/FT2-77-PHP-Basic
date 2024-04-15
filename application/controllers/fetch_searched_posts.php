<?php

require_once __DIR__ . '/../models/PostModel.php';

if (isset($_POST['search-keys'])) {
  $search_keys = $_POST['search-keys'];
}

$post_table = new PostModel('post');
$posts = $post_table->fetchPostsBySearchKeys($search_keys);

if (isset($_POST['search-keys'])) {
  if ($posts == null) {
    echo '0';
  }
  else {
    require __DIR__ . '/../views/show_posts.php';
  }
}
