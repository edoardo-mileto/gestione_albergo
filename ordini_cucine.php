<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>ordini cucine</title>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
    id="bootstrap-css">
   <link rel="stylesheet" href="assets/css/style.css"/>
   <link rel="stylesheet" href="assets/css/admin.css"/>
  <style type="text/css">
    .content_box {
      float: left;
      width: 100%;
    }

    .left_bar {
      float: left;
      width: 15%;
      background: white;
      height: 100vh;
    }

    .right_bar {
      float: left;
      width: 85%;
      padding: 15px;
      /*border-left:1px solid #ccc;*/
      height: 100%;
    }

    .nav-tabs--vertical li {
      float: left;
      width: 100%;
      padding: 0;
      position: relative;
    }

    .nav-tabs--vertical li a {
      float: left;
      width: 100%;
      padding: 15px;
      border-bottom: 1px solid #adcff7;
      border-top: 1px solid #adcff7;
      color: black;
      font-weight: 550;
    }

    .nav-tabs--vertical li a.active::after {
      content: "";
      border-color: #1276F0;
      border-style: solid;
      position: absolute;
      right: -8px;
      /* border-top: transparent; */
      border-right: transparent;
      border-left: 15px solid transparent;
      border-right: 15px solid transparent;
      /*border-bottom: 16px solid #1276F0;*/
      border-bottom: 16px solid #fff;
      border-top: 0;
      transform: rotate(270deg);
      z-index: 999;
    }
    li a{
      background: #C8E3DD;
    }
    a.active{
      background: #77BBAB;
      }
    a:hover{
      background: #84C1B3;
      }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    window.alert = function () { };
    var defaultCSS = document.getElementById('bootstrap-css');
    function changeCSS(css) {
      if (css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="' + css + '" type="text/css" />');
      else $('head > link').filter(':first').replaceWith(defaultCSS);
    }
    $(document).ready(function () {
      var iframe_height = parseInt($('html').height());
      window.parent.postMessage(iframe_height, 'https://bootsnipp.com');
    });
  </script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
    id="bootstrap-css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	  <div class="header no-shadow">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo">
                            <h1>Gestione Albergo</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

                    <div class="col-sm-8" style="max-width: 100%;">
                        <ul class="header-menu pull-right">
                            <li><a href="./logout.php">Logout</a></li>
                        </ul>
User: <?php 
  echo "" . $_SESSION["usr_name"] . " " . $_SESSION["usr_surname"] . ""; 
  ?>
  <br>
  Utenza ristretta: <?php echo $_SESSION["usr_role"]; ?>
  <br>
</div>

  <div class="content_box">
    <div class="left_bar">
      <ul class=" nav-tabs--vertical nav" role="navigation">
        <li class="nav-item">
          <div class="nav-link" role="tab"aria-controls="piatto" style="font-weight: 600">Filtra per:</div>
        </li>
        <li class="nav-item">
          <a href="#lorem" class="nav-link" data-toggle="tab" role="tab" aria-controls="lorem">Piatto</a>
        </li>
        <li class="nav-item">
          <a href="#stanza" class="nav-link " data-toggle="tab" role="tab" aria-controls="stanza">Stanza</a>
        </li>
      </ul>
    </div>
    <div class="right_bar ">
      <div class="tab-content ">
        <div class="tab-pane fade show active" id="lorem" role="tabpanel">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Piatto</th>
                <th>Quantità ordinata</th>
              </tr>
            </thead>
            <tbody>
  <?php 
  	require_once("./dataaccess/requests.php");
  	$ordersByPlate = Request::loadOrdersByPlate();

  	foreach ($ordersByPlate as $o) {
  		echo "<tr><td>" . $o->piatto . "</td><td>" . $o->numPiatto . "</td></tr>";
  	}
  ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane fade" id="stanza" role="tabpanel">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Stanza</th>
                <th>Piatti ordinati</th>
              </tr>
            </thead>
            <tbody>
    <?php 
	  	require_once("./dataaccess/requests.php");
	  	$ordersByPlate = Request::loadOrdersByRoom();

	  	foreach ($ordersByPlate as $o) {
	  		echo "<tr><td>" . $o->stanza . "</td><td>" . $o->piattiOrd . "</td></tr>";
	  	}
	  ?>
            </tbody>
          </table>
        </div>
</body>
</html>