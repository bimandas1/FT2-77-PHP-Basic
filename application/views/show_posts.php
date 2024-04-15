<?php foreach ($posts as $post) : ?>
  <div class="feed-block" id="<?=$post['id']?>">
    <p class="post-email"> <?= $post['email'] ?> </p>
    <p class="post-time"> Posted at <?= $post['time'] ?> </p>

    <!-- Post media -->
    <?php if ($post['media'] != null) : ?>
      <div class="post-media-box">
        <?= '<img class="post-media" src="data:image;base64,' . base64_encode($post['media']) . '">' ?>
      </div>
    <?php endif; ?>

    <!-- Post text -->
    <?php if ($post['text'] != null) : ?>
      <p class="post-text"> <?= $post['text'] ?> </p>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
