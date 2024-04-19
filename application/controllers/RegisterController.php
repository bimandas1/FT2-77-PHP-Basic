<?php

// use Google\Service\CloudSearch\Resource\Query;
require_once __DIR__ . '/../models/QueryModel.php';

class RegisterController {
  private $db;

  function __construct() {
    $this->db = new QueryModel();
  }

  function invoke() {
    // If POST request.
    if(isset($_POST['task'])) {
      if($_POST['task'] === 'submit-user-data') {
        $this->getUserData();
      }
      else if($_POST['task'] === 'submit-otp') {
        $this->validateOtp();
      }
    }
    else {
      require_once __DIR__ . '/../views/register_view.php';
    }
  }

  public function getUserData() {
    session_start();
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['password'] = $_POST['password'];

    require_once __DIR__ . '/../../helpers/Validator.php';
    $validator = new Validator();

    // User input data not valid.
    if(($validator->emailValidate($_POST['email']) && $validator->nameValidate($_POST['fname']) && $validator->nameValidate($_POST['lname']) && $validator->passwordValidate($_POST['password'])) == FALSE) {
      echo "User input data isn't valid";
    }
    // User already registered.
    else if($this->db->isExistingUser($_SESSION['email'])) {
      echo "You are already registered.";
    }
    // User input data is valid.
    else {
      // Generate OTP.
      $otp = random_int(1000, 9999);
      session_start();
      $_SESSION['otp'] = $otp;
      // Send OTP to mail.
      require_once __DIR__ . '/../../helpers/Mail.php';
      $mail = new Mail();
      $mail->sendMail($_POST['email'], $otp);
      echo '1';
    }
  }

  public function validateOtp() {
    $submitted_otp = $_POST['otp'];
    session_start();
    if($submitted_otp === $_SESSION['otp']) {
      // Save to DB.
      if($this->db->addUser($_SESSION['email'], $_SESSION['fname'], $_SESSION['lname'], $_SESSION['password']) === TRUE) {
        echo 'You have been registered.';
      }
      else {
        // Unset session variables.
        session_unset();
        echo 'Unsuccessfull ! Try again.';
      }
    }
    else {
      echo "OTP didn't matched.";
    }
  }
}
