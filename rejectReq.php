<?php
  session_start();
  if (!array_key_exists("user_id", $_SESSION))
  {
    header("location: login.php");
    exit;
  }

  if (!array_key_exists("request_reject", $_POST))
  {
      header("location: index.php");
      exit;
  }

  require_once('dataaccess/requests.php');
  $r = new Request();
  $r->idRichiesta = $_POST['request_reject'];
  $r->utente = $_SESSION['user_id'];
  $r->rejectRequest();

  header("location: index.php");
?>
