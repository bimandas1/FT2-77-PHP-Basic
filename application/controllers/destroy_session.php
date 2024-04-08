<?php

/**
 * Function to destryo session.
 */
function destroy_session () {
  session_start();
  session_unset();
  session_destroy();
}
