<?php
include_once("../util/utilities.php");
require_once("../util/funciones.php");
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
      header("Location:".$url."payment");
    }
    else if($_SESSION["user"]["estatus_usuario"] == 2){
      $idUsuario = $_SESSION["user"]["id_usuario"];

      $query_user_data = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s",
      GetSQLValueString($conexion,$idUsuario, "int"));
      $result_user_data = mysqli_query($conexion, $query_user_data) or die(mysqli_error($conexion));
      $row_user_data = "";

      if(mysqli_num_rows($result_user_data) > 0)
      {
        $row_user_data = mysqli_fetch_assoc($result_user_data);
      }
    }
    else {
      header("location:".$url."singin");
    }
  }
}else {
  header("location:".$url."singin");
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
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
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="col-md-1" id="toggle">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-6" id="logoContainer">
          <a href="<?=$url;?>" style="margin-left: 45%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="220" height="100"/></a>
        </div>
        <div class="col-md-3" id="avatarContainer">
          <div class="line" style="margin-top:20px;">
            <a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a>    
          </div>
          <div class="line">
            <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/default.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>
          </div>
        </div>
      </nav>
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark" style="padding-left:1.5rem;">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>subscription">Payment and Subscription</a>
            </li>
            <li id="resavatar" class="hidden">              
            </li>
            <li id='reslogout' class="hidden">              
            </li>
          </ul>
        </div>
      </div>
   </div>
   <div class="container-fluid">
     <div class="row">
       <div class="contenido">
         <br>
         <div id="profile">
           <div id="userPhoto" class="">
             <img id="userAvatar" src="<?=$url;?>img/avatars/default.png" alt="avatar.png" class="img img-rounded" style="top:-10px" width="100" height="100" />
           </div>
           <div id="userInfo" class="">
             <div id="userNameP">
             </div>
             <div id="userExtra">
               <table>
                 <tr>                   
                   <td>
                    <a href="<?=$url;?>edit" class="badge badge-warning" style="font-size:12pt;">
                      <span style="font-size:14pt;">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Edit info </span>
                      </span>
                    </a>                    
                   </td>
                   <td>                     
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left"><?= $row_user_data["nombre_usuario"]?></span>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left"><?= $row_user_data["apellido_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>            
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;">User Name:</span>
                   </td>
                   <td>                     
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;"><?= $row_user_data["alter_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;">Email:</span>
                   </td>
                   <td>                     
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;"><?= $row_user_data["email_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>                   
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;">Birth Date:</span>
                   </td>
                   <td>                     
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;"><?= $row_user_data["nacimiento_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>                   
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;">Member Since:</span>
                   </td>
                   <td>                     
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;"><?= $row_user_data["fecha_registro"]?></span>
                   </td>
                 </tr>
               </table>
               <div class="row hide" id="responsive-body">
                  <div class="full-width">
                    <a href="<?=$url;?>edit" class="badge badge-warning" style="font-size:12pt;">
                        <span style="font-size:14pt;">
                          <i class="fas fa-pencil-alt"></i>
                          <span>Edit info </span>
                        </span>
                    </a>                 
                  </div>
                  <div class="full-width">
                    <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left"><?= $row_user_data["nombre_usuario"]?></span>
                    <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left"><?= $row_user_data["apellido_usuario"]?></span>               
                  </div>
                  <div class="full-width">
                    <span style="font-size:14pt; font-weight:bold; text-align: justify;">User Name:</span>
                  </div>
                  <div class="full-width">
                    <span style="color:#cccccc;"><?= $row_user_data["alter_usuario"]?></span>
                  </div>
                  <div class="full-width">
                    <span style="font-size:14pt; font-weight:bold; text-align: justify;">Email:</span>
                  </div>
                  <div class="full-width">
                    <span style="color:#cccccc;"><?= $row_user_data["email_usuario"]?></span>
                  </div>
                  <div class="full-width">
                    <span style="font-size:14pt; font-weight:bold; text-align: justify;">Birth Date:</span>
                  </div>
                  <div class="full-width">
                    <span style="color:#cccccc;"><?= $row_user_data["nacimiento_usuario"]?></span>
                  </div>
                  <div class="full-width">
                    <span style="font-size:14pt; font-weight:bold; text-align: justify;">Member Since:</span>
                  </div>
                  <div class="full-width">
                    <span style="color:#cccccc;"><?= $row_user_data["fecha_registro"]?></span>
                  </div>                  
               </div>
               <!-- userExtra -->
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
        console.log($(window).width());
      });

    var commonResponsive = swidth => {
          $('.separator').css('visibility', 'hidden');    
    }

    var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('#toggle').removeClass('col-md-1');
      $('#logoContainer').addClass('col-md-6');
      $('#logoContainer').removeClass('col-md-4');
      $('.img_logo').css('width', '256');
      $('#avatarContainer').removeClass('col-md-3');
      $('#avatarContainer').addClass('col-md-4');
    }
    var mobileResponsive = (swidth) =>{
        commonResponsive(swidth);
        $('.img_logo').css('width', '200');
        $('.img_logo').css('height', '80');
        $('#logoContainer').removeClass('col-md-6');
        $("#logoContainer > a").css('margin-left','0%');
        $('#toggle').removeClass('col-md-1');
        $('.contenido-dashboard').css('height', 'fit-content');
        $('#avatarContainer').remove();
        $('#supportFooter').css('width','100%');
        $('#contactoFooter').css('width', '100%');
        $('#contactoFooter').css('margin-left','10%');
        $('#supportFooter').css('text-align','justify');
        $('#supportFooter').css('margin-left','10%');
        $('#supportFooter').css('margin-top','5%');
        $('#resavatar').append('<a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/default.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>');
        $('#reslogout').append('<a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a> ');
        $('#resavatar').removeClass('hidden');
        $('#reslogout').removeClass('hidden');
        $('#menu').css('text-align', 'justify');
        $('.text-center > h1').css('font-size', '1.5em');
        $('.text-center > h1 > span').css('font-size', '1em');
        $('#userExtra > table').remove();
        $("#responsive-body").removeClass("hide");        
      }
      var responsiveEngine = () => {
      var SCREEN_WIDTH = $(window).width();
      var SCREEN_HEIGHT = $(window).height();
      /** /////////////// RESPONSIVE ////////////// */
      if(SCREEN_WIDTH > 3800){
        $("#logoContainer > a").css('margin-left','60%');
      }
      if(SCREEN_WIDTH > 1800 && SCREEN_WIDTH <= 3800){
        $("#logoContainer > a").css('margin-left','55%');
      }
      if(SCREEN_WIDTH > 1024){
        $("#reslogout > a").remove();
        $("#resavatar > a").remove();
      }
      if(SCREEN_WIDTH <= 1404){
        $("#logoContainer > a").css('margin-left','45%');
      }

      if(SCREEN_WIDTH > 700){
        $("#responsive-body").addClass("hide"); 
      }

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
