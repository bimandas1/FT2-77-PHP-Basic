<?php

require __DIR__ . '/creds.php';
require __DIR__ . '/SqlConnect.php';

// Object of SqlConnect class to make connection with MySQL
// and perform SQL queries.
$db = new SqlConnect($localhost, $username, $password, $database);
