<?php

use Google\Service\AdExchangeBuyerII\Buyer;
use Google\Service\ShoppingContent\Breakdown;

require_once __DIR__ . '/LoginController.php';
require_once __DIR__ . '/RegisterController.php';
require_once __DIR__ . '/ResetPasswordController.php';
require_once __DIR__ . '/Feedscontroller.php';
require_once __DIR__ . '/SearchItemsController.php';
require_once __DIR__ . '/EditCartController.php';
require_once __DIR__ . '/CartController.php';
require_once __DIR__ . '/BuyController.php';
require_once __DIR__ . '/ErrorController.php';

/**
 * Manage paths and require pages.
 */
class UrlManager {
  /**
   * Require pages accourding to the path.
   *
   * @param string $page
   *   Path of the page.
   */
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

      case 'search-items':
        $searchItemsController = new searchItemsController();
        $searchItemsController->invoke();
        break;

      case 'edit-cart':
        $editCartController = new EditCartController();
        $editCartController->invoke();
        break;

      case 'cart':
        $cartController = new CartController();
        $cartController->invoke();
        break;

      case 'buy':
        $buyController = new BuyController();
        $buyController->invoke();
        break;

      default:
        header('HTTP/1.0 404 not found');
    }
  }
}
