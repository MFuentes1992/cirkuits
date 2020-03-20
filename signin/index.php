<?php
include_once("../util/utilities.php");
require_once("../util/funciones.php");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();

$logError = 0;

if(isset($_SESSION["user"]))
{
  header("location:".$url."dashboard");
}
else {
  $strServerMsg = "";
  if(isset($_POST["email"]))
  {
    $email    = strip_tags($_POST["email"], FILTER_SANITIZE_STRING);
    $password = strip_tags($_POST["password"], FILTER_SANITIZE_STRING);
    $strQuery = "SELECT nombre_usuario FROM usuarios WHERE email_usuario = '".$email."'";
    $result   = mysqli_query($GLOBALS["conexion"], $strQuery) or die(mysqli_error($GLOBALS["conexion"]));

    if(mysqli_num_rows($result) > 0)
    {
      $strQuery = "SELECT * FROM usuarios WHERE password_usuario = '".$password."'";
      $strQuery .= " and email_usuario ='".$email."'";
      $result = mysqli_query($GLOBALS["conexion"], $strQuery) or die(mysqli_error($GLOBALS["conexion"]));
      if(mysqli_num_rows($result) > 0)
      {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user"]       = $row;
        $idUsuario = $_SESSION["user"]["id_usuario"];

        $query_user_progress_v1 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 1",
        GetSQLValueString($conexion,$idUsuario, "int"));
        $result_user_progress_v1 = mysqli_query($conexion, $query_user_progress_v1) or die(mysqli_error($conexion));

        $_SESSION["uprogressv1"] = $row_user_progress_v1 = mysqli_fetch_assoc($result_user_progress_v1);

        $query_user_progress_v2 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 2",
        GetSQLValueString($conexion,$idUsuario, "int"));
        $result_user_progress_v2 = mysqli_query($conexion, $query_user_progress_v2) or die(mysqli_error($conexion));

        $_SESSION["uprogressv2"] = $row_user_progress_v2 = mysqli_fetch_assoc($result_user_progress_v2);

        $query_user_progress_v3 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 3",
        GetSQLValueString($conexion,$idUsuario, "int"));
        $result_user_progress_v3 = mysqli_query($conexion, $query_user_progress_v3) or die(mysqli_error($conexion));

        $_SESSION["uprogressv3"] = $row_user_progress_v3 = mysqli_fetch_assoc($result_user_progress_v3);
        header("Location:".$url."dashboard");
      } else {
        $logError = 1;
      }
    }else {
      $logError = 1;
    }
  }
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>Cirkuits Sign in</title>
   <link rel="stylesheet" href="<?=$url;?>css/bootstrap-4.3.1/dist/css/bootstrap.css" />
   <link rel="stylesheet" href="<?=$url;?>css/cirkuits.css" />
   <link rel="stylesheet" href="<?=$url;?>css/master.css" />
   <link rel="stylesheet" href="<?=$url;?>css/fontawesome-free-5.8.1-web/css/all.css">
   <link rel="stylesheet" href="<?=$url;?>css/validationEngine.jquery.css" />
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
   <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
   <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
   <script src="<?=$url;?>js/sanitizer.js"></script>
   <script src="<?=$url;?>js/jquery.validationEngine-es.js"></script>
   <script src="<?=$url;?>js/jquery.validationEngine.js"></script>
   <script src="<?=$url;?>js/reguser.js"></script>
   <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="pos-f-t">
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h5 class="text-white label"><a class="text-white label" href="#about-title">About</a></h5>
          <h5 class="text-white label"><a class="text-white label" href="#contact-title">Contact</a></h5>
          <h5 class="text-white label">Sign in</h5>
          <h5 class="text-white label">Sign up</h5>
        </div>
      </div>
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-md-8" id="logoContainer">
          <a href="<?=$url;?>" style="margin-left: 10%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="340" height="128"/></a>
        </div>
      </nav>
  </div>
   <div class="container-fluid-signin">

     <!-- Modal for displaying message -->
     <?php if($logError == 1) { ?>
     <div class="modal fade bs-example-modal-sm" id="logModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Login failed</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="ico-close-add"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            Please check your username or password.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-close-add">Close</button>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>


       <div class="contenido-singin">
         <div class="text-center">
           <br>
           <br>
           <h1>Sign in</h1>
         </div>
         <br>
         <div class="form-wrapper">
             <div class="form">
               <form action="" method="post" id="login_form">
                 <div class="form form-group">
                   <input type="email" class="form-control" name="email" id="email"
                   data-validation-engine="validate[required, custom[email]]"
                   data-errormessage-value-missing="email is required"
                   data-errormessage-custom-error="Invalid, let me give you a hint: someone@nowhere.com"
                   placeholder="e-mail" />
                 </div>
                 <div class="form form-group">
                   <input type="password" class="form-control" name="password" id="passowrd"
                   data-validation-engine="validate[required]"
                   data-validation-engine="validate[required, custom[email]]"
                   data-errormessage-value-missing="password is required"
                   placeholder="password" />
                 </div>
                 <!--<input type="submit" name="submit" value="Sign" class="btn btn-success btn-lg">
                 <br>
                 <div class="" id="regLogin">
                   <span>Not registred yet?</span><h3><a href="reguser.php" class="label label-success">Sign up</a></h3>
                 </div>-->
               </form>
             </div>
             <div id="btn-login">
               <button type="button" name="btnLogin" id="btn-log" onclick="login()" class="btn btn-success">Sign In</button>
             </div>
         </div>
         <div id="regLogin">
           <span>Not registred yet?</span><span style="margin-left:0.5%;"><a href="<?=$url?>signup" class="label">Sign up</a></span>
         </div>
       </div>
      <!-- Footer -->      
      <footer class="footer col-md-12">
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
   <script type="text/javascript">
     $(document).ready( function(){
       $('#login_form').validationEngine();
       $('#logModal').modal('show');
       responsiveEngine();
     } );
     var login = function()
     {
       $('#login_form').submit();
     }

     var commonResponsive = swidth => {
        $('.separator').css('visibility', 'hidden');
        
    }

    var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
    }
   var mobileResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('.img_logo').css('width', '200');
      $('.img_logo').css('height', '80');
      $('#logoContainer').removeClass('col-md-8');
      $('#supportFooter').css('width','100%');
      $('#contactoFooter').css('width', '100%');
      $('#supportFooter').css('text-align','justify');
      $('#supportFooter').css('margin-left','5%');
      $('#supportFooter').css('margin-top','5%');
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
