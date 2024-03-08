<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * API call response.
 * @param string $url
 *   URL of API call.
 * @return array
 *   Returns API response in PHP associative array form.
 */
function request(string $url): array {
  $client = new \GuzzleHttp\Client();
  $response = $client->request('GET', $url);
  // Convert JSON to PHP Associative array and return.
  return json_decode($response->getBody(), TRUE);
}
