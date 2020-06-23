<?php
  session_start();

  if (array_key_exists("username", $_SESSION))
  {
    header("location: ./index.php");
  }
?>

<html>

<head>
  <title>Albergo - Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="icon" href="">
  <style>
    .login-form {
      background: rgba(255, 255, 255, 1);
      padding: 10% 20px;
      border-radius: 2px;
      box-shadow: 0px 0px 15px 5px rgba(0, 0, 0, 0.4);
    }

    .main {
      min-height: 100vh;
      padding: 10% 0px;
    }
  </style>
</head>

<body>
  <div class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9">
          <div class="logo">
            <h1>Gestione Albergo</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--<form action="./index.php" method="post">
        <p>
        <label>e-mail:</label>
        <input type="email" name="e-mail"/>
        </p><p>
        <label>password:</label>
        <input type="password" name="password" />
        </p>
        <p>
        <input type="submit" value="login" />
        </p>
    </form>-->
  <div class="main">
    <div class="container-fluid">
      <div class="row">
        <div class="pull-left text-center col-sm-3">
        </div>
        <div class="pull-right col-sm-6 text-center">
          <div class="login-form">
            <p class="h3">Effettua il Login</p>
            <form action="./index.php" method="post" style="max-width:400px;margin:0px auto;">
              <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="input-lg col-sm-12" />
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="input-lg col-sm-12" />
              </div>
              <div class="form-group">
                <input type="submit" value="Login" class="btn btn-success input-lg col-sm-12" id="loginBtn" />
                <br /><br /><br /><br />
              </div>
            </form>
            <?php
                                if (array_key_exists("err", $_GET))
                                {
                                  echo '<div id="Error"><p class="error">';
                                  echo "Username e/o password errati.";
                                  echo "</p></div>";
                                }
                              ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
