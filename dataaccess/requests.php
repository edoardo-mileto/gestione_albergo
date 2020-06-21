<?php
require_once "dbconnect.php";

class Request
{
    var $idRichiesta;
    var $utente;
    var $stato;
    var $stanza;
    var $dataCreazione;
    var $dataPresaInCarico;
    var $dataTermine;
    var $servizio;
    var $piatto;

    var $numPiatto;


    public function acceptRequest(){
      $conn = connect();

      $query = "UPDATE richieste SET utente = " . $this->utente . ", stato = \"in lavorazione\", dataPresaInCarico = current_timestamp() WHERE `richieste`.`idRichiesta` =" . $this->idRichiesta . "";

      $result = $conn->query($query);

      $conn->close();
    }

    public function completeRequest(){
      $conn = connect();

      $query = "";

      $result = $conn->query($query);

      $conn->close();
    }

    public function rejectRequest(){
      $conn = connect();

      $query = "UPDATE richieste SET utente = " . $this->utente . ", stato = \"rifiutata\" WHERE `richieste`.`idRichiesta` =" . $this->idRichiesta . "";

      $result = $conn->query($query);

      $conn->close();
    }

    public static function loadAcceptedRequests($user_id){
        $res = array();

        $conn = connect();

        $query = "SELECT * FROM richieste r INNER JOIN tipiservizi ts ON r.tipoServizio = ts.idTipoServizio WHERE r.utente = ". $user_id ." AND r.stato = \"in lavorazione\"";

        $result = $conn->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $r = new Request();
                $r->idRichiesta = $row["idRichiesta"];
                $r->stanza = $row["stanza"];
                $r->dataCreazione = $row["dataCreazione"];
                $r->servizio = $row["nomeServizio"];
                $res[] = $r;
            }
        }

        $conn->close();

        return $res;
    }

    public static function loadWaitingRequests(){
        $res = array();

        $conn = connect();

        $query = "SELECT * FROM richieste r INNER JOIN tipiservizi ts ON r.tipoServizio = ts.idTipoServizio WHERE r.utente IS NULL";

        $result = $conn->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $r = new Request();
                $r->idRichiesta = $row["idRichiesta"];
                $r->stanza = $row["stanza"];
                $r->dataCreazione = $row["dataCreazione"];
                $r->servizio = $row["nomeServizio"];
                $res[] = $r;
            }
        }

        $conn->close();

        return $res;
    }

    public static function loadOrdersByPlate(){
    	$res = array();

      $conn = connect();

      $query = "SELECT nomePiatto, COUNT(idPiatto) FROM richieste r INNER JOIN piatto p ON r.piatto = p.idPiatto GROUP BY r.piatto";

      $result = $conn->query($query);

      if ($result->num_rows) {
          while ($row = $result->fetch_assoc()) {
              $r = new Request();
              $r->piatto = $row["nomePiatto"];
              $r->numPiatto = $row["COUNT(idPiatto)"];
              $res[] = $r;
          }
      }

      $conn->close();

      return $res;
    }

    public static function loadOrdersByRoom(){
        $res = array();

        $conn = connect();

        $query = "SELECT stanza, GROUP_CONCAT(p.nomePiatto SEPARATOR ', ') FROM richieste r INNER JOIN piatto p ON r.piatto = p.idPiatto GROUP BY stanza";

        $result = $conn->query($query);

        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $r = new Request();
                $r->stanza = $row["stanza"];
                $r->piattiOrd = $row["GROUP_CONCAT(p.nomePiatto SEPARATOR ', ')"];
                $res[] = $r;
            }
        }

        $conn->close();

        return $res;
    }
}
?>
