<?php

include __DIR__ . '/emailValidate.php';

$firstName = $lastName = $marksStr = '';

$targetFile = '';
$imgUpload = '';

$subMarkArr = '';

$phone = '+91';
$validPhone = TRUE;

$email = '';
$emailCheck = '';


// If Form submitted
if (isset($_POST['submit'])) {

  // Get firstName & lastName
  $firstName = $_POST['first-name'];
  $lastName = $_POST['last-name'];

  // Get image
  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $targetFile = 'uploads/' . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      $imgUpload = 'successful';
    }
    else {
      $imgUpload = 'unsuccessful';
    }
  }

  // Get suject marks
  $marksStr = $_POST['subject-marks'];
  $marks_arr = explode('\n', $marksStr); // Convert the string in array of `sub|mark'
  $subMarkArr = array();  // Associative array of `sub => mark`

  foreach ($marks_arr as $key => $mark) {
    $sub_mark = explode('|', $mark);
    $subMarkArr[$sub_mark[0]] = $sub_mark[1];
  }

  // Get phone number
  if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    if (strlen($phone) == 13 && preg_match('/^\+91[0-9]{10}$/', $phone)) {
      $validPhone = TRUE;
    }
    else {
      $validPhone = FALSE;
    }
  }

  // Get Email
  if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (isValidEmail($email) == TRUE) {
      $emailCheck = 'valid';
    }
    else {
      $emailCheck = 'invalid';
    }
  }

  // Create,save and download user datas in pdf format.
  if ($validPhone == TRUE && $emailCheck == 'valid') {
    // Session start
    session_start();
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;

    header('Location: pdf.php');

    exit;
  }
}
