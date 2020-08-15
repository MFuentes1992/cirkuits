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
        $levelGameName = array();
        if(isset($_GET["game"])){
          $_game = $_GET["game"];
          $strQueryLevelGame = sprintf("SELECT cat_levels.id_level, cat_levels.nombre FROM cat_levels 
              INNER JOIN videogame_level 
              ON videogame_level.id_level =  cat_levels.id_level 
              WHERE id_usuario = %s AND id_videogame = %s;",
          GetSQLValueString($conexion, $_SESSION["user"]["id_usuario"], "int"),
          GetSQLValueString($conexion, $_GET["game"], 'int'));
          $rawLevelGame = mysqli_query($conexion, $strQueryLevelGame)or die(mysqli_error($conexion));          
          while($row = mysqli_fetch_assoc($rawLevelGame)){
            array_push($levelGameName, $row);
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
  <div class="leaderboard-section-container">
    <br>
    <h1 class="leaderboard-title">Tierboard:&nbsp;Choose a level</h1>    
    <br> 
    <div class="leaderboard-container">
      <?php foreach($levelGameName as $levelName) {?>
      <div class="leaderboard-level-container">
          <div class="leaderboard-level-item" onClick='gotoLeaderboard(<?=$levelName["id_level"]?>)'>
              <h3><?=$levelName["nombre"]?></h3>
              <input type="hidden" name="game" id="game" value="<?=$_game?>">
          </div>
      </div>
      <?php } ?>
    </div>   
  </div>
  <script src="../js/games/three.js" charset="utf-8"></script>
  <script type="text/javascript">    
    const gotoLeaderboard = id_level => {
      let game = $('#game').val();
      window.location.replace(`http://localhost/Cirkuits/leaderboard/?game=${game}&level=${id_level}`);
    }
  </script>
</body>
</html>
