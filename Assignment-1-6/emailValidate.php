<?php

require __DIR__ . '/requests.php';

/**
 * Validate the Email.
 *
 * @param string $email
 *   User's email.
 *
 * @return bool
 *   True if email is a valid, else false.
 */
function isValidEmail(string $email): bool {
  // Get the API Key.
  require __DIR__ . '/creds.php';
  // API call url that contains api key and user's email as parameters.
  $url = "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email";

  $response = request($url);

  // JSON decoding.
  $data = json_decode($response, TRUE);

  // If email is valid, return true.
  if ($data['deliverability'] == 'DELIVERABLE') {
    return TRUE;
  }

  return FALSE;
}
