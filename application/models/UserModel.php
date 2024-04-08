<?php

require_once __DIR__ . '/Database.php';

/**
 * Perform queries on user table.
 */
class UserModel extends Database {
  public $table;

  /**
   * Constructor function to use the connection with database.
   *
   * @param string $tableName
   *  User table's name.
   */
  function __construct ($tableName) {
    parent::__construct();
    $this->table = $tableName;
  }

  public function isExistingUser ($email) {
    try {
      $sql = $this->conn->prepare("select email from {$this->table} where email = ?");
      $sql->execute([$email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      echo 'Error in database.';
    }
  }

  public function changePassword ($email, $password) {
    try {
      $sql = $this->conn->prepare("update {$this->table} set password = ? where email = ?");
      $sql->execute([$password, $email]);
      if($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      echo 'Error in database.';
    }
  }

  public function isValidUser ($email, $password) : bool {
    $ret = ['res' => null , 'err' => null];
    try {
      $sql = $this->conn->prepare("select password from {$this->table} where email = ? AND password = ?");
      $sql->execute([$email, $password]);

      return $sql->rowCount() > 0;
    }
    catch (Exception $err) {
      return false;
    }
  }

  public function addUser ($email, $password, $fname, $lname) {
    try {
      $sql = $this->conn->prepare("insert into {$this->table} values (?, ?, ?, ?)");
      $sql->execute([$email, $password, $fname, $lname]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      echo 'Error in database.';
    }
  }

  public function getUserData($email) {
    try {
      $sql = $this->conn->prepare("Select fname, lname from user {$this->table} where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    }
    catch (Exception) {
      return null;
    }
  }

  public function getUserPassword($email) {
    try {
      $sql = $this->conn->prepare("Select password from user {$this->table} where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    }
    catch (Exception) {
      return null;
    }
  }

  public function updateUserData($email, $fname, $lname) {
    try {
      $sql = $this->conn->prepare("update {$this->table} set fname = ?, lname = ? where email = ?");
      $sql->execute([$fname, $lname, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception){
      return FALSE;
    }
  }

  public function updateUserPassword($email, $new_password) {
    try {
      $sql = $this->conn->prepare("update {$this->table} set password = ? where email = ?");
      $sql->execute([$new_password, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      return FALSE;
    }
  }
}
