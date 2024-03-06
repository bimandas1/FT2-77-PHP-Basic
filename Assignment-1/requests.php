<?php

/**
 * API call response.
 * @param string $url
 *   URL of API call.
 * @return array
 *   Returns API response in PHP associative array form.
 */
function request(string $url): array {
  $decoded = [];
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  if ($error = curl_error($ch)) {
    echo $error;
  }
  else {
    $decoded = json_decode($response, true);
  }

  curl_close($ch);
  return $decoded;
}
