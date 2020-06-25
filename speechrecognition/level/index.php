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
            <div class="speech-level-box">
                <table class="level-table">
                    <tr>                        
                        <td>
                            <?php if($_SESSION["SpeechRecognitionLevels"]["levels"] >= 1){?>
                              <button onClick="reload(1)" class="btn btn-outline-light" style="width: 200px;">LEVEL 1</button>
                            <?php } else {?>
                              <button disabled class="btn btn-secondary" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>
                        </td>
                        <td>
                            <?php if($_SESSION["SpeechRecognitionLevels"]["levels"] >= 2){?>
                              <button onClick="reload(2)" class="btn btn-outline-light" style="width: 200px;">LEVEL 2</button>
                            <?php } else {?>
                              <button disabled class="btn btn-secondary" style="width: 200px;">LOCKED &nbsp;<i class="fas fa-lock"></i></button>
                            <?php }?>                                
                        </td>
                        <td>
                            <?php if($_SESSION["SpeechRecognitionLevels"]["levels"] == 3){?>
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
                            <button onClick="leaderBoard()" class="btn btn-outline-light" style="width: 200px;">LEADERBOARD</button>
                          </td>
                          <td>
                            <button  onClick="reload(<?php echo $_SESSION["SpeechRecognitionLevels"]["levels"] ?>)" class="btn btn-outline-light" style="width: 200px;">CONTINUE</button>                          
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
  <script src="../../js/jquery-1.12.3.min.js" charset="utf-8"></script>
  <script type="text/javascript">    

    $(document).ready( function(){
        let enterGme = document.getElementById('game-enter-audio');
        enterGme.play();
    });

    var reload = level => {
      location.replace("http://localhost/Cirkuits/speechrecognition/level"+level+"/");
    }

    var leaderBoard = () =>{
      location.replace("http://localhost/Cirkuits/leaderboardlevel?game=1");
    }
    function goBack() {
      window.history.back();
    }

    
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

      camera.position.set(0, 2, 14);

      var scene = new THREE.Scene();
      var city = new THREE.Object3D();
      var smoke = new THREE.Object3D();
      var town = new THREE.Object3D();

      var createCarPos = true;
      var uSpeed = 0.001;

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
        for (var i = 1; i<10; i++) {
          var geometry = new THREE.CubeGeometry(1,0,0,segments,segments,segments);
          var material = new THREE.MeshStandardMaterial({
            color:setTintColor(),
            wireframe:false,
            //opacity:0.9,
            //transparent:true,
            //roughness: 0.3,
            //metalness: 1,
            shading: THREE.SmoothShading,
            //shading:THREE.FlatShading,
            side:THREE.DoubleSide});
          var wmaterial = new THREE.MeshLambertMaterial({
            color:0xFFFFFF,
            wireframe:true,
            transparent:true,
            opacity: 0.03,
            side:THREE.DoubleSide/*,
            shading:THREE.FlatShading*/});

          var cube = new THREE.Mesh(geometry, material);
          var wire = new THREE.Mesh(geometry, wmaterial);
          var floor = new THREE.Mesh(geometry, material);
          var wfloor = new THREE.Mesh(geometry, wmaterial);
          
          cube.add(wfloor);
          cube.castShadow = true;
          cube.receiveShadow = true;
          cube.rotationValue = 0.1+Math.abs(mathRandom(8));
          
          //floor.scale.x = floor.scale.z = 1+mathRandom(0.33);
          floor.scale.y = 0.05;//+mathRandom(0.5);
          cube.scale.y = 0.1+Math.abs(mathRandom(8));
          //TweenMax.to(cube.scale, 1, {y:cube.rotationValue, repeat:-1, yoyo:true, delay:i*0.005, ease:Power1.easeInOut});
          /*cube.setScale = 0.1+Math.abs(mathRandom());
          
          TweenMax.to(cube.scale, 4, {y:cube.setScale, ease:Elastic.easeInOut, delay:0.2*i, yoyo:true, repeat:-1});
          TweenMax.to(cube.position, 4, {y:cube.setScale / 2, ease:Elastic.easeInOut, delay:0.2*i, yoyo:true, repeat:-1});*/
          
          var cubeWidth = 0.9;
          cube.scale.x = cube.scale.z = cubeWidth+mathRandom(1-cubeWidth);
          //cube.position.y = cube.scale.y / 2;
          cube.position.x = Math.round(mathRandom());
          cube.position.z = Math.round(mathRandom());
          
          floor.position.set(cube.position.x, 0/*floor.scale.y / 2*/, cube.position.z)
          
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
      var raycaster = new THREE.Raycaster();
      var mouse = new THREE.Vector2(), INTERSECTED;
      var intersected;

      function onMouseMove(event) {
        event.preventDefault();
        mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
      };
      function onDocumentTouchStart( event ) {
        if ( event.touches.length == 1 ) {
          event.preventDefault();
          mouse.x = event.touches[ 0 ].pageX -  window.innerWidth / 2;
          mouse.y = event.touches[ 0 ].pageY - window.innerHeight / 2;
        };
      };
      function onDocumentTouchMove( event ) {
        if ( event.touches.length == 1 ) {
          event.preventDefault();
          mouse.x = event.touches[ 0 ].pageX -  window.innerWidth / 2;
          mouse.y = event.touches[ 0 ].pageY - window.innerHeight / 2;
        }
      }
      window.addEventListener('mousemove', onMouseMove, false);
      window.addEventListener('touchstart', onDocumentTouchStart, false );
      window.addEventListener('touchmove', onDocumentTouchMove, false );

      //----------------------------------------------------------------- Lights
      var ambientLight = new THREE.AmbientLight(0xFFFFFF, 4);
      var lightFront = new THREE.SpotLight(0xFFFFFF, 20, 10);
      var lightBack = new THREE.PointLight(0xFFFFFF, 0.5);

      var spotLightHelper = new THREE.SpotLightHelper( lightFront );
      //scene.add( spotLightHelper );

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

      //----------------------------------------------------------------- CAR world
      var generateCar = function() {
        
      }
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
        //TweenMax.to(camera.position, 1, {y:1+Math.random()*4, ease:Expo.easeInOut})
      };

      //----------------------------------------------------------------- ANIMATE

      var animate = function() {
        var time = Date.now() * 0.00005;
        requestAnimationFrame(animate);
        
        /*city.rotation.y -= ((mouse.x * 8) - camera.rotation.y) * uSpeed;
        city.rotation.x -= (-(mouse.y * 2) - camera.rotation.x) * uSpeed;
        if (city.rotation.x < -0.05) city.rotation.x = -0.05;
        else if (city.rotation.x>1) city.rotation.x = 1;
        var cityRotation = Math.sin(Date.now() / 5000) * 13;*/
        //city.rotation.x = cityRotation * Math.PI / 180;
        
        //console.log(city.rotation.x);
        //camera.position.y -= (-(mouse.y * 20) - camera.rotation.y) * uSpeed;;
        
        for ( let i = 0, l = town.children.length; i < l; i ++ ) {
          var object = town.children[ i ];
          //object.scale.y = Math.sin(time*50) * object.rotationValue;
          //object.rotation.y = (Math.sin((time/object.rotationValue) * Math.PI / 180) * 180);
          //object.rotation.z = (Math.cos((time/object.rotationValue) * Math.PI / 180) * 180);
        }
        
        smoke.rotation.y += 0.01;
        smoke.rotation.x += 0.01;
        
        camera.lookAt(city.position);
        renderer.render( scene, camera );  
      }

      //----------------------------------------------------------------- START functions
      generateLines();
      init();
      animate();


  </script>
</body>
</html>
