<?php

require __DIR__ . '/creds.php';

if(isset($_POST)) {
  require __DIR__ . '/SqlConnect.php';

  $obj = new SqlConnect($servername, $username, $password, $database);
  $obj->insertData();
}
