<?php

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Class to provide environment variables.
 */
class Dotenv {
  /**
   * Constructor function to create object of Dotenv class
   * and load environment variables.
   */
  public function __construct() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  }
}
