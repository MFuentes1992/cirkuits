<?php
  include_once("../../util/utilities.php");
  require_once("../../util/funciones.php");
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
            /**//////////////////////// GET THE LEVEL SESSION ///////////////////////// */
            $strSpeechRecognition = sprintf("SELECT count(*) as levels FROM videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
            $_SESSION["user"]["id_usuario"], 0, 1);
            $strTheseThose = sprintf("SELECT count(*) as levels FROM  videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
            $_SESSION["user"]["id_usuario"], 0, 2);
            $strToBe = sprintf("SELECT count(*) as levels FROM  videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
            $_SESSION["user"]["id_usuario"], 0, 3);
    
            $resultSpeechRecognition = mysqli_query($conexion, $strSpeechRecognition)or die(mysqli_error($conexion));
            $resultTheseThose = mysqli_query($conexion, $strTheseThose)or die(mysqli_error($conexion));
            $resultToBe = mysqli_query($conexion, $strToBe)or die(mysqli_error($conexion));
    
            $_SESSION["SpeechRecognitionLevels"] = mysqli_fetch_assoc($resultSpeechRecognition);
            $_SESSION["TheseThoseLevels"] = mysqli_fetch_assoc($resultTheseThose);
            $_SESSION["ToBeLevels"] = mysqli_fetch_assoc($resultToBe);
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
    <style>
        #canvas{
            background: radial-gradient(circle, rgba(165,253,29,1) 0%, rgba(9,177,73,1) 57%);
            /*display: block;*/
            filter: blur(4px);
        }
    </style>
</head>
<body id="speech-background">
    <div class="pos-f-t">
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="col-md-1" id="toggle">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-6" id="logoContainer">
          <a href="<?=$url;?>dashboard" style="margin-left: 54%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="240" height="100"/></a>
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
              <a class="nav-link white" href="<?=$url;?>dashboard"><i class="fas fa-window-maximize"></i>&nbsp;Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>payment/"><i class="far fa-credit-card"></i>&nbsp;Payment and Subscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>videos/"><i class="fas fa-film"></i>&nbsp;Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>videogames/"><i class="fas fa-gamepad"></i>&nbsp;Videogames</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>materials/"><i class="far fa-file-pdf"></i>&nbsp;Materials</a>
            </li>
            <li class="nav-item">
              <a class="nav-link white" href="<?=$url;?>support/"><i class="far fa-comments"></i>&nbsp;support</a>
            </li>
            <li id="resavatar" class="hidden">              
            </li>
            <li id='reslogout' class="hidden">              
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid speech-section-container">
        <div class="level-selector">
            <div class="level-selector-title">
                <h1 class="press-start-speech">LEVEL SELECT</h1>
            </div>
            <div class="level-level">
                <table class="level-table">
                    <tr>                        
                        <td>
                            <?php if($_SESSION["SpeechRecognitionLevels"]["levels"] >= 1){?>
                              <button onClick="reload(1)" class="btn btn-success" style="width: 200px;">LEVEL 1</button>
                            <?php } else {?>
                              <button disabled class="btn btn-danger" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($_SESSION["SpeechRecognitionLevels"]["levels"] >= 2){?>
                              <button onClick="reload(2)" class="btn btn-success" style="width: 200px;">LEVEL 2</button>
                            <?php } else {?>
                              <button disabled class="btn btn-danger" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>                                
                        </td>
                        <td>
                            <?php if($_SESSION["SpeechRecognitionLevels"]["levels"] == 3){?>
                              <button onClick="reload(3)" class="btn btn-success" style="width: 200px;">LEVEL 3</button>
                            <?php } else {?>
                              <button disabled class="btn btn-danger" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                    </tr>
                </table>
            </div>            
            <div>
                <table class="table-footer">
                      <tr>  
                          <td>
                            <button onClick="goBack()" class="btn btn-primary" style="width: 200px;">GAME MENU</button>
                          </td>                        
                          <td>
                            <button onClick="leaderBoard()" class="btn btn-primary" style="width: 200px;">LEADERBOARD</button>
                          </td>
                          <td>
                            <button  onClick="reload(<?php echo $_SESSION["SpeechRecognitionLevels"]["levels"] ?>)" class="btn btn-primary" style="width: 200px;">CONTINUE</button>                          
                          </td>
                      </tr>
                </table>
            </div>            
        </div>
    </div>    
  </div>
  <script src="../../js/jquery-1.12.3.min.js" charset="utf-8"></script>
  <script type="text/javascript">    
    var reload = level => {
      location.replace("http://localhost/Cirkuits/speechrecognition/level"+level+"/");
    }

    var leaderBoard = () =>{
      alert("Go to Leaderboard")
    }
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>
