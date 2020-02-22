<?php
  include_once("util/utilities.php");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  session_start();
  $strServerMsg = "";

  if(!isset($_SESSION["user"]))
  {
    header("Location:login.php");
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
   <title>Payment</title>
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
   <script src="js/sanitizer.js"></script>
   <script src="js/jquery.validationEngine-es.js"></script>
   <script src="js/jquery.validationEngine.js"></script>
   <script src="js/reguser.js"></script>

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
           <h1>Payment</h1>
         </div>
       </div>
       <div class="form">
         <form action="processpayment.php" method="post" id="card-form">
           <span class="card-errors"></span>
           <div class="form form-group">
             <input type="text" class="form-control"
              data-conekta="card[name]"
              data-validation-engine="validate[required, custom[onlyLetterSp]]"
              data-errormessage-value-missing="Name is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: Andrew"
              name="name" id="name" placeholder="Name"/>
           </div>
           <div class="form form-group">
             <input type="text" class="form-control" name="lastName" id="lastName"
              data-validation-engine="validate[required, custom[onlyLetterSp]]"
              data-errormessage-value-missing="Last name is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: Garfield"
              placeholder="Last name" />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control" name="cardNumber" id="cardNumber"
             data-conekta="card[number]"
             data-validation-engine="validate[required]"
             data-errormessage-value-missing="Card number is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: 5504909923086138"
             placeholder="Card number" />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control" id="cardValidMonth"
             data-conekta="card[exp_month]"
             data-validation-engine="validate[required]"
             data-errormessage-value-missing="Month is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: 01"
             name="cardValidMonth" placeholder="MM" />
             <input type="number" class="form-control" id="cardValidYear"
             data-conekta="card[exp_year]"
             data-validation-engine="validate[required]"
             data-errormessage-value-missing="Year is required"
             data-errormessage-custom-error="Invalid, let me give you a hint: 20"
             name="cardValidYear" placeholder="YY" />
           </div>
           <div class="form form-group">
             <input type="text" class="form-control" name="cvc" id="cvc"
              data-conekta="card[cvc]"
              data-validation-engine="validate[required, length[0,2]]"
              data-errormessage-value-missing="cvc is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: 000"
              placeholder="cvc" />
           </div>
           <div class="form form-group">
             <select type="text" class="form-control" name="tipoSubscripcion" id="tipoSubscripcion"
              data-validation-engine="validate[required]"
              data-errormessage-value-missing="Please select a subscription">
              <option value="1">Monthly</option>
              <option value="2">Annual</option>
            </select>
           </div>
           <div class="btn-group btn-group-lg" role="group">
             <button type="submit" class="btn btn-success" value="Pay">Pay</button>
             <input type="button" class="btn btn-success" onclick="limpiar()" value="Cancel" />
           </div>
           <br>
         </form>
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

   $(document).ready( function(){ $('#card-form').validationEngine(); } );
     function limpiar()
     {
       $('#name').val('');
       $('#lastName').val('');
       $('#cardNumber').val('');
       $('#cardValidMonth').val('');
       $('#cardValidYear').val('');
       $('#cvc').val('');
     }
     $(function () {
       $("#card-form").submit(function(event) {
         var $form = $(this);

         // Previene hacer submit más de una vez
         $form.find("button").prop("disabled", false);
         Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

     // Previene que la información de la forma sea enviada al servidor
         return false;
       });
     });
     var conektaSuccessResponseHandler = function(token) {
       var $form = $("#card-form");

       /* Inserta el token_id en la forma para que se envíe al servidor */
       $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));

       /* and submit */
       $form.get(0).submit();
     };
     var conektaErrorResponseHandler = function(response) {
     var $form = $("#card-form");

     /* Muestra los errores en la forma */
     $form.find(".card-errors").text(response.message);
     $form.find("button").prop("disabled", false);
   };
   </script>
 </body>
 </html>
