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
        <div class="menu-list-container">
          <ul class="menu-list">
            <li class="menu-list-item">
              <a href="../dashboard"><i class="fas fa-home"></i>&nbsp;Dashboard</a>
            </li>
            <li class="menu-list-item">
              <a href="../videos"><i class="fas fa-film"></i>&nbsp;Videos</a>
            </li>
            <li class="menu-list-item">
              <a href="../videogames"><i class="fas fa-gamepad"></i>&nbsp;Videogames</a>
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
   <div class="container-fluid-edit">
     <div class="row">
       <div id="user-content">
         <h1 id="editprofile-title">Edit Profile</h1>
         <form id="edituser_form" class="" action="" method="post">
           <div class="form form-group">
             <input type ="text" class="form-control"
             data-validation-engine="validate[required, custom[onlyLetterSp]]"
             data-errormessage-value-missing="Name is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: Andrew"
             name="name" id="name"  value="<?= $row_user_data["nombre_usuario"]?>"  />
           </div>
           <div class = "form form-group">
             <input type ="text" class="form-control"
             data-validation-engine="validate[required, custom[onlyLetterSp]]"
             data-errormessage-value-missing="Last name is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: Garfield"
             name="lastName" id="lastName"  value="<?= $row_user_data["apellido_usuario"]?>"  />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control"
             data-validation-engine="validate[required, custom[onlyLetterNumber]]"
             data-errormessage-value-missing="User name is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: Awwwgarfiel"
             name="userName" id="userName" value="<?= $row_user_data["alter_usuario"]?>" 
             onblur="verify_user()"
             data-toggle="popover" title="Warning"
             data-placement="right"
             data-content="Username already exists" />
           </div>
           <div class="form form-group">
             <input type="password" class="form-control"
             data-validation-engine="validate[required,custom[email]]"
             data-errormessage-value-missing="Password is required"
             name="password" id="password" value="<?= $row_user_data["password_usuario"]?>"  />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control"
             data-validation-engine="validate[required,custom[email]]"
             data-errormessage-value-missing="Email is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: someone@nowhere.com"
             name="email" id="email" value="<?= $row_user_data["email_usuario"]?>" 
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
             name="birthDate" id="birthDate"  value="<?= $row_user_data["nacimiento_usuario"]?>"  />
           </div>
           <input type="hidden" name="Insert" value="1">
           <input type="hidden" name="iduser" id="idusere" value="<?=$_SESSION["user"]["id_usuario"]?>">
           <div class="text-center">
           <input type="submit" class="btn btn-outline-success" value="Save" />
           <button class="btn btn-outline-success" id="cancel" value="Cancel">Cancel</button>
           </div>
         </form>
       </div>
     </div>
   </div>
   <script>
   $(document).ready( function(){ $('#updateuser_form').validationEngine(); $('#birthDate').datepicker({changeYear:true}); } );
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
     
   }
   $('#cancel').click(function(){
    $('#edituser_form').attr('onsubmit','return false');
    window.location.assign("http://localhost/cirkuits/profile");
   });
   </script>
 </body>
 </html>
