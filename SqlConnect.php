<?php

/**
 * Class to to make connection with MySQL and perform SQL queries.
 */
class SqlConnect {
  private $conn;

  /**
   * Constructor function.
   *
   * @param string $servername
   *   Name of the server.
   *
   * @param string $username
   *   Name of the user on the server.
   *
   * @param string $password
   *   Name of the password.
   *
   * @param string $database
   *   Name of the database to be used.
   */
  function __construct($servername, $username, $password, $database) {
    // Make connection with MySQL database.
    $this->conn = new mysqli($servername, $username, $password, $database);

    // If database not connected.
    if(!$this->conn) {
      echo 'Database not connected. ' . $this->conn->connect_error . '<br';
    }
  }

  /**
   * Function to check an user id exists in database or not.
   *
   * @param string $id
   *   User id.
   *
   * @return bool
   *   TRUE if user id exists in database.
   */
  public function isExistingUser($id): bool {
    // Find data that matches with the id.
    $query = "select * from data where id = '$id'";
    $result = $this->conn->query($query);
    $no_of_rows = mysqli_num_rows($result);

    if ($no_of_rows == 0) {
      // No data found, means user id doesn't exist.
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Function to check an user id exists in database or not.
   *
   * @param string $id
   *   User id.
   *
   * @param string $password
   *   User's password.
   *
   * @return bool
   *   TRUE if id and password matches in database.
   */
  public function isValidUser($id, $password) : bool {
    // Find data that matches with the id.
    $query = "select password from data where id = '$id'";
    $result = mysqli_fetch_array($this->conn->query($query));

    // Matches the given password and the password of the id saved in database.
    return password_verify($password, $result['password']);
  }

  /**
   *  Function to add a new user.
   *
   * @param string $id
   *   User id.
   *
   * @param string $password
   *   User's password.
   */
  public function addNewUser($id, $password) {
    // Hashing the password.
    $password_hash_value = password_hash($password, PASSWORD_DEFAULT);

    // Save the id and the hash value of the password.
    $query = "insert into data values ('$id', '$password_hash_value')";
    $this->conn->query($query);
  }

  /**
   *  Function to change password.
   *
   * @param string $id
   *   User id.
   *
   * @param string $password
   *   User's password.
   */
  public function changePassword($id, $password) {
    // Hashing given password.
    $password_hash_value = password_hash($password, PASSWORD_DEFAULT);

    // Update the password in database.
    $query = "update data set password = '$password_hash_value' where id = '$id'";
    $this->conn->query($query);
  }
}
