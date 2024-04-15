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
  function __construct (string $tableName) {
    parent::__construct();
    $this->table = $tableName;
  }

  /**
   * Check user exist or not.
   *
   * @param string $email.
   *   User's email.
   *
   * @return boolean
   *   True if user exists.
   */
  public function isExistingUser (string $email) : bool {
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

  /**
   * Undocumented function
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   *
   * @return bool.
   *   True if changing is successfull.
   */
  public function changePassword (string $email, string $password) : bool {
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

  /**
   * Check user is valid or not.
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   *
   * @return boolean.
   *   True if user email and password match.
   */
  public function isValidUser (string $email, string $password) : bool {
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

  /**
   * Add new user's data.
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   * @param string $fname.
   *   User's First name.
   * @param string $lname.
   *   User's Last name.
   *
   * @return bool.
   *   True if addition is successfull.
   */
  public function addUser (string $email, string $password, string $fname, string $lname) : bool {
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

  /**
   * Get user's data.
   *
   * @param string $email.
   *   User's email.
   *
   * @return array.
   *   User's data.
   */
  public function getUserData(string $email) : array {
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

  /**
   * Get user's password.
   *
   * @param string $email.
   *   User's email.
   *
   * @return array.
   *   User's data (password column only).
   */
  public function getUserPassword(string $email) : array {
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

  /**
   * Update user's data.
   *
   * @param string $email.
   *   User' email.
   * @param string $fname.
   *   User's first name.
   * @param string $lname.
   *   User's last name.
   *
   * @return bool.
   *   True if updation is successfull.
   */
  public function updateUserData(string $email, string $fname, string $lname) : bool {
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

  /**
   * Update user's password.
   *
   * @param string $email.
   *   User' email.
   * @param string $password.
   *   User's password.
   *
   * @return bool.
   *   True if updation is successfull.
   */
  public function updateUserPassword(string $email, string $new_password) : bool {
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
