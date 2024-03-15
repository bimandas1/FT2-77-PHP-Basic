<?php

/**
 * Function to end session.
 */
function end_session() {
  session_start();
  session_unset();
  session_destroy();
}
