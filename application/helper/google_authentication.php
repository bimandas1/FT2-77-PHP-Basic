<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../core/Dotenv.php';

// Creating object of Dotenv class.
$env = new Dotenv();
// Init configuration.
$clientID = $_ENV['clientID']; // Your client id.
$clientSecret = $_ENV['clientSecret']; // Your client secret.
$redirectUri = $_ENV['redirectUri'];

// Create Client Request to access Google API.
$client = new Google\Client;
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Authenticate code from Google OAuth Flow

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  // Get profile info
  $google_oauth = new Google\Service\Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  session_start();
  $_SESSION['email'] = $email;
  header('location: /Feeds');
}
