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
    // Content type of API response.
    $contentType = $response->getHeaderLine('Content-Type');
    if(strpos($contentType, 'application/vnd.api+json') !== FALSE) {
      // Convert JSON to PHP Associative array and return.
      return json_decode($response->getBody(), TRUE);
    }
    else {
      throw new Exception('API response not in JSON format.');
    }
  }
  catch (Exception $err) {
    die('Error message : ' . $err->getMessage());
  }
}
