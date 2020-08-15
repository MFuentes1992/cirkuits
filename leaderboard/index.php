<?php
  include_once("../util/utilities.php");
  include_once("../util/funciones.php");
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
        $videogameName = "";
        if(isset($_GET["game"]) && isset($_GET["level"])){
          $strQueryVideogame = sprintf("SELECT nombre from cat_videogames WHERE id_videogame = %s",
          GetSQLValueString($conexion, $_GET["game"], 'int'));
          $rawVideogame = mysqli_query($conexion, $strQueryVideogame)or die(mysqli_error($conexion));
          $resultVideogame = mysqli_fetch_assoc($rawVideogame);
          $videogameName = $resultVideogame["nombre"]; 

          $arrayTierS = array();
          $arrayTierA = array();
          $arrayTierB = array();
          $arrayTierC = array();
          //----------------------------------- Tier S
          $strQueryTierSupper = sprintf("SELECT high_score, nombre_usuario, avatar_usuario FROM level_progress 
            INNER JOIN videogame_level 
            ON level_progress.id_videogame_level = videogame_level.id_videogame_level
            INNER JOIN usuarios ON videogame_level.id_usuario = usuarios.id_usuario
            WHERE id_videogame = %s AND id_level = %s AND high_score > 120 ORDER BY high_score DESC LIMIT 10;",
            GetSQLValueString($conexion, $_GET["game"], "int" ),
            GetSQLValueString($conexion, $_GET["level"], "int"));
          $rawLeaderboard = mysqli_query($conexion, $strQueryTierSupper) or die(mysqli_error($conexion));
          while($row = mysqli_fetch_assoc($rawLeaderboard)){
            array_push($arrayTierS, $row);
          }  
          //----------------------------------- Tier A 
          $strQueryTierA = sprintf("SELECT high_score, nombre_usuario, avatar_usuario FROM level_progress 
            INNER JOIN videogame_level 
            ON level_progress.id_videogame_level = videogame_level.id_videogame_level
            INNER JOIN usuarios ON videogame_level.id_usuario = usuarios.id_usuario
            WHERE id_videogame = %s AND id_level = %s AND high_score > 70 AND high_score < 100 ORDER BY high_score DESC LIMIT 10;",
            GetSQLValueString($conexion, $_GET["game"], "int" ),
            GetSQLValueString($conexion, $_GET["level"], "int"));
          $rawLeaderboard = mysqli_query($conexion, $strQueryTierA) or die(mysqli_error($conexion));
          while($row = mysqli_fetch_assoc($rawLeaderboard)){
            array_push($arrayTierA, $row);
          }  
          //--------------------------------- Tier B    
          $strQueryTierB = sprintf("SELECT high_score, nombre_usuario, avatar_usuario FROM level_progress 
            INNER JOIN videogame_level 
            ON level_progress.id_videogame_level = videogame_level.id_videogame_level
            INNER JOIN usuarios ON videogame_level.id_usuario = usuarios.id_usuario
            WHERE id_videogame = %s AND id_level = %s AND high_score > 50 AND high_score < 70 ORDER BY high_score DESC LIMIT 10;",
            GetSQLValueString($conexion, $_GET["game"], "int" ),
            GetSQLValueString($conexion, $_GET["level"], "int"));
          $rawLeaderboard = mysqli_query($conexion, $strQueryTierB) or die(mysqli_error($conexion));
          while($row = mysqli_fetch_assoc($rawLeaderboard)){
            array_push($arrayTierB, $row);
          } 
          //------------------------------- Tier C  
          $strQueryTierC = sprintf("SELECT high_score, nombre_usuario, avatar_usuario FROM level_progress 
            INNER JOIN videogame_level 
            ON level_progress.id_videogame_level = videogame_level.id_videogame_level
            INNER JOIN usuarios ON videogame_level.id_usuario = usuarios.id_usuario
            WHERE id_videogame = %s AND id_level = %s AND high_score > 0 AND high_score < 50 ORDER BY high_score DESC LIMIT 10;",
            GetSQLValueString($conexion, $_GET["game"], "int" ),
            GetSQLValueString($conexion, $_GET["level"], "int"));
          $rawLeaderboard = mysqli_query($conexion, $strQueryTierC) or die(mysqli_error($conexion));
          while($row = mysqli_fetch_assoc($rawLeaderboard)){
            array_push($arrayTierC, $row);
          } 
        }else{
          header("location:".$url."videogames");
        }
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
<body class="leaderboard-section-body">
  <div class="aside-menu">
    <div id="aside-logo-container">
      <img src="../img/bw_logo.png" alt="Cirkuits logo">
    </div>
    <div id="menu-container">
      <div id="user-avatar-container">
        <img id="avatar-usuario" src="<?=$url;?>img/avatars/<?= $_SESSION["user"]["avatar_usuario"] ?>.png" alt="<?= $_SESSION["user"]["avatar_usuario"] ?>" />
        <p id="user-name"><strong><?= $_SESSION["user"]["nombre_usuario"] ?></strong>&nbsp;<strong><?= $_SESSION["user"]["apellido_usuario"] ?></strong></p>
      </div>
      <div class="menu-item">
          <a href="<?=$url;?>profile" class="c-badge-primary margin-5">Setings</a>
          <a href="<?=$url;?>profile" class="c-badge-primary margin-5">Help</a>
          <a href="<?=$url;?>exit.php" class="c-badge-red margin-5">logout</a>
      </div>
      <div class="menu-list-container">
        <ul class="menu-list">
          <li class="menu-list-item">
            <a href="../dashboard"><i class="fas fa-home"></i>&nbsp;Dashboard</a>
          </li>
          <li class="menu-list-item">
            <a href="../videos"><i class="fas fa-film"></i>&nbsp;Videos</a>
          </li>
          <li class="menu-list-item">
            <a href="../videogames"><i class="fas fa-gamepad"></i>&nbsp;Videogames</a>
          </li>
          <li class="menu-list-item">
            <a href="../materials"><i class="fas fa-file-pdf"></i>&nbsp;Materials</a>
          </li>
          <li class="menu-list-item">
            <a href="../support"><i class="fas fa-info-circle"></i>&nbsp;Support</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid-leaderboard leaderboard-section-container">
    <br>
    <h1 class="leaderboard-title">Tierboard:&nbsp;<?=$videogameName?></h1>    
    <br>
    <div class="tierboard-container">
        <div class="tier">
          <div class="tier-head gradient-orange">
            <h1>S Tier</h1>
          </div>
          <div class="tier-body">
            <?php foreach($arrayTierS as $person){ ?>
              <div class="leaderboard-item">
                <div class="item-picture">
                  <img src="<?=$url;?>img/avatars/<?= $person["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="128px">
                </div>
                <div class="item-data">
                  <div class="item-name">
                    <?= $person["nombre_usuario"] ?>
                  </div>
                  <div class="item-hscore">
                    <?=$person["high_score"]?>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
        <div class="tier">
          <div class="tier-head gradient-yellow">
            <h1>A Tier</h1>
          </div>
          <div class="tier-body">
            <?php foreach($arrayTierA as $person){ ?>
              <div class="leaderboard-item">
                <div class="item-picture">
                  <img src="<?=$url;?>img/avatars/<?= $person["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="128px">
                </div>
                <div class="item-data">
                  <div class="item-name">
                    <?= $person["nombre_usuario"] ?>
                  </div>
                  <div class="item-hscore">
                    <?=$person["high_score"]?>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
        <div class="tier">
          <div class="tier-head gradient-green">
            <h1>B Tier</h1>
          </div>
          <div class="tier-body">
            <?php foreach($arrayTierB as $person){ ?>
              <div class="leaderboard-item">
                <div class="item-picture">
                  <img src="<?=$url;?>img/avatars/<?= $person["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="128px">
                </div>
                <div class="item-data">
                  <div class="item-name">
                    <?= $person["nombre_usuario"] ?>
                  </div>
                  <div class="item-hscore">
                    <?=$person["high_score"]?>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
        <div class="tier">
          <div class="tier-head gradient-blue">
            <h1>C Tier</h1>
          </div>
          <div class="tier-body">
            <?php foreach($arrayTierC as $person){ ?>
              <div class="leaderboard-item">
                <div class="item-picture">
                  <img src="<?=$url;?>img/avatars/<?= $person["avatar_usuario"] ?>.png" alt="avatar.png" class="img img-rounded" width="128px">
                </div>
                <div class="item-data">
                  <div class="item-name">
                   <strong><?= $person["nombre_usuario"] ?></strong>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
    </div>
  </div>
  <script src="../js/games/three.js" charset="utf-8"></script>
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
  </script>
</body>
</html>
