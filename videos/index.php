<?php
include_once("../util/utilities.php");
require_once("../util/funciones.php");
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
      $idUsuario = $_SESSION["user"]["id_usuario"];

      $query_user_data = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s",
      GetSQLValueString($conexion,$idUsuario, "int"));
      $result_user_data = mysqli_query($conexion, $query_user_data) or die(mysqli_error($conexion));
      $row_user_data = "";

      if(mysqli_num_rows($result_user_data) > 0)
      {
        $row_user_data = mysqli_fetch_assoc($result_user_data);
      }
     //-------------------------------------------- Reading list of files
      $filelist = array();
      $counter = 0;
        if ($handle = opendir(".")) {
            while ($entry = readdir($handle)) {
                if (is_file($entry)) {
                  if( $counter > 0 ){
                    $filelist[] = $entry;
                  }
                  $counter++;
                }
            }
            closedir($handle);
        }
        //----------------------------------------- Retrieving list of related materials        
        $materialsArray = array();
        foreach ($filelist as $file) {
          $queryStr = sprintf("SELECT * FROM tbl_relatedMaterials WHERE video = %s ",
          GetSQLValueString($conexion,$file, "text"));
          $rawResult = mysqli_query($conexion, $queryStr) or die(mysqli_error($conexion));          
          while( $row = mysqli_fetch_assoc( $rawResult ) ){
            array_push( $materialsArray, $row );
          }
        }                 
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
 <html lang="en">
 <head>
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
  <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
  <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
  <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
  <script src="<?=$url;?>js/jquery-ui.js"></script>
  <script src="<?=$url;?>js/jquery.validationEngine-es.js"></script>
  <script src="<?=$url;?>js/jquery.validationEngine.js"></script>
 </head>
 <body>
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
  <div id="video-player">
    <div id="player-header">
      <div id="close-player">
        <img src="../img/close_btn.png" width="32" alt="Close Player" id="close-btn-player">
      </div>
      <div>
        <h1 id="player-title"></h1>
      </div>      
    </div>
    <div id="player-body">      
    </div>
  </div>
  <div class="container-fluid-videos">    
    <?php foreach($filelist as $file ) {?>
        <div class="video-wrapper">
            <div class="video-header">
                <p class="video-icon">
                    <a href="javascript:openVideoPlayer('<?=$file?>')"><strong><i class="fas fa-play"></i></strong></a>
                </p>              
            </div>
            <div class="video-body">
                <a href="javascript:openVideoPlayer('<?=$file?>')"><strong>Play</strong></a>
                <br>
                <a href="javascript:openVideoPlayer('<?=$file?>')"><strong><?=$file?></strong></a>
                <input type="hidden" id="hidden-res<?=$file?>" value="<?=$url;?>videos/<?=$file?>">
                <?php foreach($materialsArray as $material ) {?>
                  <?php if ($file == $material['video']) { ?>                  
                    <a href="<?=$url;?>materials/<?=$material['material']?>"><?=$material['material']?></a>
                  <?php } ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
  </div>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>   
   <script>
     function openVideoPlayer(UID){
      $('#video-player').css('visibility', 'visible');
      $('#player-title').append('<span id="title-video-em">'+UID+'</span>'); 
      $('#player-body').html( '<video id="player-video-em" src="'+UID+'" oncontextmenu="return false;" autoplay controls width=300 controlsList="nodownload"></video>' );
     }
     $('#close-btn-player').click(function(){
      $('#video-player').css('visibility', 'hidden');
      $('#title-video-em').remove(); 
      $('#player-video-em').remove();
     });
   </script>
 </body>
 </html>
