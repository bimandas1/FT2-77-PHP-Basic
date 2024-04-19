<?php

require_once __DIR__ . '/../models/QueryModel.php';
require_once __DIR__ . '/../../helpers/Validator.php';
require_once __DIR__ . '/../../helpers/Mail.php';

class ResetPasswordController {
  private $db;
  private $validator;
  private $mail;


  function __construct() {
    $this->db = new QueryModel();
    $this->validator = new Validator();
    $this->mail = new Mail();
  }

  public function invoke() {
    // If POST request.
    if($_POST['task']) {
      if($_POST['task'] === 'submit-email') {
        $this->verifyEmail();
      }
      else if($_POST['task'] === 'submit-otp') {
        $this->verifyOtp();
      }
      else if($_POST['task'] === 'submit-new-password') {
        $this->changePassword();
      }
    }
    else {
      require_once __DIR__ . '/../views/reset_password_view.php';
    }
  }

  public function verifyEmail() {
    $email = $_POST['email'];
    // Not existing user.
    if($this->db->isExistingUser($email) === FALSE) {
      echo "The email is not registered !";
    }
    // Registered user.
    else {
      session_start();
      $_SESSION['reset_email'] = $email;
      // Generate OTP.
      $otp = random_int(1000, 9999);
      $_SESSION['reset_otp'] = $otp;
      // Send OTP to user's mail.
      if($this->mail->sendMail($email, $otp) == TRUE) {
        // Respond ok.
        echo '1';
      }
      else {
        echo 'Error while sending mail';
      }
    }
  }

  public function verifyOtp() {
    $otp = $_POST['otp'];
    session_start();
    // OTP not matched.
    if($otp != $_SESSION['reset_otp']) {
      // Unset session variables.
      session_unset();
      echo "OTP is not matched !";
    }
    // OTP matched.
    else {
      $_SESSION['reset_otp_matched'] = TRUE;
      // Respond ok.
      echo '1';
    }
  }

  public function changePassword() {
    $new_password = $_POST['new-password'];
    session_start();
    // No session available for reset password.
    if($_SESSION['reset_otp_matched'] !== TRUE) {
      echo "You didn't have validated your email";
    }
    // If new password is not valid.
    else if($this->validator->passwordValidate($new_password) == FALSE) {
      echo "New password is invalid.";
    }
    // Change the password.
    else {
      if($this->db->changePassword($_SESSION['reset_email'], $new_password) === TRUE) {
        echo "Your password has been changed.";
      }
      else {
        echo "Something is wrong ! Please try again";
      }
    }
    // Unset session variables.
    session_unset();
  }
}

