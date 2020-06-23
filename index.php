<?php
  session_start();

  if (!array_key_exists("user_id", $_SESSION))
  {
    if (!array_key_exists("username", $_POST) ||
      !array_key_exists("password", $_POST))
    {
      header("Location: ./login.php");
      exit;
    }

    require_once('./dataaccess/users.php');

    // Cerco l'utente
    $users = User::loadUsers();

    $check = false;
    foreach($users as $u)
    {
      if ($u->username == $_POST['username'])
      {
        if ($u->password == $_POST['password'])
        {
          $check = true;
          $_SESSION['user_id'] = $u->user_id;
          $_SESSION['username'] = $u->username;
          $_SESSION['usr_role'] = $u->role;
          $_SESSION['usr_name'] = $u->nome;
          $_SESSION['usr_surname'] = $u->cognome;
          if($u->role == "cucina"){
            header("Location: ./ordini_cucine.php");
            exit;
          }elseif ($u->role == "admin") {
            header("Location: ./admin.php");
            exit;
          }
        }
      }
    }

    if (!$check) // Se l'utente non c'è
    {
      header("Location: ./login.php?err=1");
      exit;
    }
  }
  if($_SESSION['usr_role'] == "cucina"){
    header("Location: ./ordini_cucine.php");
    exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>home</title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/grid.css" />
</head>
<body>
  <div style="width: 100%;
              background: #239177;
              position: fixed;
              top: 0px;
              left: 0px;
              z-index: 999;">
    <div style="padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
                max-width: 1200px;">
      <div style="margin: 0px -15px;">
        <div style="width: 100%;">
          <div style="line-height: 48px;
                      font-weight: 500;
                      font-size: 2.5rem;
                      color: white;">
            <h1>Gestione Albergo</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
  <div style="max-width: 100%;">
    <ul style="list-style: none; margin-top: 7px; float: right;">
      <li style="display: inline-block;">
        <a href="./logout.php"><button type="button" class="btn btn-secondary">Logout</button></a>
      </li>
    </ul>
    User: <?php
        echo "" . $_SESSION["usr_name"] . " " . $_SESSION["usr_surname"] . "";
      ?>
    <br>
    Utenza ristretta: <?php echo $_SESSION["usr_role"]; ?>
    <br>
  </div>
</div>
<br>
  <div class="container">
    <h4> Le tue richieste prese in carico:</h4>
    <?php
      require_once("./dataaccess/requests.php");
      $acceptedRequests = Request::loadAcceptedRequests($_SESSION['user_id']);

      if(empty($acceptedRequests)){
        echo "Nessuna richiesta attualmente presa in carico <br><br>";
      }else{
      foreach ($acceptedRequests as $a) {
        echo '<div class="row" style="text-align: center;">';
        echo '<div class="col-sm-2">Richiesta ' . $a->idRichiesta . '</div>';
        echo '<div class="col-6 col-md-2">Stanza ' . $a->stanza . '</div>';
        echo '<div class="col-6 col-md-2">Data Creazione:<br>' . $a->dataCreazione . '</div>';
        echo '<div class="col-sm-2">Descrizione:<br>' . $a->servizio . '</div>';
        echo '<div class="col-6 col-md-2">';
        echo "<form action=\"rejectReq.php\" method=\"POST\">";
        echo "<input type='hidden' name='request_reject' value='". $a->idRichiesta ."'>";
        echo '<input type="submit" class="btn btn-danger btn-block" value="Rifiuta"></form></div>';
        echo '<div class="col-6 col-md-2">';
        echo "<form action=\"completeReq.php\" method=\"POST\">";
        echo "<input type='hidden' name='request_complete' value='". $a->idRichiesta ."'>";
        echo '<input type="submit" class="btn btn-success btn-block" value="Completa"></form></div></div>';
      }
    }
    ?>
  </div>
  <div class="container">
    <h4> Richieste in attesa: </h4>
    <?php
      require_once("./dataaccess/requests.php");
      $waitingRequests = Request::loadWaitingRequests();

      foreach ($waitingRequests as $w) {
        echo '<div class="row" style="text-align: center;">';
        echo '<div class="col-sm-2">Richiesta ' . $w->idRichiesta . '</div>';
        echo '<div class="col-6 col-md-2">Stanza ' . $w->stanza . '</div>';
        echo '<div class="col-6 col-md-2">Data Creazione:<br>' . $w->dataCreazione . '</div>';
        echo '<div class="col-sm-2">Descrizione:<br>' . $w->servizio . '</div>';
        echo '<div class="col-6 col-md-2">';
        echo "<form action=\"rejectReq.php\" method=\"POST\">";
        echo "<input type='hidden' name='request_reject' value='". $w->idRichiesta ."'>";
        echo '<input type="submit" class="btn btn-danger btn-block" value="Rifiuta"></form></div>';
        echo '<div class="col-6 col-md-2">';
        echo "<form action=\"acceptReq.php\" method=\"POST\">";
        echo "<input type='hidden' name='request_accept' value='". $w->idRichiesta ."'>";
        echo '<input type="submit" class="btn btn-primary btn-block" value="Accetta"></form></div></div>';
      }
    ?>
  </div>
</body>
</html>
