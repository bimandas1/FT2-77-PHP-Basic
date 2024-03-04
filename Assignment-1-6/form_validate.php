<?php

include __DIR__ . '/email_validate.php';

// Default value.
$valid_full_name = TRUE;
$valid_phone = TRUE;
$email_check = '';
$sub_mark_check = TRUE;

// If Form submitted.
if (isset($_POST['submit'])) {
  // Get first_name & last_name.
  $full_name = $_POST['first-name'] . " " . $_POST['last-name'];
  if (!preg_match('/^[a-z A-Z]*$/', $full_name)) {
    $valid_full_name = FALSE;
  }

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
  // Convert the input string (sub|mark) in associative array of `sub => mark`.
  $marks_arr = explode("\n", $marks_str);

  foreach ($marks_arr as $element) {
    // Remove white spaces.
    $element = trim($element);
    // Check RegEx of element, that should be as `subject|mark`.
    if (!preg_match('/^[A-Za-z0-9]+[|][0-9]+$/', $element)) {
      $sub_mark_check = FALSE;
    }
  }

  $sub_mark_arr = array();
  if ($sub_mark_check === TRUE) {
    foreach ($marks_arr as $key => $mark) {
      $sub_mark = explode('|', $mark);
      $sub_mark_arr[$sub_mark[0]] = $sub_mark[1];
    }
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

    if (is_valid_email($email) == TRUE) {
      $email_check = 'valid';
    }
    else {
      $email_check = 'invalid';
    }
  }
}
