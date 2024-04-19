<?php

require_once __DIR__ . '/../../core/Dotenv.php';

/**
 * Connect with database.
 */
class Database {
  public $conn;

  /**
   * Constructor function to make connection with database.
   */
  function __construct () {
    // Load environment variables.
    $dotEnv = new Dotenv();

    $dbname = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}";
    $username = $_ENV['DB_USER_NAME'];
    $password = $_ENV['DB_PASSWORD'];

    try {
      // Connect with database.
      $this->conn = new PDO($dbname, $username, $password);
    }
    catch (Exception $err) {
      echo 'Error message : ' . $err->getMessage();
    }
  }
}
