<?php

function destroy_session () {
  session_start();
  session_unset();
  session_destroy();
}
