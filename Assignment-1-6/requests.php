<?php

/**
 * API request for user email's data.
 *
 * @param string $url
 *   API url that contains user's email as a parameter.
 *
 * @return string
 *   Returns data about the user's email.
 */
function request(string $url): string {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
