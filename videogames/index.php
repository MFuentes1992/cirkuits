<?php
include_once("../util/utilities.php");
session_start();
if(isset($_SESSION["user"]))
{
  header("location:".$url."dashboard");
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
  <link rel="stylesheet" href="<?=$url;?>css/bootstrap-4.3.1/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="<?=$url;?>css/cirkuits.css" />
  <link rel="stylesheet" href="<?=$url;?>css/fontawesome-free-5.8.1-web/css/all.css">
  <link rel="stylesheet" href="<?=$url;?>css/fancybox/jquery.fancybox.css" media="screen" title="no title" charset="utf-8">
  <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
  <script src="<?=$url;?>js/jquery-1.10.1.min.js"></script>
  <script src="<?=$url;?>js/jquery.fancybox.js"></script>
  <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
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
          <a class="nav-link" href="<?=$url;?>signin">Sign In &nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$url;?>signup">Sign Up &nbsp;&nbsp;<i class="fas fa-user-plus"></i></a>
        </li>
      </ul>
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
          <img src="<?=$url;?>img/index/videogame1.jpg" alt="Videogame 1" />
        </div>
        <div class="txt-wrapper">
          <br>
          <p style="font-size:16pt;">
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
          <img src="<?=$url;?>img/index/videogame2.jpg" alt="Videogame 4" />
        </div>
        <div class="txt-wrapper">
          <br>
          <p style="font-size:16pt;">
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
          <img src="<?=$url;?>img/index/videogame3.jpg" alt="Videogame 3" />
        </div>
        <div class="txt-wrapper">
          <br>
          <p style="font-size:16pt;">
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
            <a href="http://www.twitter.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-twitter-square"></i></span></a>
            <a href="http://www.facebook.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-facebook"></i></span></a>
            <a href="http://www.youtube.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-youtube"></i></span></a>
            <a href="http://www.instagram.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-instagram"></i></span></a>
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
