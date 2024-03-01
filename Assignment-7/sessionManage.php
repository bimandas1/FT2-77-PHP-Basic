<?php

/**
 * Function to destroy the session.
 */
function destroySession() {
  // Start session.
  session_start();
  // Unsest session variables.
  session_unset();
  // Destroy session.
  session_destroy();
}
