<?php
include_once("util/utilities.php");
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
    }
    else {
      header("location:login.php");
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
           <br>
           <h1>Subscription</h1>
         </div>
       </div>
       <div id="subscription" class="text-center">
         <div id="endDate" class="text-center">
          <p style="padding-top:30px">
            Su subscripción se renovará automáticamente <strong>16.05.16.</strong> Se le cargará dinero MXN <strong>99.00cf</strong>
          </p>
        </div>
        <div id="service" class="text-center">
          <h3>Producto</h3>
          <br>
          <img src="img/product.png" class="img-thumbnail" alt="product.png" />
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

   </script>
 </body>
 </html>
