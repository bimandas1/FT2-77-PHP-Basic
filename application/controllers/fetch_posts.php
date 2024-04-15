<?php

require_once __DIR__ . '/../models/PostModel.php';

$last_post_id = 1000000;
if(isset($_POST['last_post_id'])) {
  $last_post_id = $_POST['last_post_id'];
}

$post_table = new PostModel('post');
$posts = $post_table->fetchPostsByLimit($last_post_id, 3);

if(isset($_POST['last_post_id'])) {
  if($posts == null) {
    echo '0';
  }
  else {
    require __DIR__ . '/../views/show_posts.php';
  }
}
