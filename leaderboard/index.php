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

      $videogame = isset($_GET["id"]) ? $_GET["id"] : 1;
      $query_get_hscore = sprintf("SELECT high_score,id_usuario FROM leaderboard WHERE id_videogame = %s ORDER BY high_score DESC LIMIT 10",
      GetSQLValueString($conexion, $videogame, "int"));
      $result_hscore = mysqli_query($conexion, $query_get_hscore)or die(mysqli_error($conexion));

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
       <div class="contenido" id="tleaderboard">
         <br>
         <h3>Leaderboard</h3>
         <br>
         <?php if(mysqli_num_rows($result_hscore) > 0) {?>
          <table width="100%" style="text-align: center;">
           <thead style="background-color:#424242; color:#FFF;">
             <th>
               Rank
             </th>
             <th>
               <span>Usuario</span>
             </th>
             <th>
               <span>Score</span>
             </th>
           </thead>
           <tbody>
             <?php
             $ranker = 1;
              while($row = mysqli_fetch_assoc($result_hscore))
              {
                $query_get_user = sprintf("SELECT alter_usuario FROM usuarios WHERE id_usuario = %s",
                GetSQLValueString($conexion, $row["id_usuario"], "int"));
                $result_get_user = mysqli_query($conexion, $query_get_user)or die(mysqli_error($conexion));
                $r = mysqli_num_rows($result_get_user) > 0 ? mysqli_fetch_assoc($result_get_user) : NULL;
             ?>
                <tr style="margin-bottom:5%;">
                <td>
                  <?=$ranker++;?>
                </td>
                <td>
                  <?=$r["alter_usuario"]?>
                </td>
                <td>
                  <?=$row["high_score"];?>
                </td>
              </tr>
             <?php
              }
              ?>
           </tbody>
         </table>
         <?php } else {?>

         <?php } ?>
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
