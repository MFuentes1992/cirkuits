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
   <div class="container-fluid-profile">
     <div class="row">
       <div class="contenido">
         <br>
         <div id="profile">
           <div id="userPhoto" class="">
             <img id="userAvatar" src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" style="top:-10px" width="100" height="100" />
             <div class="full-width">
                <a href="avatar.php">Change</a>
             </div>
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
   </div>
   <script>
   </script>
 </body>
 </html>
