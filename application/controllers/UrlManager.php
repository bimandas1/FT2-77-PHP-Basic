<?php

require_once __DIR__ . '/LoginController.php';
require_once __DIR__ . '/RegisterController.php';
require_once __DIR__ . '/ResetPasswordController.php';
require_once __DIR__ . '/Feedscontroller.php';
require_once __DIR__ . '/ErrorController.php';

class UrlManager {
  private $page;
  // function __construct(string $page) {
  //   $this->page = $page;
  // }

  public function load(string $page) {
    switch ($page) {
      case '':
      case 'login':
        $loginController = new LoginController();
        $loginController->invoke();
        break;

      case 'register':
        $registerController = new RegisterController();
        $registerController->invoke();
        break;

      case 'reset-password':
        $resetPasswordController = new ResetPasswordController();
        $resetPasswordController->invoke();
        break;

      case 'feeds':
        $feedsController = new FeedsController();
        $feedsController->invoke();
        break;

      default:
        // echo '404 Error !';
        header('HTTP/1.0 404 not found');
    }
  }
}
