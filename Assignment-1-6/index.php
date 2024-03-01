<?php

include __DIR__ . '/form.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> PHP Basic Assignment </title>
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <section class="hero">
    <div class="login-main">
      <!-- User's input form -->
      <div class="user-input">
        <form action="<?= $_FORM['php_self'] ?>" method="POST" enctype="multipart/form-data">
          First Name :
          <input type="text" id="first-name" name="first-name">
          Last Name :
          <input type="text" id="last-name" name="last-name">
          Full Name :
          <input type="text" id="full-name" name="full-name" disabled>
          Image :
          <input type="file" name="image">
          Phone number :
          <input type="text" name="phone" value="+91">
          <!-- After submitting phone number, show it is valid or not -->
          <?php if ($valid_phone === FALSE) : ?>
            <p class='wrong'> Invalid phone number </P>
          <?php endif; ?>
          Email :
          <input type="text" name="email">
          <!-- After submitting email, show it is valid or not -->
          <?php if ($email_check == 'valid') : ?>
            <p class='correct'> Valid Email Id </p>
          <?php elseif ($email_check == 'invalid') : ?>
            <p class='wrong'> Invalid Email Id </p>
          <?php endif; ?>
          Subject Marks :
          <textarea name="subject-marks" rows='6' cols='30'></textarea>
          <input type="submit" name="submit">
        </form>
      </div>

      <!-- Show user's data -->
      <div class="output">
        <!-- Display user's name -->
        <?php if (strlen($first_name) > 0) : ?>
          <p>Hello <?= "$first_name $last_name"; ?></p>
        <?php endif; ?>

        <!-- Display Image -->
        <?php if ($img_upload === 'successful') : ?>
          <img src='<?= $target_file ?>' alt='Uploaded Image'>
        <?php elseif ($img_upload === "unsuccessful") : ?>
          <p class='wrong'> Image not uploaded successfully ! </p>"
        <?php endif; ?>

        <!-- Display Marks table -->
        <!-- If there is atleast some value in textarea -->
        <?php if (empty($marks_str) === FALSE) : ?>
          <table>
            <tr>
              <th> Subject </th>
              <th> Mark </th>
            </tr>
          <?php endif; ?>
          <!-- Prints the subject & mark in table rows -->
          <?php foreach ($sub_mark_arr as $sub => $mark) : ?>
            <tr>
              <td> <?= $sub; ?> </td>
              <td> <?= $mark; ?> </td>
            </tr>
          <?php endforeach; ?>
          <!-- If there is atleast some value in textarea -->
          <?php if (empty($marks_str) === FALSE) : ?>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </section>
</body>
<script src="./scripts/index.js"></script>
</html>
