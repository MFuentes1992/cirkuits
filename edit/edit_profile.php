<?php
include_once("util/utilities.php");
require_once("util/funciones.php");
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
      header("Location:payment.php");
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
        nombre_usuario = %s, apellido_usuario = %s, alter_usuario = %s, password = %s,
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
  header("Location:login.php");
}
 ?>
 <!DOCTYPE html>
 <html lang="en" manifest="offline.appcache">
 <head>
   <!-- Standardised web app manifest -->
   <meta charset="UTF-8">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>PROFILE</title>
   <link rel="manifest" href="appmanifest.json" />
   <link rel="stylesheet" href="css/bootstrap.css" />
   <link rel="stylesheet" href="css/cirkuits.css" />
   <link rel="stylesheet" href="css/master.css" />
   <link rel="stylesheet" href="css/jquery-ui.css" />
   <link rel="stylesheet" href="css/validationEngine.jquery.css" />
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
   <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
   <script src="js/jquery-1.12.3.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-ui.js"></script>
   <script src="js/jquery.validationEngine-es.js"></script>
   <script src="js/jquery.validationEngine.js"></script>

 </head>
 <body>
   <nav class="navbar navbar-default navbar-fixed-top menu">
     <div class="container-fluid">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cirkuitsNavbar">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a href="#" class="navbar-brand"><img src="img/logo2.png" alt="Logo Cirkuits" class="img-navbar"/></a>
       </div>
       <div class="collapse navbar-collapse" id="cirkuitsNavbar">
         <ul class="nav navbar-nav navbar-right">
           <li><a href="dashboard.php"><strong>Dashboard</strong></a></li>
           <li><a href="infosubscription.php"><strong>Subscription</strong></a></li>
           <li><a href="<?=$url?>updatepayment/"><strong>Update payment</strong></a></li>
           <li><a href="infouser.php?u=<?php echo base64_encode($_SESSION["user"]["nombre_usuario"])?>"> <img src="img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="32px" style="top:-10px" /> </a></li>
           <li><a href="infouser.php?u=<?php echo base64_encode($_SESSION["user"]["nombre_usuario"])?>"><strong><?php echo $_SESSION["user"]["alter_usuario"] ?></strong></a></li>
           <li><a href="exit.php"><span class="label label-danger">Log out</span></a></li>
         </ul>
       </div>
     </div>
   </nav>
   <div class="container-fluid">
     <div class="row">
       <div class="contenido">
         <div class="text-center">
           <h1>Edit profile</h1>
         </div>
       </div>
       <div id="user-content">
         <form class="" action="" method="post">
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
             name="userName" id="userName" value="<?= $row_user_data["alter_usuario"]?>" disabled />
           </div>
           <div class="form form-group">
             <input type="password" class="form-control"
             data-validation-engine="validate[required,custom[email]]"
             data-errormessage-value-missing="Password is required"
             name="password" id="password" value="<?= $row_user_data["password"]?>" disabled />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control"
             data-validation-engine="validate[required,custom[email]]"
             data-errormessage-value-missing="Email is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: someone@nowhere.com"
             name="email" id="email" value="<?= $row_user_data["email_usuario"]?>" disabled />
           </div>
           <div class   ="form form-group">
             <input type ="text" class="form-control"
             data-validation-engine="validate[required]"
             data-errormessage-value-missing="Birth date is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: 1992-10-21"
             name="birthDate" id="birthDate"  value="<?= $row_user_data["nacimiento_usuario"]?>" disabled />
           </div>
           <input type="hidden" name="Insert" value="1">
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
       <footer class="footer col-md-12">
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
             <div class="img-social">
               <img src="img/index/twitter.png" alt="Twitter" />
             </div>
             <div class="img-social">
               <img src="img/index/facebook.png" alt="Facebook" />
             </div>
             <div class="img-social">
               <img src="img/index/youtube.png" alt="Youtube" />
             </div>
           </div>
         </div>
       </footer>
     </div>
   </div>
   <script>
   $(document).ready( function(){ $('#updateuser_form').validationEngine(); } );
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
     $('#password').prop('disabled', false);

     $('#btn-group').html(
       '<input type="button" class="btn btn-success" onclick="edit_user()" value="Modificar" /><input type="button" class="btn btn-success" onclick="salir()" value="Back" />'
     );
   }

   function salir()
   {
     window.history.back();
   }
   </script>
 </body>
 </html>
