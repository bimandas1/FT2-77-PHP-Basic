<?php

require_once __DIR__ . '/../models/QueryModel.php';

/**
 * Control cart view.
 */
class CartController {
  private $db;

  /**
   * Constructor function to create object of QueryModel.
   */
  function __construct() {
    $this->db = new QueryModel();
  }

  /**
   * Function for basic operations.
   */
  public function invoke() {
    session_start();
    if(isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      // Get cart details.
      $cartDetails = $this->db->getCartDetails($email);
      // Total amount.
      $totalAmount = 0;
      foreach($cartDetails as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
      }

      // Require view.
      require_once __DIR__ . '/../views/cart_view.php';
    }
    else {
      header('location: /login');
    }
  }
}
