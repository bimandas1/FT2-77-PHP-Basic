<?php

require_once __DIR__ . '/../models/QueryModel.php';

/**
 * Control new user registeration.
 */
class RegisterController {
  private $db;

  /**
   * Constructor function to create object of QueryModel.
   */
  function __construct() {
    $this->db = new QueryModel();
  }

  /**
   * Function to control new user registeration.
   */
  function invoke() {
    // If POST request.
    if(isset($_POST['task'])) {
      if($_POST['task'] === 'submit-user-data') {
        $this->sendOtp();
      }
      else if($_POST['task'] === 'submit-otp') {
        $this->validateOtp();
      }
    }
    else {
      require_once __DIR__ . '/../views/register_view.php';
    }
  }

  /**
   * Get user's data and send otp.
   */
  public function sendOtp() {
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
      $mail->setReceiver($_POST['email']);
      $mail->setMailForOTP($otp);
      $mail->sendMail();
      // Respond ok.
      echo '1';
    }
  }

  /**
   * Validate user input otp.
   */
  public function validateOtp() {
    $submitted_otp = $_POST['otp'];
    session_start();
    // If OTP matched.
    if($submitted_otp == $_SESSION['otp']) {
      // Save to DB.
      if($this->db->addUser($_SESSION['email'], $_SESSION['password'], $_SESSION['fname'], $_SESSION['lname']) === TRUE) {
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
