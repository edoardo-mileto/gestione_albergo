<?php
  session_start();
  if (!array_key_exists("user_id", $_SESSION))
  {
    header("location: login.php");
    exit;
  }

  if (!array_key_exists("request_accept", $_POST))
  {
      header("location: index.php");
      exit;
  }


  echo "<script type='text/javascript'>alert('ciao');</script>";
  require_once('dataaccess/requests.php');
  $r = new Request();
  $r->idRichiesta = $_POST['request_accept'];
  $r->utente = $_SESSION['user_id'];
  $r->completeRequest();

  header("location: index.php");
?>
