<?php
  include_once("../../util/utilities.php");
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
        /*Disabeling user payment*/
        header("Location:".$url."payment");        
      }
      else if($_SESSION["user"]["estatus_usuario"] == 2){
        $payment = 2;
      }
      else {
        header("location:".$url."signin");
      }
    }
  }else {
    header("location:".$url."signin");
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standardised web app manifest -->
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
    <link rel="stylesheet" href="<?=$url;?>/js/swiper-5.3.6/package/css/swiper.min.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
    <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
    <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
    <script src="<?=$url;?>js/jquery-ui.js"></script>
    <script src="<?=$url;?>js/jquery.validationEngine-es.js"></script>
    <script src="<?=$url;?>js/jquery.validationEngine.js"></script>
    <script src="<?=$url;?>js/swiper-5.3.6/package/js/swiper.min.js"></script>
</head>
<body>

    <div class="pos-f-t">
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="col-md-1" id="toggle">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-6" id="logoContainer">
          <a href="<?=$url;?>" style="margin-left: 45%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="240" height="100"/></a>
        </div>
        <div class="col-md-3" id="avatarContainer">
          <div class="line" style="margin-top:20px;">
            <a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a>    
          </div>
          <div class="line">
            <a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>
          </div>
        </div>
      </nav>    
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark" style="padding-left:1.5rem;">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>payment/">Payment and Subscription</a>
            </li>
            <li id="resavatar" class="hidden">              
            </li>
            <li id='reslogout' class="hidden">              
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid bg-black">
        <div class="level-selector">
            <div class="level-selector-title">
                <img src="../../img/videogames/levelselect.png" width="400" alt="level select">
            </div>
            <div class="level-level">
                <table class="level-table">
                    <tr>                        
                        <td>
                            <?php if($_SESSION["uprogressv1"]["nivel"] == 1){?>
                            <div class="level-number" onClick="reload(1)">1</div>
                            <?php } else {?>
                            <div class="level-number-lock"></div>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($_SESSION["uprogressv1"]["nivel"] == 2){?>
                            <div class="level-number" onClick="reload(2)">2</div>
                            <?php } else {?>
                            <div class="level-number-lock"></div>
                            <?php }?>                                
                        </td>
                        <td>
                            <?php if($_SESSION["uprogressv1"]["nivel"] == 3){?>
                            <div class="level-number" onClick="reload(3)">3</div>
                            <?php } else {?>
                            <div class="level-number-lock"></div>                                
                            <?php }?>
                        </td>
                    </tr>
                </table>
            </div>            
            <div>
                <table class="table-footer">
                      <tr>                          
                          <td><div class="level-footer" id="leaderboard" onClick="leaderBoard()"></div></td>
                          <td><div class="level-footer" id="play" onClick="reload(<?php echo $_SESSION["uprogressv1"]["nivel"] ?>)"></div></td>
                      </tr>
                </table>
            </div>            
        </div>
    </div>
    <!--/////// Contact ///// -->     
      <!-- Footer -->
      <footer class="footer col-md-12" style="position:relative;">
        <div class="row">
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
    
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  </div>
  <script type="text/javascript">    
      $(document).ready( function(){
        $('#logModal').modal('show');
        responsiveEngine();
      });

    var commonResponsive = swidth => {
          $('.separator').css('visibility', 'hidden');    
    }

    var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('#toggle').removeClass('col-md-1');
      $('#logoContainer').addClass('col-md-6');
      $('#logoContainer').removeClass('col-md-4');
      $('.img_logo').css('width', '256');
      $('#avatarContainer').removeClass('col-md-3');
      $('#avatarContainer').addClass('col-md-4');
    }
    var mobileResponsive = (swidth) =>{
        commonResponsive(swidth);
        $('.img_logo').css('width', '200');
        $('.img_logo').css('height', '80');
        $('#logoContainer').removeClass('col-md-6');
        $("#logoContainer > a").css('margin-left','0%');
        $('.contenido-dashboard').css('height', 'fit-content');
        $('#toggle').removeClass('col-md-1');
        $('#avatarContainer').remove();
        $('#supportFooter').css('width','100%');
        $('#contactoFooter').css('width', '100%');
        $('#contactoFooter').css('margin-left','10%');
        $('#supportFooter').css('text-align','justify');
        $('#supportFooter').css('margin-left','10%');
        $('#supportFooter').css('margin-top','5%');
        $('#resavatar').css('visibility','visible');
        $('#reslogout').css('visibility','visible');                                     
        $('#menu').css('text-align', 'justify');
        $('#resavatar').append('<a class="nav-link" href="<?=$url;?>profile"> <img src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="64px" style="top:-10px" /> </a>');
        $('#reslogout').append('<a class="nav-link" href="<?=$url;?>exit.php"><span class="badge badge-danger">Log out</span></a> ');
        $('#resavatar').removeClass('hidden');
        $('#reslogout').removeClass('hidden');
        $('.text-center > h1').css('font-size', '1.5em');
        $('.text-center > h1 > span').css('font-size', '1em');        
      }
      var responsiveEngine = () => {
      var SCREEN_WIDTH = $(window).width();
      var SCREEN_HEIGHT = $(window).height();
      /** /////////////// RESPONSIVE ////////////// */
      if(SCREEN_WIDTH > 1024){
        $("#reslogout > a").remove();
        $("#resavatar > a").remove();
      }
      if(SCREEN_WIDTH <= 1404){
        $("#logoContainer > a").css('margin-left','45%');
      } else if(SCREEN_WIDTH >= 1404){
        $("#logoContainer > a").css('margin-left','54%');
      }      
      /**//////////////// TABLET (800 - 425) ////////// */
      if(SCREEN_WIDTH <= 800 && SCREEN_WIDTH > 425){
        tabletResponsive(SCREEN_WIDTH);
      }
      /**//////////////// MOBILE (425 - 325) ////////// */
      if(SCREEN_WIDTH <= 425){
        mobileResponsive(SCREEN_WIDTH);
      }
    }

    var swiper = new Swiper('.swiper-container', {
      loop: true,
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    var reload = level => {
      alert(level);
    }

    var leaderBoard = () =>{
      alert("Go to Leaderboard")
    }
  </script>
</body>
</html>
