<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * API call response.
 *
 * @param string $url
 *   URL of API call.
 *
 * @return mixed
 *   Returns API response in PHP associative array form.
 *   NULL in case of any exception.
 */
function request(string $url) : mixed {
  try {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $url);
    // Convert JSON to PHP Associative array and return.
    return json_decode($response->getBody(), TRUE);
  }
  catch (Exception) {
    return NULL;
  }
}
