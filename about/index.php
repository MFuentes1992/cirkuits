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
  <link rel="stylesheet" href="<?=$url;?>css/jquery-ui.css" />
  <link rel="stylesheet" href="<?=$url;?>css/fontawesome-free-5.8.1-web/css/all.css">
  <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
  <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
  <script src="<?=$url;?>js/jquery-ui.js"></script>
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
      <div class="banner-container" id="banner-cirkuits">
            <span class="slide-header">Cirkuits</span>
            <br>
      </div>
    </div>

    <div class="row">
      <div class="center">
        <img src="<?=$url;?>img/logo_alone.png" alt="Cirkuits" class="img-circle"/>
        <br>
        <div class="text-about text-center" id="acordeon">
          <h1><strong>About us</strong></h1>
          <div>
            <p style="font-size:18pt;">
              Cirkuits is a team that offers the most comprehensive language development program ever.
              We have been working for years to generate the best results possible in our classrooms and now we have a sleek and brilliant online platform that will permit
              the entire world to benefit from this experience with our cutting-edge tools and program.
            </p>
          </div>
          <h1><strong>Cirkuits Program</strong></h1>
          <div>
            <p style="font-size:18pt;">
              We  provide several video games that will allow you the type of
              familiarity with English that will produce proper and
              consistent oral expression.
              They make for great tools alongside any English learning program, however,
              if paired with our Cirkuits online classroom training,
              we can offer you results no one even comes close to.
              Find out more on our Cirkuits tab. Forget ambiguous levels!
              We do away with the traditional basic,  intermediate,
              advanced structure.
              The Cirkuits Program focuses on the English tenses themselves as the basis
              for advancement. You start with the most used English tense: the simple present,
              then you move on to the simple past followed by the present perfect.
              The simple, continuous and perfect tenses comprise the Cirkuits International
              Business program. Once 90% of your spoken sentences are correctly structured in
              the Simple Present tense then you advance to the Simple past and repeat the process until you have mastered each level.
              Mastery of each tense requires from 1-3 months depending on your existing level of
              development. Once you finish the Cirkuits Program you will have the language
              skills to be able to work in any English-speaking country. We turn your spoken production
              into numbers (eg. correct sentences vs. incorrect sentences) and allow you to analyze your
              efforts in every session.
            </p>
          </div>
          <h1><strong>Vision </strong></h1>
          <div>
            <p style="font-size:18pt;">
              To become the global-standard in the language-learning sector by
               charting the course for the first unconscious-competence training model.
              <br>
              <strong>What is unconscious competence?</strong>
              <br>
              Unconscious competence involves the ability to do something without needing
              to think about it. Any speech pattern can be internalized and automated;
              we achieve this at Cirkuits with a structured series of games and activities
            </p>
          </div>
          <h1><strong>Mission</strong></h1>
          <div>
          <p style="font-size:18pt;">
            To provide our students with the most forward-thinking tools to help them
            learn a language as quickly as possible for as long as possible.
          </p>
        </div>
          <h1><strong>Values</strong></h1>
          <div>
            <p style="font-size:18pt;">
              When taking a decision within the company we always ask “does this help accelerate and improve the students’ end result?
            </p>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $( "#acordeon" ).accordion({
        collapsible: true
      });
    });
  </script>
</body>
</html>
