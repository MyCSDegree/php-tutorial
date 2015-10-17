<?php
  session_start();
  if (isset($_SESSION['user_data'])) {
    unset($_SESSION['user_data']);
    echo "user logged out!";
  } else {
    echo "you must login to logout!";
  }
?>
<a href="/">go home </a>
