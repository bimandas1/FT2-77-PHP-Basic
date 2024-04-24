<?php

/**
 * Control user login.
 */
class LoginController {
  private $message = null;
  private $googleAuth = null;

  /**
   * Function to control user login.
   */
  public function invoke() {
    if(isset($_POST['email'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Initialize object of QueryModel.
      require_once __DIR__ . '/../models/QueryModel.php';
      $db = new QueryModel();
      // If valid user.
      if($db->isValidUser($email, $password) === TRUE) {
        session_start();
        $_SESSION['email'] = $email;
        header('location: /feeds');

      }
      else {
        $message = 'Email id or password not matched';
      }
    }

    // Call the function to initialize google authentication.
    $this->initiateGoogleAuth();
    // Require login view.
    require_once __DIR__ . '/../views/login_view.php';
  }

  public function initiateGoogleAuth() {
    require_once __DIR__ . '/../../helpers/GoogleAuthentication.php';
    $this->googleAuth = new GoogleAuthentication();
    // Check if login through google is possible.
    $this->googleAuth->authenticate();
  }
}
