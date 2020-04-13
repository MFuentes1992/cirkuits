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
        $query_user_progress_v1 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame=1",
        GetSQLValueString($conexion,$_SESSION["user"]["id_usuario"], "int"));
        $result_user_progress_v1 = mysqli_query($conexion, $query_user_progress_v1) or die(mysqli_error($conexion));

        $_SESSION["uprogressv1"] = $row_user_progress_v1 = mysqli_fetch_assoc($result_user_progress_v1);
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
    <div class="container-fluid thesethose-section-container">
        <div class="level-selector">
            <div class="level-selector-title">
                <h1 class="press-start">LEVEL SELECT</h1>
            </div>
            <div class="level-level">
                <table class="level-table">
                    <tr>                        
                        <td>
                            <?php if($_SESSION["uprogressv1"]["nivel"] >= 1){?>
                              <button onClick="reload(1)" class="btn btn-info" style="width: 200px;">Level 1</button>
                            <?php } else {?>
                              <button disabled class="btn btn-info" style="width: 200px;">Locked &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($_SESSION["uprogressv1"]["nivel"] >= 2){?>
                              <button onClick="reload(2)" class="btn btn-info" style="width: 200px;">Level 2</button>
                            <?php } else {?>
                              <button disabled class="btn btn-info" style="width: 200px;">Locked &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>                                
                        </td>
                        <td>
                            <?php if($_SESSION["uprogressv1"]["nivel"] == 3){?>
                              <button onClick="reload(3)" class="btn btn-info" style="width: 200px;">Level 3</button>
                            <?php } else {?>
                              <button disabled class="btn btn-info" style="width: 200px;">Locked &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                    </tr>
                </table>
            </div>            
            <div>
                <table class="table-footer">
                      <tr>                          
                          <td>
                            <button onClick="leaderBoard()" class="btn btn-primary" style="width: 200px;">Leaderboard</button>
                          </td>
                          <td>
                            <button  onClick="reload(<?php echo $_SESSION["uprogressv1"]["nivel"] ?>)" class="btn btn-primary" style="width: 200px;">Continue</button>                          
                          </td>
                      </tr>
                </table>
            </div>            
        </div>
    </div>    
    <canvas id="canvas"></canvas>
  </div>
  <script src="../js/three.js" charset="utf-8"></script>
  <script src="../js/MTLLoader.js" charset="utf-8"></script>
  <script src="../js/OBJLoader.js" charset="utf-8"></script>
  <script src="../js/OrbitControls.js" charset="utf-8"></script>
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
      location.replace("http://localhost/Cirkuits/thesethose/level"+level+"/");
    }

    var leaderBoard = () =>{
      alert("Go to Leaderboard")
    }

    ///////////// 3D /////////////////////
    var canvas = document.getElementById("canvas");
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 3000 );
    var renderer = new THREE.WebGLRenderer({canvas, alpha:true, antialias: true});
    //Background color de la escena.
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild(renderer.domElement);

    camera.position.x = 1.5;
    camera.position.y = 0.5;
    camera.position.z = 0;    

    ambientLight = new THREE.AmbientLight(0xffffff, 1);
	  scene.add(ambientLight);
	
	  light = new THREE.PointLight(0xffffff, 0.8, 18);
	  light.position.set(-3,6,-3);
	  light.castShadow = true;
	  light.shadow.camera.near = 0.1;
	  light.shadow.camera.far = 25;
	  scene.add(light);

    var controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.25;
    controls.enableZoom = true;

    //////////////////// LOADING YELLOW CARS ////////////////////////////        
    var mtlLoaderCar = new THREE.MTLLoader();
        mtlLoaderCar.setResourcePath('/cirkuits/3dlab/assets/');
        mtlLoaderCar.setPath('/cirkuits/3dlab/assets/');
        mtlLoaderCar.load('raceCarOrange.mtl', function (materials) {

            materials.preload();

            var objLoader = new THREE.OBJLoader();
            objLoader.setMaterials(materials);
            objLoader.setPath('/cirkuits/3dlab/assets/');
            objLoader.load('raceCarOrange.obj', function (object) {
              scene.add(object); 
            });
        }); 

    window.addEventListener( 'resize', function(){
        var width = window.innerWidth;
        var height = window.innerHeight;
        renderer.setSize( width, height );
        camera.aspect = width / height;
        camera.updateProjectionMatrix( );
    } );
    
    var update = function(){        	
        controls.update();
    };
    var render = function(){
        renderer.render( scene, camera );
    };
    var GameLoop = function(){
        requestAnimationFrame( GameLoop );
        update();
        render();
    };
    GameLoop();
  </script>
</body>
</html>
