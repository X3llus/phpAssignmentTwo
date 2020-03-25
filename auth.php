<?php
  session_start();
  if (empty($_SESSION["userId"])) {
    header("location: reviews.php");
    exit();
  }
?>
