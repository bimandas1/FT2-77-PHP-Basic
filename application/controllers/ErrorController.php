<?php

/**
 * Controller to handle if requested path not exist.
 */
class ErrorController {
  public function invoke() {
    // Require view.
    require_once __DIR__ . '/../views/error_view.php';
  }
}
