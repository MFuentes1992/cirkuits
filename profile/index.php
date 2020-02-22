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

      $query_user_progress_v1 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 1",
      GetSQLValueString($conexion,$idUsuario, "int"));
      $result_user_progress_v1 = mysqli_query($conexion, $query_user_progress_v1) or die(mysqli_error($conexion));

      $row_user_progress_v1 = mysqli_fetch_assoc($result_user_progress_v1);

      $query_user_progress_v2 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 2",
      GetSQLValueString($conexion,$idUsuario, "int"));
      $result_user_progress_v2 = mysqli_query($conexion, $query_user_progress_v2) or die(mysqli_error($conexion));

      $row_user_progress_v2 = mysqli_fetch_assoc($result_user_progress_v2);

      $query_user_progress_v3 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 3",
      GetSQLValueString($conexion,$idUsuario, "int"));
      $result_user_progress_v3 = mysqli_query($conexion, $query_user_progress_v3) or die(mysqli_error($conexion));

      $row_user_progress_v3 = mysqli_fetch_assoc($result_user_progress_v3);
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
   <!-- Standardised web app manifest -->
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>PROFILE</title>
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
   <nav class="navbar navbar-default navbar-fixed-top menu">
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
           <li><a href="<?=$url;?>profile"><img src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="32px" style="top:-10px" /></a></li>
           <li><a href="<?=$url;?>profile"><strong><?php echo $_SESSION["user"]["alter_usuario"] ?></strong></a></li>
           <li><a href="<?=$url;?>exit.php"><span class="label label-danger">Log out</span></a></li>
         </ul>
       </div>
     </div>
   </nav>
   <div class="container-fluid">
     <div class="row">
       <div class="contenido">
         <br>
         <div id="profile">
           <div id="userPhoto" class="">
             <img id="userAvatar" src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" style="top:-10px" />
           </div>
           <div id="userInfo" class="">
             <div id="userNameP" class="row">
               <a href="<?=$url;?>edit" class="label label-success" style="font-size:12pt;">
                 <span style="font-size:14pt;">
                   <i class="fa fa-pencil" aria-hidden="true"></i>

                 </span>Edit info &nbsp;
               </a>
               &nbsp;&nbsp;<span style="font-size:14pt; font-weight:bold;"><?= $row_user_data["nombre_usuario"]?></span>
               <span style="font-size:14pt; font-weight:bold;"><?= $row_user_data["apellido_usuario"]?></span>
             </div>
             <div id="userExtra">
               <table>
                 <tr>
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left data">User Name:</span>
                   </td>
                   <td>
                     &nbsp;
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;" class="text-left"><?= $row_user_data["alter_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left data">Email:</span>
                   </td>
                   <td>
                     &nbsp;
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;" class="text-left"><?= $row_user_data["email_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left data">Birth Date:</span>
                   </td>
                   <td>
                     &nbsp;
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;" class="text-left"><?= $row_user_data["nacimiento_usuario"]?></span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <span style="font-size:14pt; font-weight:bold; text-align: justify;" class="text-left data">Member Since:</span>
                   </td>
                   <td>
                     &nbsp;
                     <span style="font-size:14pt; font-weight:regular; text-align: justify;" class="text-left"><?= $row_user_data["fecha_registro"]?></span>
                   </td>
                 </tr>
               </table>
             </div>
             <div class="text-center">
               <h2>Video games</h2>
             </div>
             <!-- Videojuego 1 -->
             <div id="userProgress" class="row">
               <h3>Neuron igniter:&nbsp;lvl&nbsp;<?php echo $row_user_progress_v1["nivel"] <= 0 ?  "N/A" : $row_user_progress_v1["nivel"]; ?></h3>
               <div id="userProgressText">
                 <span>Progreso</span>
               </div>
               <div id="userProgressBar" class="progress">
                 <?php
                  $nivelActual = $row_user_progress_v1["nivel"];
                  $totalNiveles = $row_user_progress_v1["niveles"];
                  $mathHelper = $nivelActual * 100;
                  $percentage = $mathHelper / $totalNiveles;
                 ?>
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= (int)$percentage; ?>"
                  aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
                  <span style="font-size:14pt;">
                    <i class="fa fa-gamepad" aria-hidden="true"></i>
                    <?= (int)$percentage; ?> %
                  </span>
                  </div>
                </div>
                <!-- Videojuego 2 -->
                <h3>Neuron Shooter&nbsp;lvl&nbsp;<?php echo $row_user_progress_v2["nivel"] <= 0 ? "N/A" : $row_user_progress_v2["nivel"]; ?></h3>
                <div id="userProgressText">
                  <span>Progreso</span>
                </div>
                <div id="userProgressBar" class="progress">
                  <?php
                   $nivelActual = $row_user_progress_v2["nivel"];
                   $totalNiveles = $row_user_progress_v2["niveles"];
                   $mathHelper = $nivelActual * 100;
                   $percentage = $mathHelper / $totalNiveles;
                  ?>
                   <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= (int)$percentage; ?>"
                   aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
                   <span style="font-size:14pt;">
                     <i class="fa fa-gamepad" aria-hidden="true"></i>
                     <?= (int)$percentage; ?> %
                   </span>
                   </div>
                 </div>
                 <!-- Videojuego 3 -->
                 <h3>Neuron Mapper:&nbsp;lvl&nbsp;<?php echo $row_user_progress_v3["nivel"] <= 0 ? "N/A" : $row_user_progress_v3["nivel"]; ?></h3>
                 <div id="userProgressText">
                   <span>Progreso</span>
                 </div>
                 <div id="userProgressBar" class="progress">
                   <?php
                    $nivelActual = $row_user_progress_v3["nivel"];
                    $totalNiveles = $row_user_progress_v3["niveles"];
                    $mathHelper = $nivelActual * 100;
                    $percentage = $mathHelper / $totalNiveles;
                   ?>
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= (int)$percentage; ?>"
                    aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
                    <span style="font-size:14pt;">
                      <i class="fa fa-gamepad" aria-hidden="true"></i>
                      <?= (int)$percentage; ?> %
                    </span>
                    </div>
                  </div>
             </div>
             <span></span>
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

   </script>
 </body>
 </html>
