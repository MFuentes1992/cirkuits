<?php
include_once("util/utilities.php");
if(isset($_SESSION["user_session"]))
{
  header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Cirkuits</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/cirkuits.css" />
  <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css" media="screen" title="no title" charset="utf-8">
  <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
  <script src="js/jquery-1.10.1.min.js"></script>
  <script src="js/jquery.fancybox.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
          <li><a href="index.php"><strong>Home</strong></a></li>
          <li><a href="cirkuits.php"><strong>Cirkuits</strong></a></li>
          <li><a href="videojuegos.php"><strong>Video Games</strong></a></li>
          <li><a href="reguser.php"><span class="glyphicon glyphicon-user"></span> <strong>Sing Up</strong></a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> <strong>Login</strong></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <!-- Video row -->
      <div class="banner-container" id="banner-videogames">
            <span class="slide-header" >Video games</span>
            <br>
      </div>
    </div>
    <div class="row row-thumb">
      <div class="thumb-wrapper">
        <div class="thumb-nail">
          <img src="img/index/videogame1.jpg" alt="Videogame 1" />
        </div>
        <div class="txt-wrapper">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
        <a href="https://www.youtube.com/embed/5GBVMGXXFMw?autoplay=1" class="fancybox fancybox.iframe label label-success" style="font-size:12pt">Watch Gameplay</a>
      </div>
      <div class="thumb-wrapper">
        <div class="thumb-nail">
          <img src="img/index/videogame2.jpg" alt="Videogame 4" />
        </div>
        <div class="txt-wrapper">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
        <a href="https://www.youtube.com/embed/5GBVMGXXFMw" class="fancybox fancybox.iframe label label-success" style="font-size:12pt">Watch Gameplay</a>
      </div>
      <div class="thumb-wrapper">
        <div class="thumb-nail">
          <img src="img/index/videogame3.jpg" alt="Videogame 3" />
        </div>
        <div class="txt-wrapper">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
        <a href="https://www.youtube.com/embed/5GBVMGXXFMw" class="fancybox fancybox.iframe label label-success" style="font-size:12pt">Watch Gameplay</a>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $(".fancybox").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
      });
    });
  </script>
</body>
</html>
