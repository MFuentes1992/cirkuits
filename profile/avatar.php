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
   <div class="container-fluid-avatar">
     <div class="row">        
         <div class="contenido-avatar">
                <br>
                <div class="avatar-showcase">
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile1.png" alt="profile1.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad1" name="avatar" value="profile1" checked /><label for="rad1">Select</label>
                    </div>
                </div>
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile2.png" alt="profile2.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad2" name="avatar" value="profile2" /><label for="rad2">Select</label>
                    </div>
                </div>
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile3.png" alt="profile3.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad3" name="avatar" value="profile3" /><label for="rad3">Select</label>
                    </div>
                </div>
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile4.png" alt="profile4.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad4" name="avatar" value="profile4" /><label for="rad4">Select</label>
                    </div>
                </div>
                <div id="userInfo" class="">
                    <div id="userNameP">
                    </div>
                    <div id="userExtra">                                             
                    </div>             
                </div>
                </div>
                <div class="avatar-showcase">
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile5.png" alt="profile5.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad5" name="avatar" value="profile5" /><label for="rad5">Select</label>
                    </div>
                </div>
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile6.png" alt="profile6.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad6" name="avatar" value="profile6" /><label for="rad6">Select</label>
                    </div>
                </div>
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile7.png" alt="profile7.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad7" name="avatar" value="profile7" /><label for="rad7">Select</label>
                    </div>
                </div>
                <div class="photo">
                    <img src="<?=$url;?>img/avatars/profile8.png" alt="profile8.png" class="img img-rounded" style="top:-10px" width="100" height="100" />             
                    <div class="full-width">
                        <input type="radio" id="rad8" name="avatar" value="profile8" /><label for="rad2">Select</label>
                    </div>
                </div>
                <div id="userInfo" class="">
                    <div id="userNameP">
                    </div>
                    <div id="userExtra">                                             
                    </div>             
                </div>
                </div>
                <div class="row">
                  <div class="btn-save-avatar">
                    <input type="hidden" name="iduser" id="iduser" value="<?=$_SESSION["user"]["id_usuario"]?>">
                    <button onClick="saveAvatar()" class="btn btn-info">Save Avatar</button>
                  </div>
                </div>
        </div>
     </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>   
   <script>
    var saveAvatar = ()=>{
        $.ajax({
        method: "POST",
        url: "edit_avatar.php",
        data: { avatar: $("input[name='avatar']:checked").val(), update: "true", idUsuario: $('#iduser').val() }
        })
        .done(function( msg ) {
          if(msg == 1){
            Swal.fire(
              'Avatar Saved!',
              'Please log out and back into the application to ensure you are seeing the latest configuration.',
              'success'
            );
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              footer: '<a href>Why do I have this issue?</a>'
            });
          }
        });
    }

    </script>
 </body>
 </html>
