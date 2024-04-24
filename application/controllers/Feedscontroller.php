<?php

require_once __DIR__ . '/../models/QueryModel.php';

/**
 * Controle main shop page.
 */
class FeedsController {
  private $db;
  private $userData;

  /**
   * Constructor function to create object of QueryModel.
   */
  function __construct() {
    $this->db = new QueryModel();
  }

  /**
   * Control basic operations.
   */
  public function invoke() {
    session_start();
    if(isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      // Fetch user data.
      $this->userData = $this->db->getUserData($email);
      // Fetch products.
      $items = $this->db->fetchPoroductsByLimit(0, 16);
      // vies of product page.
      require_once __DIR__ . '/../views/shop_view.php';
    }
    // No session available.
    else {
      header('location: /login');
    }
  }
}
