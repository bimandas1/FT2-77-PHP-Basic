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
  public function isExistingUser(string $email): bool {
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
   * Change password.
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   *
   * @return bool.
   *   True if changing is successfull.
   */
  public function changePassword(string $email, string $new_password): bool
  {
    try {
      $sql = $this->conn->prepare("update user set password = ? where email = ?");
      // Generate hash value of the new password.
      $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
      $sql->execute([$new_password_hash, $email]);
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
    try {
      $sql = $this->conn->prepare("select password from user where email = ?");
      $sql->execute([$email]);

      if($sql->rowCount() == 0) {
        return FALSE;
      }
      else {
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $res['password'])) {
          return TRUE;
        }
        else {
          return FALSE;
        }
      }
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
  public function addUser(string $email, string $password, string $fname, string $lname): bool
  {
    try {
      $sql = $this->conn->prepare("insert into user (email, password, fname, lname) values (?, ?, ?, ?)");
      // Generate hash value of the password.
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      echo $password;
      $sql->execute([$email, $password_hash, $fname, $lname]);
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
      $sql = $this->conn->prepare("Select fname, lname, is_admin from user user where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetch(PDO::FETCH_ASSOC);
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
  public function updateUserData(string $email, string $fname, string $lname): bool
  {
    try {
      $sql = $this->conn->prepare("update user set fname = ?, lname = ? where email = ?");
      $sql->execute([$fname, $lname, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
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
    }
    catch (Exception) {
      return FALSE;
    }
  }

  /**
   * Fetch posts in a selected range.
   *
   * @param int $lastId.
   *  Id of the last post that were fetched previously.
   * @param int $count.
   *  No. of posts to be fetched.
   *
   * @return mixed.
   *   Returns posts array or null in case no post available.
   */
  public function fetchPoroductsByLimit(int $lastId, int $count) : mixed {
    try {
      $sql = $this->conn->prepare("select * from product where id > $lastId order by id asc limit $count");
      $sql->execute();
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    }
    catch(Exception) {
      return null;
    }
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
  public function fetchProductsBySearchKeys(string $searchKeys) : mixed {
    $sql = $this->conn->prepare("select * from product where name like '%$searchKeys%' OR description like '%$searchKeys%' order by id asc");
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

  // Query on Cart table.

  /**
   * Check user - product row exist or not.
   *
   * @param string $user_id
   *   User's id.
   * @param string $product_id
   *   Product's id.
   *
   * @return boolean
   *   Return TRUE if row exists, else FALSE.
   */
  public function isUserProductRowExist(string $user_id, int $product_id) : bool {
    $sql = $this->conn->prepare("select count(?) from cart where user_id = ? and product_id = ?");
    $sql->execute([$user_id, $user_id, $product_id]);
    $res = $sql->fetch(PDO::FETCH_ASSOC);
    $key = "count('" . $user_id . "')";
    if($res[$key] > 0) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Insert new user - product row.
   *
   * @param string $user_id
   *   User's id.
   * @param string $product_id
   *   Product's id.
   *
   * @return boolean
   *   Return TRUE if insertion is successfull, else FALSE.
   */
  public function insertUserProductRow(string $user_id, string $product_id) : bool {
    $sql = $this->conn->prepare("insert into cart (user_id, product_id, quantity) values (?, ?, ?)");
    $sql->execute([$user_id, $product_id, 0]);
    if($sql->rowCount() > 0) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Get Product quantity in cart of an user.
   *
   * @param string $user_id
   *   User's id.
   * @param string $product_id
   *   Product's id.
   *
   * @return integer
   *   Quantity of the product.
   */
  public function getProductQuantity(string $user_id, string $product_id) : int {
    $sql = $this->conn->prepare("select quantity from cart where user_id = ? and product_id = ?");
    $sql->execute([$user_id, $product_id]);
    $res = $sql->fetch(PDO::FETCH_ASSOC);
    return $res['quantity'];
  }

  /**
   * Update cart.
   *
   * @param string $user_id
   *   User's id.
   * @param integer $product_id
   *   Product's id.
   * @param integer $change
   *   Value to be changed (+1/-1).
   *
   * @return bool
   *   Return TRUE if update is done, else FALSE.
   */
  public function updateCart(string $user_id, int $product_id, int $change) : bool {
    try {
      $sql = $this->conn->prepare("update cart set quantity = greatest(0, quantity + ?) where user_id = ? and product_id = ?");
      $sql->execute([$change, $user_id, $product_id]);
      if($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch(Exception $err) {
      return FALSE;
    }
  }

  // Query from multiple tables (by joining).

  /**
   * Get cart details of the user.
   *
   * @param string $user_id
   *   User's id.
   *
   * @return array
   *   User's cart details.
   */
  public function getCartDetails(string $user_id) : array {
    $sql = $this->conn->prepare("SELECT product.*, cart.quantity from cart join product on cart.product_id = product.id where user_id = ?");
    $sql->execute([$user_id]);
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }
}
