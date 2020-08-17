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
        $payment = 1;
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
  <body>
    <div class="aside-menu">
      <div id="aside-logo-container">
        <img src="../img/bw_logo.png" alt="Cirkuits logo">
      </div>
      <div id="menu-container">
        <div id="user-avatar-container">
          <img id="avatar-usuario" src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="<?= $_SESSION["user"]["avatar_usuario"] ?>" />
          <p id="user-name"><strong><?= $_SESSION["user"]["nombre_usuario"] ?></strong>&nbsp;<strong><?= $_SESSION["user"]["apellido_usuario"] ?></strong></p>
        </div>
        <div class="menu-item">
            <a href="<?=$url;?>profile" class="c-badge-primary margin-5">Setings</a>
            <a href="<?=$url;?>profile" class="c-badge-primary margin-5">Help</a>
            <a href="<?=$url;?>exit.php" class="c-badge-red margin-5">logout</a>
        </div>
      </div>
    </div>
    <div class="container-fluid-dashboard">
      <!-- Modal for displaying message -->
        <?php if($payment == 1) { ?>
        <div class="modal fade bs-example-modal-sm" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title txt-color-darkgray">Payment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="ico-close-add"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body txt-color-darkgray">
              <span style="font-size: 3em; margin-right:0.5em;"> <i class="fas fa-exclamation-triangle"></i> </span>Please add a Credit Card to proceed.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-close-add">Close</button>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div>
        <div class="contenido-dashboard">
          <div class="text-center" style="margin-bottom:2%;">
            <br>
            <br>
            <h1>Welcome:<span style="margin-left:0.5%;" class="welcome-name" ><?php echo $_SESSION["user"]["alter_usuario"] ?></span> </h1>
          </div>

          <div class="container-fluid">
            <div id="dash-menu">
              <div class="menu-item-hex">
                <a class="label txt-color-darkgray link-static" href="<?=$url;?>videos">
                  <span class="dash-ico" ><i class="fas fa-film"></i></span> <br>
                  <span class="white">Videos</span>
                </a>
              </div>
              <div class="menu-item-hex">
                <a class="label txt-color-darkgray link-static" href="<?=$url;?>videogames">
                  <span class="dash-ico" ><i class="fas fa-gamepad"></i></span> <br>
                  <span class="white">Videogames</span>
                </a>
              </div>
              <div class="menu-item-hex">
                <a class="label txt-color-darkgray link-static" href="<?=$url;?>materials">
                  <span class="dash-ico" ><i class="far fa-file-pdf"></i></span> <br>
                  <span class="white">Materials</span>
                </a>
              </div>
              <div class="menu-item-hex">
                <a class="label txt-color-darkgray link-static" href="#">
                  <span class="dash-ico" ><i class="far fa-comments"></i></span> <br>
                  <span class="white">support</span>
                </a>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).ready( function(){
        $('#paymentModal').modal('show');
        console.log($(window).width());
      });
    </script>
  </body>
  </html>
