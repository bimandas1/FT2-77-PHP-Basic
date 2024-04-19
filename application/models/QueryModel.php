<?php

require_once __DIR__ . '/Database.php';

/**
 * Perform queries on post table.
 */
class QueryModel extends Database {
  /**
   * Constructor function to use the connection with database.
   */
  function __construct() {
    parent::__construct();
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
  public function isExistingUser(string $email): bool
  {
    try {
      $sql = $this->conn->prepare("select email from user where email = ?");
      $sql->execute([$email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    } catch (Exception) {
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
  public function changePassword(string $email, string $password): bool
  {
    try {
      $sql = $this->conn->prepare("update user set password = ? where email = ?");
      $sql->execute([$password, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    } catch (Exception) {
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
  public function isValidUser(string $email, string $password): bool
  {
    $ret = ['res' => null, 'err' => null];
    try {
      $sql = $this->conn->prepare("select password from user where email = ? AND password = ?");
      $sql->execute([$email, $password]);

      return $sql->rowCount() > 0;
    } catch (Exception $err) {
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
  public function addUser(string $email, string $password, string $fname, string $lname): bool
  {
    try {
      $sql = $this->conn->prepare("insert into user values (?, ?, ?, ?)");
      $sql->execute([$email, $password, $fname, $lname]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      echo 'Error in database.';
      return FALSE;
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
  public function getUserData(string $email): array
  {
    try {
      $sql = $this->conn->prepare("Select fname, lname from user user where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    } catch (Exception) {
      return null;
    }
  }

  /**
   * Get user's password.
   *
   * @param string $email.
   *   User's email.
   *
   * @return string.
   *   User's password.
   */
  public function getUserPassword(string $email): string
  {
    try {
      $sql = $this->conn->prepare("Select password from user user where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    } catch (Exception) {
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
  public function updateUserData(string $email, string $fname, string $lname): bool
  {
    try {
      $sql = $this->conn->prepare("update user set fname = ?, lname = ? where email = ?");
      $sql->execute([$fname, $lname, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    } catch (Exception) {
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
  public function updateUserPassword(string $email, string $new_password): bool
  {
    try {
      $sql = $this->conn->prepare("update user set password = ? where email = ?");
      $sql->execute([$new_password, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    } catch (Exception) {
      return FALSE;
    }
  }

  /**
   * Fetch posts in a selected range.
   *
   * @param int $lastId.
   *  Id of the last post taht were fetched previously.
   * @param int $count.
   *  No. of posts to be fetched.
   *
   * @return mixed.
   *   Returns posts array or null in case no post available.
   */
  public function fetchPostsByLimit(int $lastId, int $count) : mixed {
    $sql = $this->conn->prepare("select * from post where id < $lastId order by id desc limit $count");
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  /**
   * Fetch posts by search keywords.
   *
   * @param string $searchKeys.
   *  Search keyword.
   *
   * @return mixed.
   *   Returns posts array or null in case no post match with search keyword.
   */
  public function fetchPostsBySearchKeys(string $searchKeys) : mixed {
    $sql = $this->conn->prepare("select * from post where text like '%$searchKeys%' order by id desc");
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  /**
   * Add new post.
   *
   * @param string $text.
   *   Caption of post.
   * @param string $mediaContent.
   *   Media content of post.
   * @param string $email.
   *   Email of the user.
   *
   * @return bool
   *   True if post is added, else false.
   */
  public function insert($text, $mediaContent, $email) : bool {
    $sql= $this->conn->prepare("insert into post (time, text, media, email) values (FROM_UNIXTIME(?), ?, ?, ?)");
    date_default_timezone_set('Asia/Kolkata');
    $curr_time = time();
    $sql->execute([$curr_time, $text, $mediaContent, $email]);

    if($sql->rowCount() > 0)  {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Get all posts uploaded by the user.
   *
   * @param string $email.
   *   User's email.
   *
   * @return mixed.
   *   Returns posts array or null in case no post is uploaded by the user.
   */
  public function getUserPosts($email) : mixed {
    $sql = $this->conn->prepare("select * from post where email = ?");
    $sql->execute([$email]);
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }
}
