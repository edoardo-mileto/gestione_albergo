<?php
function connect()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "elaborato_albergo";
  // Viene stabilita la connessione al db mysql
  $conn = new mysqli($servername, $username, $password, $dbname);
  /* Viene controllato se si verifica un errore 
  nello stabilimento della connessione, ed in tal caso la connessione viene chiusa. 
  La funzione die() è equivalente alla funzione exit() */
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}
?>