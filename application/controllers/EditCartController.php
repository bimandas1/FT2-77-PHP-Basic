<?php

require_once __DIR__ . '/../models/QueryModel.php';

/**
 * Controls add/remove operations on cart.
 */
class EditCartController {
  private $db;

  /**
   * Constructor function to create object of Querymodel.
   */
  function __construct() {
    $this->db = new QueryModel();
  }

  /**
   * Function for initial operations.
   */
  public function invoke() {
    if(isset($_POST['task'])) {
      if($_POST['task'] == 'update-cart') {
        $this->updateCart();
      }
    }
  }

  /**
   * Function for update operations on cart.
   */
  public function updateCart() {
    session_start();
    $user_id = $_SESSION['email'];
    $product_id = $_POST['product-id'];
    $change = $_POST['change'];

    // If user - product not exists.
    if($this->db->isUserProductRowExist($user_id, $product_id) == FALSE) {
      // create row of new user - product.
      $this->db->insertUserProductRow($user_id, $product_id);
    }

    // Update cart.
    $this->db->updateCart($user_id, $product_id, $change);

    // Respond updated product quantity and total price.
    $cartDetails = $this->db->getCartDetails($user_id);
    $total_amount = 0;
    $updated_quantity = 0;

    foreach($cartDetails as $item) {
      $total_amount += $item['price'] * $item['quantity'];
      if($item['id'] == $product_id) {
        $updated_quantity = $item['quantity'];
      }
    }

    $respond = array(
      'updated_quantity' => $updated_quantity,
      'total_amount' => $total_amount
    );

    echo json_encode($respond);
  }
}
