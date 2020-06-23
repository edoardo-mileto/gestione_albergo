<?php
  session_start();
  if($_SESSION['usr_role'] != "admin"){
    header("Location: ./index.php");
    exit;
  }
?>
