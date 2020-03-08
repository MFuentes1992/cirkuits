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
    <div class="pos-f-t">
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>subscription">Subscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url?>updatepayment/">Update payment</a>
            </li>
            <li id='reslogout' class="hidden">
              <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>
            </li>
            <li id="resavatar" class="hidden">
              <a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a> 
            </li>
          </ul>
        </div>
      </div>
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="col-md-1" id="toggle">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-2" id="logoContainer">
          <a href="<?=$url;?>" style="margin-left: 5%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="340" height="128"/></a>
        </div>
        <div class="col-md-3" id="avatarContainer">
          <div class="line" style="margin-top:20px;">
            <a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a>    
          </div>
          <div class="line">
            <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>
          </div>
        </div>
      </nav>
    </div>



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
          <div class="text-center" style="margin-bottom:2%;">
            <br>
            <br>
            <h1>Welcome<span style="margin-left:0.5%;" class="welcome-name" ><?php echo $_SESSION["user"]["alter_usuario"] ?></span> </h1>
          </div>

          <div class="container-fluid">
            <div class="row" id="menu">
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
        <footer class="footer col-md-12" style="position:relative;">
          <div class="row">
            <div class="foot-section" id="contactoFooter">
              <span>
                <h4>Contact</h4>
              </span>
              <span class="label">+52 777 500 60 83</span>
              <br>
              <span class="label">postal code: 63866</span>
              <br>
              <span class="label">cirkuitsed@cirkuits.com.mx</span>
              <br>
              <span class="label">2019 www.cirkuits.com &copy;</span>
            </div>
            <div class="foot-section" id="supportFooter">
              <span>
                <h4>Soporte</h4>
              </span>
              <span class="label">Contact Us</span>
              <br>
              <span class="label">Help & FAQ</span>
              <br>
              <span class="label">Service Status</span>
              <br>
              <span class="label">Tech Requirements</span>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script>
      $(document).ready( function(){
        $('#logModal').modal('show');
        responsiveEngine();
      });

    var commonResponsive = swidth => {
          $('.separator').css('visibility', 'hidden');    
    }

    var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('#toggle').removeClass('col-md-1');
      $('#logoContainer').addClass('col-md-6');
      $('#avatarContainer').removeClass('col-md-3');
      $('#avatarContainer').addClass('col-md-4');
    }
    var mobileResponsive = (swidth) =>{
        commonResponsive(swidth);
        $('.img_logo').css('width', '200');
        $('.img_logo').css('height', '80');
        $('#logoContainer').removeClass('col-md-2');
        $('#toggle').removeClass('col-md-1');
        $('#avatarContainer').remove();
        $('#supportFooter').css('width','100%');
        $('#contactoFooter').css('width', '100%');
        $('#contactoFooter').css('margin-left','10%');
        $('#supportFooter').css('text-align','justify');
        $('#supportFooter').css('margin-left','10%');
        $('#supportFooter').css('margin-top','5%');
        $('#resavatar').css('visibility','visible');
        $('#reslogout').css('visibility','visible');
        $('#menu').css('text-align', 'justify');
        $('.text-center > h1').css('font-size', '1.5em');
        $('.text-center > h1 > span').css('font-size', '1em');
      }
      var responsiveEngine = () => {
      var SCREEN_WIDTH = $(window).width();
      var SCREEN_HEIGHT = $(window).height();
      /** /////////////// RESPONSIVE ////////////// */

      /**//////////////// TABLET (800 - 425) ////////// */
      if(SCREEN_WIDTH <= 800 && SCREEN_WIDTH > 425){
        tabletResponsive(SCREEN_WIDTH);
      }
      /**//////////////// MOBILE (425 - 325) ////////// */
      if(SCREEN_WIDTH <= 425){
        mobileResponsive(SCREEN_WIDTH);
      }
    }
    </script>
  </body>
  </html>
