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
    <div class="aside-menu">
      <div id="aside-logo-container">
        <img src="../../img/bw_logo.png" alt="Cirkuits logo">
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
              <a href="../../dashboard"><i class="fas fa-home"></i>&nbsp;Dashboard</a>
            </li>
            <li class="menu-list-item">
              <a href="../../videos"><i class="fas fa-film"></i>&nbsp;Videos</a>
            </li>
            <li class="menu-list-item">
              <a href="../../videogames"><i class="fas fa-gamepad"></i>&nbsp;Videogames</a>
            </li>
            <li class="menu-list-item">
              <a href="../../materials"><i class="fas fa-file-pdf"></i>&nbsp;Materials</a>
            </li>
            <li class="menu-list-item">
              <a href="../../support"><i class="fas fa-info-circle"></i>&nbsp;Support</a>
            </li>
          </ul>
        </div>
      </div>
    </div> 
    <div class="container-fluid-thesethose thesethose-section-container">
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
          mtlLoaderCar.setResourcePath('../../3dlab/assets/');
          mtlLoaderCar.setPath('../../3dlab/assets/');
          mtlLoaderCar.load('raceCarGreen.mtl', function (materials) {

              materials.preload();

              var objLoader = new THREE.OBJLoader();
              objLoader.setMaterials(materials);
              objLoader.setPath('../../3dlab/assets/');
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
          cube.scale.y = Math.abs(mathRandom(2.5));
          
          var cubeWidth = 0.9;
          cube.scale.x = cube.scale.z = cubeWidth+mathRandom(1-cubeWidth);          
          cube.position.x = Math.round(mathRandom());          
          cube.position.z = -1;
          
          floor.position.set(cube.position.x, 0, cube.position.z)
          
          town.add(floor);
          town.add(cube);
        };
        let neurons = new Array();
          let LinePoints = new Array();
          let cloudStepX = 1.5;
          let cloudStepZ = 1;
          //----------------------------------------------------------------- CREATE CLOUD OF NEURONS
          for (var i = 0; i<15; i++) {
            var geometry = new THREE.IcosahedronGeometry(1);
            var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
            var neuron = new THREE.Mesh(geometry, material);
            neuron.speedRotation = Math.random() * 0.1;
            neuron.positionX = -10 + cloudStepX;
            neuron.positionY = 2.7;
            neuron.positionZ = -1;
            neuron.castShadow = true;
            neuron.receiveShadow = true;
            
            //------------------------------------------------------------------------------- Adding points for lines to follow
            LinePoints.push( new THREE.Vector3(neuron.positionX, neuron.positionY, neuron.positionZ));      
            //-------------------------------------------------------------- Scaling geometry
            var newScaleValue = 0.3;      
            neuron.scale.set(newScaleValue,newScaleValue,newScaleValue);

            //---
            //neuron.rotation.x = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.y = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.z = mathRandom(180 * Math.PI / 180);
            //
            neuron.position.set(neuron.positionX, neuron.positionY, neuron.positionZ);
            //neuron.layers.enable( 1 )
            //modularGruop.add(cube);
            //TODO: Fix this step process
            /*if(cloudStepX > 10){
              cloudStepX = 0;
            }else{
              cloudStepX = 2;
            }*/
            cloudStepX += cloudStepX;
            cloudStepZ += mathRandom(1.5);
            scene.add(neuron);
            neurons.push(neuron);
          }
          //------------------------------------------------------------- CREATE LINES
          var LineMaterial = new THREE.LineBasicMaterial( { color: 0xffffff } );
          var LineGeometry = new THREE.BufferGeometry().setFromPoints( LinePoints );
          var line = new THREE.Line( LineGeometry, LineMaterial );
          scene.add(line);             
          //------------------------------------------------------------- Double neuron lines
          let neurons2 = new Array();
          let LinePoints2 = new Array();
          let cloudStepX2 = 0.5;
          let cloudStepZ2 = 1;
          //----------------------------------------------------------------- CREATE CLOUD OF NEURONS
          for (var i = 0; i<15; i++) {
            var geometry = new THREE.IcosahedronGeometry(1);
            var material = new THREE.MeshStandardMaterial({shading:THREE.FlatShading, color:0x111111, transparent:false, opacity:1, wireframe:false});
            var neuron = new THREE.Mesh(geometry, material);
            neuron.speedRotation = Math.random() * 0.1;
            neuron.positionX = -4 + cloudStepX2;
            neuron.positionY = 2.6;
            neuron.positionZ = -2.8;
            neuron.castShadow = true;
            neuron.receiveShadow = true;
            
            //------------------------------------------------------------------------------- Adding points for lines to follow
            LinePoints2.push( new THREE.Vector3(neuron.positionX, neuron.positionY, neuron.positionZ));      
            //-------------------------------------------------------------- Scaling geometry
            var newScaleValue = 0.3;      
            neuron.scale.set(newScaleValue,newScaleValue,newScaleValue);

            //---
            //neuron.rotation.x = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.y = mathRandom(180 * Math.PI / 180);
            //neuron.rotation.z = mathRandom(180 * Math.PI / 180);
            //
            neuron.position.set(neuron.positionX, neuron.positionY, neuron.positionZ);
            //neuron.layers.enable( 1 )
            //modularGruop.add(cube);
            //TODO: Fix this step process
            /*if(cloudStepX > 10){
              cloudStepX = 0;
            }else{
              cloudStepX = 2;
            }*/
            cloudStepX2 += cloudStepX2;
            cloudStepZ2 += mathRandom(1.5);
            scene.add(neuron);
            neurons2.push(neuron);
          }          
          //------------------------------------------------------------- CREATE LINES
          var LineMaterial2 = new THREE.LineBasicMaterial( { color: 0xffffff } );
          var LineGeometry2 = new THREE.BufferGeometry().setFromPoints( LinePoints2 );
          var line2 = new THREE.Line( LineGeometry2, LineMaterial2 );
          scene.add(line2);         
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


