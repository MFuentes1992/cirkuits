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
            background: rgb(6,6,6);
            background: linear-gradient(360deg, rgba(6,6,6,1) 0%, rgba(167,4,42,1) 53%, rgba(255,0,52,1) 80%, rgba(255,0,0,1) 100%);
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
                              <button onClick="reload(1)" class="btn btn-outline-light" style="width: 200px;">LEVEL 1</button>
                            <?php } else {?>
                              <button disabled class="btn btn-secondary" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($_SESSION["TheseThoseLevels"]["levels"] >= 2){?>
                              <button onClick="reload(2)" class="btn btn-outline-light" style="width: 200px;">LEVEL 2</button>
                            <?php } else {?>
                              <button disabled class="btn btn-secondary" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>                                
                        </td>
                        <td>
                            <?php if($_SESSION["TheseThoseLevels"]["levels"] == 3){?>
                              <button onClick="reload(3)" class="btn btn-outline-light" style="width: 200px;">LEVEL 3</button>
                            <?php } else {?>
                              <button disabled class="btn btn-secondary" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                    </tr>
                </table>
            </div>            
            <div>
                <table class="table-footer">
                      <tr>  
                          <td>
                            <button onClick="goBack()" class="btn btn-outline-light" style="width: 200px;">GAME MENU</button>
                          </td>                        
                          <td>
                            <button onClick="leaderBoard()" class="btn btn-outline-light" style="width: 200px;">TIER BOARD</button>
                          </td>
                          <td>
                            <button  onClick="reload(<?php echo $_SESSION["TheseThoseLevels"]["levels"] ?>)" class="btn btn-outline-light" style="width: 200px;">CONTINUE</button>                          
                          </td>
                      </tr>
                </table>
            </div>            
        </div>
    </div>        
  </div>
  <audio id="game-enter-audio">      
      <source src="../../sounds/game_selected.mp3" type="audio/mpeg">
      Your browser does not support the audio element.
  </audio>
  <script src="../js/three.js" charset="utf-8"></script>
  <script src="../js/TweenMax.min.js" charset="utf-8"></script>
  <script src="../js/MTLLoader.js" charset="utf-8"></script>
  <script src="../js/OBJLoader.js" charset="utf-8"></script>
  <script src="../js/OrbitControls.js" charset="utf-8"></script>
  <script type="text/javascript">    
      $(document).ready( function(){
        let enterGme = document.getElementById('game-enter-audio');
        enterGme.play();
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
      location.replace("http://localhost/Cirkuits/leaderboardlevel?game=2");
    }
    function goBack() {
      window.history.back();
    }
    ///////////// 3D /////////////////////
    var renderer = new THREE.WebGLRenderer({antialias:true});
      renderer.setSize( window.innerWidth, window.innerHeight );

      if (window.innerWidth > 800) {
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        renderer.shadowMap.needsUpdate = true;
        //renderer.toneMapping = THREE.ReinhardToneMapping;
        //console.log(window.innerWidth);
      };
      //---

      document.body.appendChild( renderer.domElement );

      window.addEventListener('resize', onWindowResize, false);
      function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize( window.innerWidth, window.innerHeight );
      };

      var camera = new THREE.PerspectiveCamera( 20, window.innerWidth / window.innerHeight, 1, 500 );

      //camera.position.set(0, 0, 14);
      camera.position.x = 0;
      camera.position.y = 0.5;
      camera.position.z = 12;
      //camera.rotation.y = -1*Math.PI; 

      var scene = new THREE.Scene();
      var city = new THREE.Object3D();
      var smoke = new THREE.Object3D();
      var town = new THREE.Object3D();

      var createCarPos = true;
      var uSpeed = 0.001;
      
      //---------------------------------------------------------------- MODEL OF CARS      
      var mtlLoaderCar = new THREE.MTLLoader();
          mtlLoaderCar.setResourcePath('/3dlab/assets/');
          mtlLoaderCar.setPath('/3dlab/assets/');
          mtlLoaderCar.load('raceCarGreen.mtl', function (materials) {

              materials.preload();

              var objLoader = new THREE.OBJLoader();
              objLoader.setMaterials(materials);
              objLoader.setPath('/3dlab/assets/');
              objLoader.load('raceCarGreen.obj', function (object) {
                object.name = "car";
                object.rotation.y = -0.8*Math.PI;
                object.position.x = 0;
                object.position.z = 5;
                //object.scale.set(0.5, 0.5, 0.5); //-------------------- Scaling object
                scene.add(object);                                                          
              });
          });     

      //----------------------------------------------------------------- FOG background

      var setcolor = 0xF02050;
      //var setcolor = 0xF2F111;
      //var setcolor = 0xFF6347;

      scene.background = new THREE.Color(setcolor);
      scene.fog = new THREE.Fog(setcolor, 10, 16);
      //scene.fog = new THREE.FogExp2(setcolor, 0.05);
      //----------------------------------------------------------------- RANDOM Function
      function mathRandom(num = 8) {
        var numValue = - Math.random() * num + Math.random() * num;
        return numValue;
      };
      //----------------------------------------------------------------- CHANGE bluilding colors
      var setTintNum = true;
      function setTintColor() {
        if (setTintNum) {
          setTintNum = false;
          var setColor = 0x000000;
        } else {
          setTintNum = true;
          var setColor = 0x000000;
        };
        //setColor = 0x222222;
        return setColor;
      };

      //----------------------------------------------------------------- CREATE City

      function init() {
        var segments = 2;
        for (var i = 1; i<20; i++) {
          var geometry = new THREE.CubeGeometry(1,0,0,segments,segments,segments);
          var material = new THREE.MeshStandardMaterial({
            color:setTintColor(),
            wireframe:false,
            shading: THREE.SmoothShading,            
            side:THREE.DoubleSide});
          var wmaterial = new THREE.MeshLambertMaterial({
            color:0xFFFFFF,
            wireframe:true,
            transparent:true,
            opacity: 0.03,
            side:THREE.DoubleSide
            });

          var cube = new THREE.Mesh(geometry, material);
          var wire = new THREE.Mesh(geometry, wmaterial);
          var floor = new THREE.Mesh(geometry, material);
          var wfloor = new THREE.Mesh(geometry, wmaterial);
          
          cube.add(wfloor);
          cube.castShadow = true;
          cube.receiveShadow = true;
          cube.rotationValue = 0.1+Math.abs(mathRandom(8));
                    
          floor.scale.y = 0.05;
          cube.scale.y = 0.1+Math.abs(mathRandom(8));
          
          var cubeWidth = 0.9;
          cube.scale.x = cube.scale.z = cubeWidth+mathRandom(1-cubeWidth);          
          cube.position.x = Math.round(mathRandom());          
          cube.position.z = -1;
          
          floor.position.set(cube.position.x, 0, cube.position.z)
          
          town.add(floor);
          town.add(cube);
        };
        //----------------------------------------------------------------- Particular
        
        var gmaterial = new THREE.MeshToonMaterial({color:0xFFFF00, side:THREE.DoubleSide});
        var gparticular = new THREE.CircleGeometry(0.01, 3);
        var aparticular = 5;
        
        for (var h = 1; h<100; h++) {
          var particular = new THREE.Mesh(gparticular, gmaterial);
          particular.position.set(mathRandom(aparticular), mathRandom(aparticular),mathRandom(aparticular));
          particular.rotation.set(mathRandom(),mathRandom(),mathRandom());
          smoke.add(particular);
        };
        
        var pmaterial = new THREE.MeshPhongMaterial({
          color:0x000000,
          side:THREE.DoubleSide,
          roughness: 10,
          metalness: 0.6,
          opacity:0.9,
          transparent:true});
        var pgeometry = new THREE.PlaneGeometry(60,60);
        var pelement = new THREE.Mesh(pgeometry, pmaterial);
        pelement.rotation.x = -90 * Math.PI / 180;
        pelement.position.y = -0.001;
        pelement.receiveShadow = true;
        //pelement.material.emissive.setHex(0xFFFFFF + Math.random() * 100000);

        city.add(pelement);
      };

      //----------------------------------------------------------------- MOUSE function
      //----------------------------------------------------------------- Lights
      var ambientLight = new THREE.AmbientLight(0xFFFFFF, 0.8);
      var lightFront = new THREE.SpotLight(0xFFFFFF, 1, 1);
      var lightBack = new THREE.PointLight(0xFFFFFF, 0.5);
        
      lightFront.rotation.x = 45 * Math.PI / 180;
      lightFront.rotation.z = -45 * Math.PI / 180;
      lightFront.position.set(5, 5, 5);
      lightFront.castShadow = true;
      lightFront.shadow.mapSize.width = 6000;
      lightFront.shadow.mapSize.height = lightFront.shadow.mapSize.width;
      lightFront.penumbra = 0.1;
      lightBack.position.set(0,6,0);

      smoke.position.y = 2;

      scene.add(ambientLight);
      city.add(lightFront);
      scene.add(lightBack);
      scene.add(city);
      city.add(smoke);
      city.add(town);

      //----------------------------------------------------------------- GRID Helper
      var gridHelper = new THREE.GridHelper( 60, 120, 0xFF0000, 0x000000);
      city.add( gridHelper );

      //----------------------------------------------------------------- LINES world

      var createCars = function(cScale = 2, cPos = 20, cColor = 0xFFFF00) {
        var cMat = new THREE.MeshToonMaterial({color:cColor, side:THREE.DoubleSide});
        var cGeo = new THREE.CubeGeometry(1, cScale/40, cScale/40);
        var cElem = new THREE.Mesh(cGeo, cMat);
        var cAmp = 3;
        
        if (createCarPos) {
          createCarPos = false;
          cElem.position.x = -cPos;
          cElem.position.z = (mathRandom(cAmp));

          TweenMax.to(cElem.position, 3, {x:cPos, repeat:-1, yoyo:true, delay:mathRandom(3)});
        } else {
          createCarPos = true;
          cElem.position.x = (mathRandom(cAmp));
          cElem.position.z = -cPos;
          cElem.rotation.y = 90 * Math.PI / 180;
        
          TweenMax.to(cElem.position, 5, {z:cPos, repeat:-1, yoyo:true, delay:mathRandom(3), ease:Power1.easeInOut});
        };
        cElem.receiveShadow = true;
        cElem.castShadow = true;
        cElem.position.y = Math.abs(mathRandom(5));
        city.add(cElem);
      };

      var generateLines = function() {
        for (var i = 0; i<60; i++) {
          createCars(0.1, 20);
        };
      };

      //----------------------------------------------------------------- CAMERA position

      var cameraSet = function() {
        createCars(0.1, 20, 0xFFFFFF);        
      };

      //----------------------------------------------------------------- ANIMATE

      var animate = function() {
        var time = Date.now() * 0.00005;
        requestAnimationFrame(animate);

        for ( let i = 0, l = town.children.length; i < l; i ++ ) {
          var object = town.children[ i ];
        }
        
        smoke.rotation.y += 0.01;
        smoke.rotation.x += 0.01;                
        renderer.render( scene, camera );  
      }

      //----------------------------------------------------------------- START functions
      generateLines();
      init();
      animate();

      /*var update = function(){        	
        controls.update(); 
        var time = performance.now() * 0.001;
        if(loaded)
          selectedObject.rotation.y = time * 0.5;
    };*/
  </script>
</body>
</html>


