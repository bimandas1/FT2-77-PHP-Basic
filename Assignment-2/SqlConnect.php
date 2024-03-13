<?php

/**
 *  Class to establish connection with MySQL and perform insert operations to tables.
 */
class SqlConnect {
  private $conn;

  /**
   * Constructor function to establish connection with database in MySQL.
   *
   * @param string $servername
   *   Server name of MySQL.
   *
   * @param string $username
   *   USer name of MySQL server.
   *
   * @param string $password
   *   Password to authenticate the user.
   *
   * @param string $database
   *   Database name.
   */
  function __construct(string $servername, string $username, string $password, string $database) {
    // Create connection
    $this->conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($this->conn->connect_error) {
      die('Connection failed: ' . $this->conn->connect_error);
    }

    echo 'Connected successfully.<br>';
  }

  /**
   * Function to insert data to the tables in SQL database.
   */
  public function insertData() {
    try {
      // Fetch input data.
      $employee_code = $_POST['employee-code'];
      $employee_code_name = $_POST['employee-code-name'];
      $employee_domain = $_POST['employee-domain'];
      $employee_id = $_POST['employee-id'];
      $employee_salary = $_POST['employee-salary'];
      $employee_first_name = $_POST['employee-first-name'];
      $employee_last_name = $_POST['employee-last-name'];
      $graduation_percentile = $_POST['graduation-percentile'];

      // Insert data to employee_code_table.
      $sql_insert_to_employee_code_table = "insert into employee_code_table values ('$employee_code', '$employee_code_name', '$employee_domain')";
      $this->conn->query($sql_insert_to_employee_code_table);

      // Insert data to mployee_salary_table.
      $sql_insert_to_employee_salary_table = "insert into employee_salary_table values ('$employee_id', '$employee_salary', '$employee_code')";
      $this->conn->query($sql_insert_to_employee_salary_table);

      // Insert data to employee_details_table.
      $sql_insert_to_employee_details_table = "insert into employee_details_table values ('$employee_id', '$employee_first_name', '$employee_last_name', '$graduation_percentile')";
      $this->conn->query($sql_insert_to_employee_details_table);

      echo "Data inserted.<br>";
      // Close SQL connection.
      $this->conn->close();
    }
    catch (exception $err) {
      echo 'Error : ' . $err;
    }
  }
}
