<?php

require __DIR__ . '/form_validate.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <section>
    <!-- Show user's data -->
    <div class="output">
      <!-- Display user's name -->
      <p>Hello <b> <?= $full_name; ?> </b> </p>
      <!-- Show Full name is valid or not -->
      <?php if ($valid_full_name === FALSE) : ?>
        <p class='wrong'> Name is not valid </P>
      <?php endif; ?>

      <!-- Display Image -->
      <?php if ($img_upload === 'successful') : ?>
        <img src='<?= $target_file ?>' alt='Uploaded Image'>
      <?php elseif ($img_upload === "unsuccessful") : ?>
        <p class='wrong'> Image not uploaded successfully ! </p>"
      <?php endif; ?>

      <!-- Display user's Phone number -->
      <p><b>Phone number : </b> <?= $phone ?> </p>
      <!-- Show phone number is valid or not -->
      <?php if ($valid_phone === FALSE) : ?>
        <p class='wrong'> Invalid phone number </p>
      <?php endif; ?>

      <!-- Display user's Email -->
      <p><b>Email Id : </b> <?= $email ?> </p>
      <!-- Show email is valid or not -->
      <?php if ($email_check == 'valid') : ?>
        <p class='correct'> Valid Email Id </p>
      <?php elseif ($email_check == 'invalid') : ?>
        <p class='wrong'> Invalid Email Id </p>
      <?php endif; ?>

      <!-- Display Marks table -->
      <!-- Show Subject-mark table is valid or not -->
      <?php if ($sub_mark_check === FALSE) : ?>
        <p class='wrong'> Invalid Subject-mark input given </p>
      <?php endif; ?>

      <?php if ($sub_mark_check === TRUE) : ?>
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
        <?php if ($sub_mark_check === TRUE) : ?>
        </table>
      <?php endif; ?>
    </div>
  </section>
</body>

<?php
// If Full name, phone number and email is valid then include pdf.php page.
if ($valid_full_name == TRUE && $valid_phone == TRUE && $email_check == 'valid') {
  include __DIR__ . '/pdf.php';
}
?>

</html>
