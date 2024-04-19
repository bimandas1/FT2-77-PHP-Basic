<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Dotenv.php';

/**
 * Authenticate and verify using Google OAuth.
 */
class GoogleAuthentication {
  private $googleClient;

  /**
   * Initialize google client and
   * set scopes that are to be accessed.
   */
  public function initializeGoogleClient() {
    // Creating object of Dotenv class.
    $env = new Dotenv();
    // Init configuration.
    $clientID = $_ENV['CLIENT_ID'];
    $clientSecret = $_ENV['CLIENT_SECRET'];
    $redirectUri = $_ENV['REDIRECT_URI'];

    // Create Client Request to access Google API.
    $this->googleClient = new Google\Client;
    $this->googleClient->setClientId($clientID);
    $this->googleClient->setClientSecret($clientSecret);
    $this->googleClient->setRedirectUri($redirectUri);
    $this->googleClient->addScope("email");
    $this->googleClient->addScope("profile");
  }

  /**
   * Provides authentication url.
   *
   * @return string
   *   Authentication url.
   */
  public function getAuthUrl(): string {
    // Initialize Google client.
    $this->initializeGoogleClient();
    return $this->googleClient->createAuthUrl();
  }

  /**
   * Authenticate by google OAuth.
   */
  public function authenticate() {
    if (isset($_GET['code'])) {
      // Initialize Google client.
      $this->initializeGoogleClient();

      $token = $this->googleClient->fetchAccessTokenWithAuthCode($_GET['code']);
      $this->googleClient->setAccessToken($token['access_token']);
      // Get profile info.
      $google_oauth = new Google\Service\Oauth2($this->googleClient);
      $google_account_info = $google_oauth->userinfo->get();
      $email =  $google_account_info->email;
      $name =  $google_account_info->name;
      // Redirect to required page.
      $this->redirect($email, $name);
    }
  }

  /**
   * Redirects and set session variables.
   *
   * @param string $email
   *   User's email.
   * @param string $name
   *   User's name.
   */
  public function redirect(string $email, string $name) {
    session_start();
    $_SESSION['email'] = $email;
    header('location: /Feeds');
    exit;
  }
}
