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
        $strTheseThose = sprintf("SELECT count(*) as levels FROM  videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
        $_SESSION["user"]["id_usuario"], 0, 2);
        $resultTheseThose = mysqli_query($conexion, $strTheseThose)or die(mysqli_error($conexion));
        $_SESSION["TheseThoseLevels"] = mysqli_fetch_assoc($resultTheseThose);
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
            height:600px;
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
          <a href="<?=$url;?>dashboard" style="margin-left: 45%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="240" height="100"/></a>
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
    <div class="container-fluid thesethose-section-container">
        <div class="level-selector">
            <div class="level-selector-title">
                <h1 class="press-start">LEVEL SELECT</h1>
            </div>
            <div class="level-level">
                <table class="level-table">
                    <tr>                        
                        <td>
                            <?php if($_SESSION["TheseThoseLevels"]["levels"] >= 1){?>
                              <button onClick="reload(1)" class="btn btn-primary" style="width: 200px;">LEVEL 1</button>
                            <?php } else {?>
                              <button disabled class="btn btn-outline-danger" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($_SESSION["TheseThoseLevels"]["levels"] >= 2){?>
                              <button onClick="reload(2)" class="btn btn-primary" style="width: 200px;">LEVEL 2</button>
                            <?php } else {?>
                              <button disabled class="btn btn-outline-danger" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>                                
                        </td>
                        <td>
                            <?php if($_SESSION["TheseThoseLevels"]["levels"] == 3){?>
                              <button onClick="reload(3)" class="btn btn-primary" style="width: 200px;">LEVEL 3</button>
                            <?php } else {?>
                              <button disabled class="btn btn-outline-danger" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
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
                            <button  onClick="reload(<?php echo $_SESSION["TheseThoseLevels"]["levels"] ?>)" class="btn btn-primary" style="width: 200px;">CONTINUE</button>                          
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
      location.replace("http://localhost/Cirkuits/leaderboard?game=2");
    }
    function goBack() {
      window.history.back();
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
    var loaded = false;
    var selectedObject;
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
              object.name = "car";
              scene.add(object); 
              loaded = true;
              selectedObject = scene.getObjectByName("car")
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
        var time = performance.now() * 0.001;
        if(loaded)
          selectedObject.rotation.y = time * 0.5;
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
