<?php

/**
 * Class to validate Email and Password.
 */
class Validator {
  /**
   * Function to validate email.
   *
   * @param string $email
   *   User's email.
   *
   * @return bool
   *  True if email is valid.
   */
  public function emailValidation(string $email): bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  /**
   * Function to validate password.
   *
   * @param string $password
   *   User entered password.
   *
   * @return bool
   *   True if password is valid.
   */
  public function passwordValidation(string $password): bool {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (preg_match($pattern, $password)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}
