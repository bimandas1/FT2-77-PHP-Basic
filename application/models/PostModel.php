<?php

// require_once './application/models/Database.php';
require_once __DIR__ . '/Database.php';

class PostModel extends Database {
  public $table;

  function __construct($tableName) {
    parent::__construct();
    $this->table = $tableName;
  }

  public function fetchPosts() {
    $sql = $this->conn->prepare("select * from {$this->table}");
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function fetchPostsByLimit($lastId, $count) {
    $sql = $this->conn->prepare("select * from {$this->table} where id < $lastId order by id desc limit $count");
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function fetchPostsBySearchKeys($searchKeys){
    $sql = $this->conn->prepare("select * from {$this->table} where text like '%$searchKeys%' order by id desc");
    $sql->execute();
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function insert($text, $mediaContent, $email) {
    $sql= $this->conn->prepare("insert into {$this->table} (time, text, media, email) values (FROM_UNIXTIME(?), ?, ?, ?)");
    date_default_timezone_set('Asia/Kolkata');
    $curr_time = time();
    $sql->execute([$curr_time, $text, $mediaContent, $email]);

    if($sql->rowCount() > 0)  {
      return TRUE;
    }
    return FALSE;
  }

  public function getUserPosts($email){
    $sql = $this->conn->prepare("select * from {$this->table} where email = ?");
    $sql->execute([$email]);
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }
}
