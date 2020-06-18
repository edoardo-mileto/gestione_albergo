<?php
  require_once("dbconnect.php");

  class User
  {
  var $user_id;
  var $username;
	var $password;
  var $role;
  var $nome;
  var $cognome;

    /**
     * Carica l'elenco di tutti gli utenti
     */
	  public static function loadUsers()
	  {
        $res = array();
        $conn = connect();
        $query = "SELECT * FROM utenti u INNER JOIN tipoutente t ON u.tipoUtenza = t.idTipoUtente";
        $result = $conn->query($query);
        $u = null;
        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
               $u = new User();
               $u->user_id = $row["idUtente"];
               $u->username = $row['username'];
               $u->password = $row['password'];
               $u->role = $row['nomeUtenza'];
               $u->nome = $row['nomeU'];
               $u->cognome = $row['cognomeU'];
               $res[] = $u;
           }
        }
        return $res;
      }
  }
?>