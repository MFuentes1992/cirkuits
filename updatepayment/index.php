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
 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>UPDATE PAYMENT</title>
   <link rel="stylesheet" href="<?=$url;?>css/bootstrap.css" />
   <link rel="stylesheet" href="<?=$url;?>css/cirkuits.css" />
   <link rel="stylesheet" href="<?=$url;?>css/master.css" />
   <link rel="stylesheet" href="<?=$url;?>css/jquery-ui.css" />
   <link rel="stylesheet" href="<?=$url;?>css/font-awesome-4.6.3/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?=$url;?>css/validationEngine.jquery.css" />
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
   <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
   <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
   <script src="<?=$url;?>js/bootstrap.min.js"></script>
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
           <li><a href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/person-flat.png" alt="avatar.png" class="img img-rounded" width="32px" style="top:-10px" /> </a></li>
           <li><a href="<?=$url;?>profile"><strong><?php echo $_SESSION["user"]["alter_usuario"] ?></strong></a></li>
           <li><a href="<?=$url;?>exit.php"><span class="label label-danger">Log out</span></a></li>
         </ul>
       </div>
     </div>
   </nav>
   <div class="container-fluid">
     <div class="row">
       <div class="contenido">
         <div class="text-center">
           <br>
           <h1>Update payment </h1>
         </div>
       </div>
       <div id="subscription" class="text-center">
         <div id="endDate" class="text-center">
          <p style="padding-top:30px">
            <?php if($row_pago["id_tipopago"] == 1) {?>
              <span style="font-size:18pt;"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
              &nbsp;Actualmente tienes una tarjeta cr&eacute;dito/debito registrada.
            <?php }else{ ?>
              <span style="font-size:18pt;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
              Actualmente No cuentas con ninguna tienes una tarjeta registrada.
            <?php }?>
          </p>
        </div>
        <div id="service" class="text-center">
          <h3>Tarjeta Cr&eacute;dito/Debito</h3>
          <br>
          <?php if($row_pago["id_tipopago"] == 1) {?>
            <button type="button" name="button" class="btn btn-primary" id="btn-change-plastic">Cambiar</button>
          <?php }else{ ?>
            <button type="button" name="button" class="btn btn-primary" id="btn-add-plastic">Añadir</button>
          <?php }?>
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
             <a href="http://www.twitter.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fa fa-twitter" aria-hidden="true"></i></span></a>
             <a href="http://www.facebook.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fa fa-facebook" aria-hidden="true"></i></span></a>
             <a href="http://www.youtube.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fa fa-youtube" aria-hidden="true"></i></span></a>
             <a href="http://www.instagram.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fa fa-instagram" aria-hidden="true"></i></span></a>
           </div>
         </div>
       </footer>
     </div>
   </div>

   <!-- Modal for update -->
    <div class="modal fade" id="updateCreditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="ico-close-change"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar tarjeta</h4>
          </div>
          <div class="modal-body">
            <?php include($url."util/mod_credit.php");?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-close-change">Close</button>
            <button type="button" class="btn btn-primary" id="btn-save-change">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for update -->
    <div class="modal fade" id="addCreditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="ico-close-add"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Añadir tarjeta</h4>
          </div>
          <div class="modal-body">
            <?php include($url."util/mod_credit.php");?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-close-add">Close</button>
            <button type="button" class="btn btn-primary" id="btn-save-add">Add</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#card-form').validationEngine({scroll:false});
        $('#btn-change-plastic').click(function () {
          $('#updateCreditModal').modal('show');
        });
        $('#btn-add-plastic').click(function() {
          $('#addCreditModal').modal('show');
        });
        $('#btn-save-change').click(function() {
          $('#card-form').submit();
        });
        $('#btn-save-add').click(function() {
          $('#card-form').submit();
        });
        $('#btn-close-change').click(function(){
          $('#card-form').validationEngine('hideAll');
        });
        $('#btn-close-add').click(function(){
          $('#card-form').validationEngine('hideAll');
        });
        $('#ico-close-change').click(function() {
          $('#card-form').validationEngine('hideAll');
        });
        $('#ico-close-add').click(function() {
          $('#card-form').validationEngine('hideAll');
        });
      });
    </script>

 </body>
 </html>
