<?php

class Database {
  public $conn;

  function __construct () {
    $dbname = 'mysql:host=localhost;dbname=db5';
    $username = 'root';
    $password = '1234';

    try {
      $this->conn = new PDO($dbname, $username, $password);
    }
    catch (Exception $err) {
      echo 'Error message : ' . $err->getMessage();
    }
  }
}
