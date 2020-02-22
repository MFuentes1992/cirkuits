<?php
include_once("../util/utilities.php");
include_once("../util/DAO.php");
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
      $str_pago = sprintf("SELECT * FROM pago where id_usuario = %s ORDER BY fecha DESC",
      $_SESSION["user"]["id_usuario"]);

      $rs_pago = mysqli_query($conexion, $str_pago);

      $row_pago = mysqli_num_rows($rs_pago) > 0 ? mysqli_fetch_assoc($rs_pago) : NULL;


      if($row_pago["id_tipo"] == 1)
      {
        $prev_year = intval(substr($row_pago["fecha"], 0, 4));
        $prev_month = intval(substr($row_pago["fecha"], 5, 2));
        $prev_day = intval(substr($row_pago["fecha"], 8, 2));

        $dateToday = date("Y-m-d");
        $today_year = substr($dateToday, 0, 4);

        if(fitDate((int)$prev_day, (int)($prev_month + 1)) == 0)
        {
          $dateHelper = $prev_day.".0".($prev_month + 1).".".$today_year;
        }else {
          $dateHelper = fitDate($prev_day, ($prev_month + 1)).".0".($prev_month + 2).".".$today_year;
        }
      }else {
        $prev_year = intval(substr($row_pago["fecha"], 0, 4));
        $prev_month = intval(substr($row_pago["fecha"], 5, 2));
        $prev_day = intval(substr($row_pago["fecha"], 8, 2));

        $dateToday = date("Y-m-d");
        $today_year = substr($dateToday, 0, 4);

        if(fitDate((int)$prev_day, (int)($prev_month + 1)) == 0)
        {
          $dateHelper = $prev_day.".0".($prev_month + 1).".".($prev_year + 1);
        }else {
          $dateHelper = fitDate($prev_day, ($prev_month + 1)).".0".($prev_month + 2).".".($prev_year + 1);
        }
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
 <html lang="en" manifest="offline.appcache">
 <head>
   <!-- Standardised web app manifest -->
   <meta charset="UTF-8">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>SUBSCRIPTION</title>
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
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <a class="navbar navbar-brand">
       <img src="<?=$url;?>img/logo2.png" alt="" />
     </a>
     <div class="collapse navbar-collapse" id="navbarNav" style="flex-direction: row-reverse !important;">
       <ul class="navbar-nav">
         <li class="nav-item">
           <a class="nav-link" href="<?=$url;?>">Home</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="<?=$url;?>about">Cirkuits</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="<?=$url;?>videogames">Video Games</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="<?=$url;?>/signin">Sign In &nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="<?=$url;?>/signup">Sign Up &nbsp;&nbsp;<i class="fas fa-clipboard-list"></i></a>
         </li>
       </ul>
     </div>
   </nav>
   <div class="container-fluid">
     <div class="row">
       <div class="contenido">
         <div class="text-center">
           <br>
           <h1>Subscription</h1>
         </div>
       </div>
       <div id="subscription" class="text-center">
         <div id="endDate" class="text-center">
          <p style="padding-top:30px">
            Su subscripción se renovará automáticamente <strong><?=$dateHelper?></strong> Se le cargará dinero MXN <strong>99.00cf</strong>
          </p>
        </div>
        <div id="service" class="text-center">
          <h3>Producto</h3>
          <br>
          <img src="<?=$url;?>img/product.png" class="img-thumbnail" alt="product.png" />
        </div>
       </div>
     </div>
     <br>
     <br>
     <br>
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
