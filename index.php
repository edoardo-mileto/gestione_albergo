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
?>
<!DOCTYPE html>
<html>
<head>
  <title>home</title>
</head>
<body>
ciao <?php 
  echo "" . $_SESSION["usr_name"] . " " . $_SESSION["usr_surname"] . ""; 
  ?>
  <br>
  sei un utente di tipo: <?php echo $_SESSION["usr_role"]; ?>
</body>
</html>