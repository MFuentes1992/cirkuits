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

      $nombre          = (isset($_POST["name"]) ? $_POST["name"]           : "NULL");
      $apellido        = (isset($_POST["lastName"]) ? $_POST["lastName"]   : "NULL");
      $nombreUsuario   = (isset($_POST["userName"]) ? $_POST["userName"]   : "NULL");
      $password        = (isset($_POST["password"]) ? $_POST["password"]   : "NULL");
      $correo          = (isset($_POST["email"]) ? $_POST["email"]         : "NULL");
      $fechaNacimiento = (isset($_POST["birthDate"]) ? $_POST["birthDate"] : "NULL");

      $idUsuario = $_SESSION["user"]["id_usuario"];

      if(isset($_POST["Insert"]))
      {
        $query_update_info = sprintf("UPDATE usuarios SET
        nombre_usuario = %s, apellido_usuario = %s, alter_usuario = %s, password_usuario = %s,
        email_usuario = %s, nacimiento_usuario = %s WHERE id_usuario = %s",
        GetSQLValueString($conexion, $nombre, "text"),
        GetSQLValueString($conexion, $apellido, "text"),
        GetSQLValueString($conexion, $nombreUsuario, "text"),
        GetSQLValueString($conexion, $password, "text"),
        GetSQLValueString($conexion, $correo, "text"),
        GetSQLValueString($conexion, $fechaNacimiento, "text"),
        GetSQLValueString($conexion, $idUsuario, "int"));

        $result_update_usuario = mysqli_query($conexion, $query_update_info) or die(mysqli_error($conexion));
      }

      $query_user_data = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s",
      GetSQLValueString($conexion,$idUsuario, "int"));
      $result_user_data = mysqli_query($conexion, $query_user_data) or die(mysqli_error($conexion));
      $row_user_data = mysqli_fetch_assoc($result_user_data);
    }
  }

}else {
  header("Location:".$url."singin");
}
 ?>
 <!DOCTYPE html>
 <html lang="en" manifest="offline.appcache">
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
            <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>
          </div>
        </div>
      </nav>
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark" style="padding-left:1.5rem;">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>dashboard"><i class="fas fa-window-maximize"></i>&nbsp;Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>payment/"><i class="far fa-credit-card"></i>&nbsp;Payment and Subscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>videos/"><i class="fas fa-film"></i>&nbsp;Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>videogames/"><i class="fas fa-gamepad"></i>&nbsp;Videogames</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>materials/"><i class="far fa-file-pdf"></i>&nbsp;Materials</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>support/"><i class="far fa-comments"></i>&nbsp;support</a>
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
       <div id="user-content">
         <form id="edituser_form" class="" action="" method="post">
           <div class="form form-group">
             <input type ="text" class="form-control"
             data-validation-engine="validate[required, custom[onlyLetterSp]]"
             data-errormessage-value-missing="Name is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: Andrew"
             name="name" id="name"  value="<?= $row_user_data["nombre_usuario"]?>" disabled />
           </div>
           <div class = "form form-group">
             <input type ="text" class="form-control"
             data-validation-engine="validate[required, custom[onlyLetterSp]]"
             data-errormessage-value-missing="Last name is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: Garfield"
             name="lastName" id="lastName"  value="<?= $row_user_data["apellido_usuario"]?>" disabled />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control"
             data-validation-engine="validate[required, custom[onlyLetterNumber]]"
             data-errormessage-value-missing="User name is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: Awwwgarfiel"
             name="userName" id="userName" value="<?= $row_user_data["alter_usuario"]?>" disabled
             onblur="verify_user()"
             data-toggle="popover" title="Warning"
             data-placement="right"
             data-content="Username already exists" />
           </div>
           <div class="form form-group">
             <input type="password" class="form-control"
             data-validation-engine="validate[required,custom[email]]"
             data-errormessage-value-missing="Password is required"
             name="password" id="password" value="<?= $row_user_data["password_usuario"]?>" disabled />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control"
             data-validation-engine="validate[required,custom[email]]"
             data-errormessage-value-missing="Email is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: someone@nowhere.com"
             name="email" id="email" value="<?= $row_user_data["email_usuario"]?>" disabled
             data-toggle="popover" title="Warning"
             data-placement="right"
             data-content="Email already in use"
             onblur="verify_email()"/>
           </div>
           <div class   ="form form-group">
             <input type ="text" class="form-control"
             data-validation-engine="validate[required]"
             data-errormessage-value-missing="Birth date is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: 1992-10-21"
             name="birthDate" id="birthDate"  value="<?= $row_user_data["nacimiento_usuario"]?>" disabled />
           </div>
           <input type="hidden" name="Insert" value="1">
           <input type="hidden" name="iduser" id="idusere" value="<?=$_SESSION["user"]["id_usuario"]?>">
           <div class="text-center">
           <div class="btn-group btn-group-lg" id="btn-group" role="group">
           <input type="button" class="btn btn-success" onclick="edit_user()" value="Modificar" />
           <input type="button" class="btn btn-success" onclick="salir()" value="Back" />
           </div>
           </div>
         </form>
       </div>
     </div>
     <br>
     <br>
     <br>
     <br>
     <br>
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
   $(document).ready( function(){ $('#updateuser_form').validationEngine(); $('#birthDate').datepicker({changeYear:true}); } );
   function edit_user()
   {
     $('#name').prop('disabled', false);
     $('#lastName').prop('disabled', false);
     $('#userName').prop('disabled', false);
     $('#email').prop('disabled', false);
     $('#email').prop('disabled', false);
     $('#birthDate').prop('disabled', false);
     $('#password').prop('disabled', false);
     $('#btn-group').html(
       '<input type="submit" class="btn btn-success" value="Save" /><input type="submit" class="btn btn-success" value="Cancel" onclick="cancel_user()" />'
     );
   }

   function cancel_user()
   {
     $('#name').prop('disabled', true);
     $('#lastName').prop('disabled', true);
     $('#userName').prop('disabled', true);
     $('#email').prop('disabled', true);
     $('#birthDate').prop('disabled', true);
     $('#password').prop('disabled', true);

     $('#btn-group').html(
       '<input type="button" class="btn btn-success" onclick="edit_user()" value="Modificar" /><input type="button" class="btn btn-success" onclick="salir()" value="Back" />'
     );
   }

   var verify_user = function()
   {
     var data = {
       _userName: $('#userName').val(),
       edit:1,
       id:$('#idusere').val()
     }
     console.log(data); //warning debug
     $.ajax({
       url:"<?=$url?>util/verificator.php",
       type:"post",
       data: data,
       success: function(response)
       {
         console.log(response);
         var _response = parseInt(response);
         if(_response == 1)
         {
           console.log("popover");
           $('#userName').popover("show");
           $('#edituser_form').attr('onsubmit','return false');
         }else {
           $('#userName').popover("destroy");
           $('#edituser_form').attr('onsubmit','return validaForm()');
         }
       }
     })
   }
   var verify_email = function()
   {
     var data = {
       _email: $('#email').val(),
       edit:1,
       id:$('#idusere').val()
     }
     console.log(data); //warning debug
     $.ajax({
       url:"<?=$url?>util/verificator.php",
       type:"post",
       data: data,
       success: function(response)
       {
         var _response = parseInt(response);
         //console.log(response);
         if(_response == 1)
         {
           console.log("popover");
           $('#email').popover("show");
           $('#edituser_form').attr('onsubmit','return false');
         }else {
           $('#edituser_form').attr('onsubmit','return validaForm()');
           $('#email').popover("destroy");
         }
       }
     })
   }

   function salir()
   {
     //window.history.back();
     window.location.href="<?=$url?>profile"
   }

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
        $('#resavatar').append('<a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>');
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
