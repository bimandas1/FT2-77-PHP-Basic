<?php

require_once __DIR__ . '/Database.php';

/**
 * Perform queries on post table.
 */
class PostModel extends Database {
  public $table;

  /**
   * Constructor function to use the connection with database.
   *
   * @param string $tableName
   *  Post table's name.
   */
  function __construct(string $tableName) {
    parent::__construct();
    $this->table = $tableName;
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
    $sql = $this->conn->prepare("select * from {$this->table} where id < $lastId order by id desc limit $count");
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
    $sql = $this->conn->prepare("select * from {$this->table} where text like '%$searchKeys%' order by id desc");
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
    $sql= $this->conn->prepare("insert into {$this->table} (time, text, media, email) values (FROM_UNIXTIME(?), ?, ?, ?)");
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
    $sql = $this->conn->prepare("select * from {$this->table} where email = ?");
    $sql->execute([$email]);
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }
}
