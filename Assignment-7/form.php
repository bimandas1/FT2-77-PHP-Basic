<?php

session_start();

if (isset($_POST['submit'])) {
  $_SESSION['id'] = $_POST['id'];
  $_SESSION['password'] = $_POST['password'];
}

require './login.php';

parse_str($_SERVER['QUERY_STRING'], $parameter);

// If any parameter present in url.
if (isset($parameter['q'])) {
  if ($parameter['q'] > 0 && $parameter['q'] <= 7) {
    if (PHP_SESSION_ACTIVE) {
      include "{$parameter['q']}.html";
    }
    else {
      echo '<h1> You are logged out. </h1>';
    }
  }
  else {
    echo '<h1> Invalid Request </h1>';
  }
}
