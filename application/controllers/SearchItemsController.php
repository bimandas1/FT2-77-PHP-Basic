<?php

require_once __DIR__ . '/../models/QueryModel.php';

/**
 * Control search operation.
 */
class searchItemsController {
  private $db;

  /**
   * Create object of QueryModel.
   */
  function __construct() {
    $this->db = new QueryModel();
  }

  /**
   * Control search operation.
   */
  public function invoke() {
    if($_POST['search-keywords']) {
      $search_keywords = $_POST['search-keywords'];
      // Fetch search result.
      $items = $this->db->fetchProductsBySearchKeys($search_keywords);
      // Require view.
      require_once __DIR__ . '/../views/components/items.php';
    }
  }
}
