<?php

/**
 * Validate user's inputs.
 */
class Validator {
  /**
   * Validate user's name.
   *
   * @param string $name
   *   User's name.
   *
   * @return bool
   *   TRUE if name is valid, else FALSE.
   */
  public function nameValidate(string $name): bool {
    return preg_match("/\b([A-Z][a-z. ]+[ ]*)+/", $name);
  }

  /**
   * Validate user's email.
   *
   * @param string $email
   *   User's email.
   *
   * @return bool
   *   TRUE if email is valid, else FALSE.
   */
  public function emailValidate(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  /**
   * Validate user's password.
   *
   * @param string $password
   *   User's password.
   *
   * @return bool
   *   TRUE if password is valid, else FALSE.
   */
  public function passwordValidate(string $password): bool {
    return preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $password);
  }
}
