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
    <link rel="manifest" href="appmanifest.json" />
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
    <!--<nav class="navbar navbar-default navbar-fixed-top menu">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cirkuitsNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?=$url;?>dashboard" class="navbar-brand"><img src="<?=$url;?>img/logo2.png" alt="Logo Cirkuits" class="img-navbar"/></a>
        </div>
        <div class="collapse navbar-collapse" id="cirkuitsNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=$url;?>dashboard"><strong>Dashboard</strong></a></li>
            <li><a href="<?=$url;?>subscription"><strong>Subscription</strong></a></li>
            <li><a href="<?=$url?>updatepayment/"><strong>Update payment</strong></a></li>
            <li><a href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="32px" style="top:-10px" /> </a></li>
            <li><a href="<?=$url;?>profile"><strong><?php echo $_SESSION["user"]["alter_usuario"] ?></strong></a></li>
            <li><a href="<?=$url;?>exit.php"><span class="label label-danger">Log out</span></a></li>
          </ul>
        </div>
      </div>
    </nav>-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar navbar-brand">
        <img src="<?=$url;?>img/logo2.png" alt="" />
      </a>
      <div class="collapse navbar-collapse" id="navbarNav" style="flex-direction: row-reverse !important;">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=$url;?>dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$url;?>subscription">Subscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$url?>updatepayment/">Update payment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="32px" style="top:-10px" /> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid-dashboard">

      <!-- Modal for displaying message -->
      <?php if($payment == 1) { ?>
      <div class="modal fade bs-example-modal-sm" id="logModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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



      <div class="row">
        <div class="contenido-dashboard">
          <div class="text-center" style="margin-bottom:10%;">
            <br>
            <br>
            <h1>Welcome<span style="margin-left:0.5%;" class="welcome-name" ><?php echo $_SESSION["user"]["alter_usuario"] ?></span> </h1>
          </div>

          <div class="container-fluid">
            <div class="row" style="text-align:center;">
              <div class="menu-item col">
                <a class="label txt-color-darkgray link-static" href="#">
                  <span class="dash-ico" style="font-size: 3em;"><i class="fas fa-film"></i></span> <br>
                  <span class="">Videos</span>
                </a>
              </div>
              <div class="menu-item col">
                <a class="label txt-color-darkgray link-static" href="#">
                  <span class="dash-ico" style="font-size: 3em;"><i class="fas fa-gamepad"></i></span> <br>
                  <span class="">Videogames</span>
                </a>
              </div>
              <div class="menu-item col">
                <a class="label txt-color-darkgray link-static" href="#">
                  <span class="dash-ico" style="font-size: 3em;"><i class="far fa-file-pdf"></i></span> <br>
                  <span class="">Materials</span>
                </a>
              </div>
              <div class="menu-item col">
                <a class="label txt-color-darkgray link-static" href="#">
                  <span class="dash-ico" style="font-size: 3em;"><i class="far fa-comments"></i></span> <br>
                  <span class="">support</span>
                </a>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Footer -->
        <footer class="footer col-md-12" style="position:relative">
          <div class="row">
            <div class="foot-section col-md-4" id="contacto">
              <span>+52 777 123 45 67</span>
              <br>
              <span>example@domain.com.mx</span>
              <br>
              <span>postal code: 63866</span>
              <br>
            </div>
            <div class="foot-section col-md-4" id="copyright">
              <span>2016 Cirkuits all rights reserved &copy;</span>
              <br>
            </div>
            <div class="foot-section social" id="social-1">
              <a href="http://www.twitter.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-twitter-square"></i></span></a>
              <a href="http://www.facebook.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-facebook"></i></span></a>
              <a href="http://www.youtube.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-youtube"></i></span></a>
              <a href="http://www.instagram.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-instagram"></i></span></a>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script>
      $(document).ready( function(){
        $('#logModal').modal('show');
      });
    </script>
  </body>
  </html>
