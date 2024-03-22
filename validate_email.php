<?php

/**
 * Function to check email validation.
 *
 * @param string $email
 *   User's email.
 * 
 * @return bool
 *   True if email is valid.
 */
function is_valid_email (string $email) : bool {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}
