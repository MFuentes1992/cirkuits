<!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>Cirkuits Sign in</title>
   <link rel="stylesheet" href="../css/bootstrap-4.3.1/dist/css/bootstrap.css" />
   <link rel="stylesheet" href="../css/cirkuits.css" />
   <link rel="stylesheet" href="../css/master.css" />
   <link rel="stylesheet" href="../css/fontawesome-free-5.8.1-web/css/all.css">
   <link rel="stylesheet" href="../css/validationEngine.jquery.css" />
   <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
   <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
   <script src="../js/jquery-1.12.3.min.js"></script>
   <script src="../js/sanitizer.js"></script>
   <script src="../js/jquery.validationEngine-es.js"></script>
   <script src="../js/jquery.validationEngine.js"></script>
   <script src="../js/reguser.js"></script>
   <script src="../js/dist/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="pos-f-t">

    <nav class="navbar sticky-top navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="../">
        <img class="img_logo" src="../img/bw_logo.png" alt="cirkuits logo"/>
      </a>
      <button class="btn btn-lg btn-outline-secondary my-2 my-sm-0 label" id="login" type="submit" style="color:#FFF !important; border-color:#FFF !important; visibility:hidden;">Sign in</button>
    </nav>
    <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark" style="padding-left: 1.5rem">
        <h5 class="text-white label"><a class="text-white label" href="#about-title">About</a></h5>
        <h5 class="text-white label"><a class="text-white label" href="#contact-title">Contact</a></h5>
        <h5 class="text-white label"><a class="text-white label" href="signin/">Sign in</a></h5>
        <h5 class="text-white label"><a class="text-white label" href="signup/">Sign up</a></h5>
      </div>
    </div>

  </div>
    <div class="container-fluid-signin">
        <div class="error-register-wrapper">
            <img src="../img/500/500.png" alt="Server down" width="200">
            <p class="error-register-text">
                Something went wrong, please contact support using the following link. <a href="">(Contact)</a>
            </p>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer col-md-12" style="position:relative;">
        <div class="row">
          <div class="foot-section" id="logoAndSocial">
            <div>
              <img src="../img/cirkuits education_bw.png" alt="cirkuits logo Black & White" width="128">
            </div>              
            <ul class="list-horizontal">
              <li class="white icon"><i class="fab fa-facebook-f"></i></li>
              <li class="white icon"><i class="fab fa-youtube"></i></li>
              <li class="white icon"><i class="fas fa-envelope-open"></i></li>
            </ul>
            <p class="white">Powered by Three Js &nbsp; &nbsp;<i class="fas fa-dice-d6"></i></p>
            <p class="white">MarkCraft labs &nbsp; &nbsp;<i class="fas fa-flask"></i></p>
          </div>
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
    <div style="position:relative; width: 100%;">
    <p style="text-align:center; color #FFF; font-family:'Jokey';">Made with &nbsp;<i class="fas fa-laptop-code"></i>&nbsp; by MarkCraft </p>
    </div>

 </body>
 <script type="text/javascript">
    var commonResponsive = swidth => {                
    }

   var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
      $("#logoContainer > a").css('margin-left','0%');
    }
    var mobileResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('.img_logo').css('width', '200');
      $('.img_logo').css('height', '80');
      $('#login').remove();
      $('#logoContainer').removeClass('col-md-8');
      $("#logoContainer > a").css('margin-left','0%');      
      $('#contactoFooter').css('width', '100%');
    }

    var responsiveEngine = () => {
      var SCREEN_WIDTH = $(window).width();
      var SCREEN_HEIGHT = $(window).height();
      /** /////////////// RESPONSIVE ////////////// */

      /**//////////////// TABLET (800 - 425) ////////// */
      if(SCREEN_WIDTH <= 800 && SCREEN_WIDTH > 425){
        tabletResponsive(SCREEN_WIDTH);
      }
      /**//////////////// MOBILE (425 - 325) ////////// */
      if(SCREEN_WIDTH <= 425){
        mobileResponsive(SCREEN_WIDTH);
      }
      if(SCREEN_WIDTH >= 1404){
        $("#logoContainer > a").css('margin-left','15%');
      } 
    }

    $(document).ready(function(){
        responsiveEngine();
    });
 </script>
 </html>