<?php

include __DIR__ . '/emailValidate.php';

// Default value.
$valid_phone = TRUE;
$email_check = '';

// If Form submitted.
if (isset($_POST['submit'])) {
  // Get first_name & last_name.
  $first_name = $_POST['first-name'];
  $last_name = $_POST['last-name'];

  // Get image.
  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $target_file = './images/' . basename($_FILES['image']['name']);

    // Move uploaded image to 'images' folder.
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      $img_upload = 'successful';
    }
    else {
      $img_upload = 'unsuccessful';
    }
  }

  // Get sujects and marks string.
  $marks_str = $_POST['subject-marks'];
  // Convert the string in array of `sub|mark'.
  $marks_arr = explode("\n", $marks_str);
  // Convert the $marks_arr array in associative array of `sub => mark`.
  $sub_mark_arr = array();

  foreach ($marks_arr as $key => $mark) {
    $sub_mark = explode('|', $mark);
    $sub_mark_arr[$sub_mark[0]] = $sub_mark[1];
  }

  // Get phone number and validate it.
  if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    if (strlen($phone) == 13 && preg_match('/^\+91[0-9]{10}$/', $phone)) {
      $valid_phone = TRUE;
    }
    else {
      $valid_phone = FALSE;
    }
  }

  // Get Email and validate it.
  if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (isValidEmail($email) == TRUE) {
      $email_check = 'valid';
    }
    else {
      $email_check = 'invalid';
    }
  }

  // If phone number and email is valid then redirect to pdf.php page.
  if ($valid_phone == TRUE && $email_check == 'valid') {
    // Session start
    session_start();
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;

    header('Location: pdf.php');
    exit;
  }
}
