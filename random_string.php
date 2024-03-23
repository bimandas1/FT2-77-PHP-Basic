<?php

/**
 * Function to generate random string.
 *
 * @param int $length
 *   Length of the generated random string.
 *   If length parameter is not passed then it takes default value 10.
 *
 * @return string
 *   Returns the generated random string.
 */
function generateRandomString(int $length = 10): string {
  // Characters to be used to generate the random string.
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[random_int(0, strlen($characters) - 1)];
  }

  return $randomString;
}
