<?php

class LoginController {
  private $message = null;
  private $googleAuth = null;

  public function invoke() {
    if(isset($_POST['email'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      require_once __DIR__ . '/../models/QueryModel.php';
      $db = new QueryModel();
      if($db->isValidUser($email, $password) === TRUE) {
        session_start();
        $_SESSION['email'] = $email;
        header('location: /feeds');
        
      }
      else {
        $message = 'Email id or password not matched';
      }
    }

    $this->initiateGoogleAuth();

    require_once __DIR__ . '/../views/login_view.php';
  }

  public function initiateGoogleAuth() {
    require_once __DIR__ . '/../../helpers/GoogleAuthentication.php';
    $this->googleAuth = new GoogleAuthentication();
    $this->googleAuth->authenticate();
  }
}
