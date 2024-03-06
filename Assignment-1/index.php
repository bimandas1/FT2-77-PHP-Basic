<?php

require __DIR__ . '/fetch_data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Adv Assignment-2</title>
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
  <scetion class="main-section">
    <div class="main">
      <?php for ($i = 0; $i < count($apiResponse->title); $i++) : ?>
        <div class="item">
          <!-- Image box -->
          <div class="image-box">
            <img src=<?= $apiResponse->title_img[$i] ?>>
          </div>
          <!-- Info box -->
          <div class="info-box">
            <p> <?= $apiResponse->title[$i] ?> </p>
            <!-- Icons -->
            <div class="icons">
              <?php foreach ($apiResponse->icon_arrays[$i] as $icon_path) : ?>
                <img src=<?= $icon_path ?>>
              <?php endforeach; ?>
            </div>
            <!-- Details -->
            <div class="details">
              <?= $apiResponse->details[$i]; ?>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </scetion>
</body>
<link rel="stylesheet" href="./css/index2.css">
</html>
