<?php
  include_once("../util/utilities.php");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  session_start();
  if(isset($_SESSION["user"]))
  {
    if(isset($_SESSION["user"]["estatus_usuario"]))
    {
      if($_SESSION["user"]["estatus_usuario"] == 1)
      {
        /*Disabeling user payment*/
        //header("Location:".$url."payment");
        $payment = 2;
      }
      else if($_SESSION["user"]["estatus_usuario"] == 2){
        $payment = 2;
      }
      else {
        header("location:".$url."signin");
      }
    }
  }else {
    header("location:".$url."signin");
  }
 ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <!-- Standardised web app manifest -->
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=$url;?>css/bootstrap-4.3.1/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?=$url;?>css/cirkuits.css" />
    <link rel="stylesheet" href="<?=$url;?>css/master.css" />
    <link rel="stylesheet" href="<?=$url;?>css/jquery-ui.css" />
    <link rel="stylesheet" href="<?=$url;?>css/fontawesome-free-5.8.1-web/css/all.css">
    <link rel="stylesheet" href="<?=$url;?>css/validationEngine.jquery.css" />
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
    <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
    <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
    <script src="<?=$url;?>js/jquery-ui.js"></script>
    <script src="<?=$url;?>js/jquery.validationEngine-es.js"></script>
    <script src="<?=$url;?>js/jquery.validationEngine.js"></script>

  </head>
  <body class="payment-section-body">
    <div class="aside-menu">
      <div id="aside-logo-container">
        <img src="../img/bw_logo.png" alt="Cirkuits logo">
      </div>
      <div id="menu-container">
        <div id="user-avatar-container">
          <img id="avatar-usuario" src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="<?= $_SESSION["user"]["avatar_usuario"] ?>" />
          <p id="user-name"><strong><?= $_SESSION["user"]["nombre_usuario"] ?></strong>&nbsp;<strong><?= strlen($_SESSION["user"]["apellido_usuario"]) > 5 ? "" : $_SESSION["user"]["apellido_usuario"] ?></strong></p>
        </div>
        <div class="menu-item">
            <a href="<?=$url;?>profile" class="c-badge-primary margin-5">Setings</a>
            <a href="<?=$url;?>profile" class="c-badge-primary margin-5">Help</a>
            <a href="<?=$url;?>exit.php" class="c-badge-red margin-5">logout</a>
        </div>
        <div class="menu-list-container">
          <ul class="menu-list">
            <li class="menu-list-item">
              <a href="../dashboard"><i class="fas fa-home"></i>&nbsp;Dashboard</a>
            </li>
            <li class="menu-list-item">
              <a href="../videos"><i class="fas fa-film"></i>&nbsp;Videos</a>
            </li>
            <li class="menu-list-item">
              <a href="../materials"><i class="fas fa-file-pdf"></i>&nbsp;Materials</a>
            </li>
            <li class="menu-list-item">
              <a href="../support"><i class="fas fa-info-circle"></i>&nbsp;Support</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid-payment payment-section-container">
      <div class="payment-title">
        <h1>Online payment</h1>
      </div>
      <div class="form-card">
        <div id="header-img">
          <img src="../img/credit_cards.png" width="128" alt="Visa, Master Card">
        </div>
        <form action="" method="post" id="form-payment">
          <p><strong>Amount to pay</strong></p>
          <div class="form-row">
            <div class="form-group col-md-10">              
              <input type="number" class="form-control" id="PaymentAmount" name="PaymentAmount" aria-describedby="Amount" value="100" readonly>            
            </div>
            <div class="form-group col-md-2">            
              <button class="btn btn-secondary" id="PaymentCurrency" disabled>MXN</button>            
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">              
              <input type="text" class="form-control" id="PaymentFirstName" name="PaymentFirstName" aria-describedby="FirstName" placeholder="First Name">            
            </div>
            <div class="form-group col-md-6">            
              <input type="text" class="form-control" id="PaymentLastName" name="PaymentLastName" aria-describedby="LastName" placeholder="Last Name">
            </div>
          </div> 
          <div class="form-group">              
              <input type="text" class="form-control" id="CardNumber" name="CardNumber" aria-describedby="CardNumber" placeholder="Card Number">            
          </div> 
          <div class="form-row">
            <div class="form-group col-md-6">              
              <input type="text" class="form-control" id="PaymentExpiry" name="PaymentExpiry" aria-describedby="PaymentExpiry" placeholder="MM/YY">            
            </div>
            <div class="form-group col-md-6">            
              <input type="number" class="form-control" id="PaymentCVC" name="PaymentCVC" aria-describedby="PaymentCVC" placeholder="CVC">
            </div>
          </div> 
          <p><strong>Email</strong></p>
          <div class="form-group">              
              <input type="email" class="form-control" id="PaymentEmail" name="PaymentEmail" aria-describedby="PaymentEmail" value="<?= $_SESSION["user"]["email_usuario"] ?>">   
              <small>This is the email we will use to send your receipt, feel free to change it your way. (This will not replace your account email)</small>         
          </div> 
          <button class="btn btn-primary col-md-12"><i class="fas fa-lock"></i>&nbsp;&nbsp;Pay</button>                  
        </form>
      </div>
    </div>
  </body>
  <script>

  </script>
  </html>
