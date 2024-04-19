<?php

class Validator {
  public function nameValidate(string $name) {
    return preg_match("/\b([A-Z][a-z. ]+[ ]*)+/", $name);
  }

  public function emailValidate(string $email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  public function passwordValidate(string $password) {
    return preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $password);
  }
}
